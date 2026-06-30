<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peserta;
use Maatwebsite\Excel\Facades\Excel;

class PesertaController extends Controller
{
    // Tampilan Utama Manajemen Peserta
    public function index()
    {
        $pesertas = Peserta::orderBy('created_at', 'desc')->get();
        return view('admin.peserta', compact('pesertas'));
    }

    // Tambah Peserta Manual (Auto-Generate Nomor Peserta)
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:1,2', // 1 = Laki-laki, 2 = Perempuan
            'no_absen' => 'required|integer|min:1',
        ]);

        // 🌟 Rumus Otomatis Aturan Nomor Peserta
        $tahun = date('Y'); // Mengambil tahun saat ini (Contoh: 2026)
        $gender = $request->jenis_kelamin; 
        $absen = str_pad($request->no_absen, 3, '0', STR_PAD_LEFT); // Mengubah 1 jadi 001, 12 jadi 012
        
        $nomor_peserta = "CBT-" . $tahun . "-" . $gender . "-" . $absen;

        // Cek dulu apakah kombinasi nomor ini sudah pernah terdaftar
        $cekDuplikat = Peserta::where('nomor_peserta', $nomor_peserta)->first();
        if ($cekDuplikat) {
            return back()->with('error', "Gagal! Nomor peserta $nomor_peserta sudah terpakai oleh " . $cekDuplikat->nama);
        }

        Peserta::create([
            'nomor_peserta' => $nomor_peserta,
            'nama' => trim($request->nama),
        ]);

        return back()->with('success', "Sip! Berhasil membuat peserta baru dengan nomor: $nomor_peserta");
    }

    // Import Banyak Peserta via File Excel (Auto-Generate Nomor Peserta)
    public function importExcel(Request $request)
    {
        $request->validate([
            'file_excel' => 'required|mimes:xlsx,xls,csv',
        ]);

        try {
            $file = $request->file('file_excel');
            $data = Excel::toArray([], $file);

            if (!empty($data) && isset($data[0])) {
                $count = 0;
                foreach ($data[0] as $key => $row) {
                    // Abaikan baris pertama jika itu Judul Header (Nama, Gender, Absen)
                    if ($key === 0 && (str_contains(strtolower($row[0]), 'nama') || str_contains(strtolower($row[1]), 'kelamin'))) {
                        continue;
                    }

                    // Pastikan baris Excel tidak kosong (Kolom A: Nama, Kolom B: L/P, Kolom C: Absen)
                    if (!empty($row[0]) && !empty($row[1]) && isset($row[2])) {
                        $nama = trim($row[0]);
                        
                        // Konversi Gender dari Excel (Jika tertulis L/Laki-laki jadi 1, sisanya jadi 2)
                        $jkInput = strtoupper(trim($row[1]));
                        $gender = ($jkInput === 'L' || str_contains(strtolower($jkInput), 'laki')) ? '1' : '2';
                        
                        $tahun = date('Y');
                        $absen = str_pad(trim($row[2]), 3, '0', STR_PAD_LEFT);
                        
                        // Gabungkan jadi kode resmi
                        $nomor_peserta = "CBT-" . $tahun . "-" . $gender . "-" . $absen;

                        Peserta::updateOrCreate(
                            ['nomor_peserta' => $nomor_peserta],
                            ['nama' => $nama]
                        );
                        $count++;
                    }
                }
                return back()->with('success', "Mantap! Berhasil memproses otomatis $count data peserta via Excel.");
            }

            return back()->with('error', 'File Excel kosong atau format kolom tidak sesuai.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengimpor file: ' . $e->getMessage());
        }
    }

    // Hapus Peserta
    public function destroy($id)
    {
        $peserta = Peserta::findOrFail($id);
        $peserta->delete();

        return back()->with('success', 'Data peserta berhasil dihapus dari sistem.');
    }

    // Fungsi Login untuk Siswa / Peserta
    public function loginPeserta(Request $request)
    {
        $request->validate([
            'nomor_peserta' => 'required|string',
        ]);

        // Cari nomor peserta di database
        $peserta = Peserta::where('nomor_peserta', trim($request->nomor_peserta))->first();

        if (!$peserta) {
            return back()->with('error', 'Waduh! Nomor peserta tidak terdaftar. Periksa kembali atau hubungi admin, bro!');
        }

        // Jika ketemu, simpan data identitas siswa ke dalam Session browser
        session([
            'peserta_id'    => $peserta->id,
            'peserta_nomor' => $peserta->nomor_peserta,
            'peserta_nama'  => $peserta->nama
        ]);

        return back()->with('success', 'Sip, login berhasil! Selamat mengerjakan ujian.');
    }

    // Fungsi Logout untuk Siswa
    public function logoutPeserta()
    {
        // Hapus semua session siswa
        session()->forget(['peserta_id', 'peserta_nomor', 'peserta_nama']);
        return redirect('/')->with('success', 'Berhasil keluar dari sesi ujian.');
    }
}