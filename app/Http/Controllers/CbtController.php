<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExamSession;
use App\Models\Peserta;
use App\Models\Nilai;
use App\Imports\QuestionsImport;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Illuminate\Support\Facades\Storage;

class CbtController extends Controller
{
    // Mengatur Halaman Depan / Landing Page Siswa
    public function landing()
    {
        // Mengambil semua materi ujian aktif beserta jumlah soalnya
        $materiUjian = ExamSession::withCount('questions')->get(); 
        
        return view('landing', compact('materiUjian'));
    }

    // Mengarahkan ke file ujian.blade.php (Sudah Diberi Pengaman Sesi)
    // Mengarahkan ke file ujian.blade.php (Sudah Diberi Pengaman Sesi)
    public function indexUser()
    {
        // 🔒 PROTEKSI: Jika siswa belum input nomor peserta, tendang balik ke halaman depan
        if (!session()->has('peserta_id')) {
            return redirect('/')->with('error', 'Akses ditolak, bro! Kamu harus login menggunakan Nomor Peserta terlebih dahulu.');
        }

        // 🌟 AMBIL DATA: Ambil data nama & nomor peserta berdasarkan ID session-nya
        $peserta = Peserta::find(session('peserta_id'));

        return view('ujian', compact('peserta')); 
    }

    // Tampilan Halaman Admin Dashboard (UPDATED: Menampilkan Live Stats & Tabel Nilai)
    public function adminDashboard()
    {
        $sessions = ExamSession::withCount('questions')->get();
        
        // Ambil data hasil ujian terbaru untuk tabel Live Score Admin
        $rekapNilai = Nilai::with(['peserta', 'examSession'])->latest()->get();

        // Hitung ringkasan data statistik widget atas
        $totalPeserta = Peserta::count();
        $pesertaUjian = Nilai::distinct('peserta_id')->count('peserta_id');
        $rataRataSkor = Nilai::avg('skor') ?? 0;

        return view('admin', compact('sessions', 'rekapNilai', 'totalPeserta', 'pesertaUjian', 'rataRataSkor')); 
    }

    // Fungsi Upload Excel Soal
    public function uploadExcel(Request $request)
{
    $request->validate([
        'file_excel' => 'required|mimes:xlsx,xls,csv|max:5120'
    ]);

    try {
        $path = $request->file('file_excel')->getRealPath();
        $rowImages = [];

        if ($request->file('file_excel')->getClientOriginalExtension() === 'xlsx') {
            $spreadsheet = IOFactory::load($path);
            $sheet = $spreadsheet->getActiveSheet();

            foreach ($sheet->getDrawingCollection() as $drawing) {
                $coordinate = $drawing->getCoordinates(); // contoh: "J5"
                $row = (int) preg_replace('/[^0-9]/', '', $coordinate);

                if ($drawing instanceof Drawing) {
                    $zip = fopen($drawing->getPath(), 'r');
                    $contents = stream_get_contents($zip);
                    fclose($zip);

                    $filename = 'soal_' . uniqid() . '.' . strtolower($drawing->getExtension());
                    Storage::disk('public')->put('questions/' . $filename, $contents);

                    $rowImages[$row] = 'questions/' . $filename;
                }
            }
        }

        Excel::import(new QuestionsImport($rowImages), $request->file('file_excel'));
        return back()->with('sukses', 'Gokil! Soal (beserta gambar kalau ada) berhasil di-import!');
    } catch (\Exception $e) {
        return back()->with('error', 'Waduh gagal membaca file: ' . $e->getMessage());
    }
}

    // Fungsi Hapus Materi Ujian
    public function deleteMateri($id)
    {
        try {
            ExamSession::findOrFail($id)->delete();
            return back()->with('sukses', 'Materi berhasil dihapus total beserta seluruh soalnya!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus materi: ' . $e->getMessage());
        }
    }

    // API Data Soal untuk Frontend JavaScript
    public function getExamData()
    {
        return response()->json(ExamSession::with('questions.options')->get());
    }

    // 🌟 BARU: Menerima & Menyimpan hasil akhir ujian siswa via API
    public function submitUjian(Request $request)
{
    try {
        $nilai = Nilai::create([
            // Ambil dari request yang dikirim dari form/js frontend
            'peserta_id'      => $request->peserta_id, 
            'exam_session_id' => $request->session_id,
            'total_soal'      => $request->total_soal,
            'jawaban_benar'   => $request->jawaban_benar,
            'jawaban_salah'   => $request->jawaban_salah,
            'skor'            => $request->skor,
            'waktu_mulai'     => now()->subMinutes($request->durasi_menit ?? 0),
            'waktu_selesai'   => now(),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Nilai ujian berhasil direkam!'
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage() // Ini akan menunjukkan error asli jika database gagal
        ], 500);
    }
}

    // 🌟 BARU: Fungsi Download Rekap Nilai format Excel Instan
    public function exportNilaiExcel()
    {
        $data = Nilai::with(['peserta', 'examSession'])->get();
        $fileName = "Rekap_Nilai_CBT_" . date('Y-m-d') . ".xls";
        
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$fileName\"");
        
        echo "
        <table border='1'>
            <tr>
                <th bgcolor='#38bdf8'>No</th>
                <th bgcolor='#38bdf8'>Nomor Peserta</th>
                <th bgcolor='#38bdf8'>Nama Siswa</th>
                <th bgcolor='#38bdf8'>Materi Ujian</th>
                <th bgcolor='#38bdf8'>Benar</th>
                <th bgcolor='#38bdf8'>Salah</th>
                <th bgcolor='#38bdf8'>Skor Akhir</th>
            </tr>";
            
        foreach($data as $key => $row) {
            echo "
            <tr>
                <td>".($key+1)."</td>
                <td>'".$row->peserta->nomor_peserta."</td>
                <td>".$row->peserta->nama."</td>
                <td>".$row->examSession->name."</td>
                <td>".$row->jawaban_benar."</td>
                <td>".$row->jawaban_salah."</td>
                <td>".$row->skor."</td>
            </tr>";
        }
        echo "</table>";
        exit;
    }

    public function deleteNilai($id)
{
    try {
        Nilai::findOrFail($id)->delete();
        return back()->with('sukses', 'Data nilai peserta berhasil dihapus!');
    } catch (\Exception $e) {
        return back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
    }
}
}