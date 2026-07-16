<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-bimtes.png') }}" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - CBT BIMTES</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #0d0f18; color: #ccc; font-family: 'Plus Jakarta Sans', sans-serif; margin: 0; padding: 40px; }
        .container { max-width: 900px; margin: 0 auto; }
        
        /* HEADER STYLE */
        .admin-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; border-bottom: 1px solid rgba(255,255,255,0.05); padding-bottom: 15px; }
        .admin-header h1 { color: #fff; font-size: 1.8rem; font-weight: 700; margin: 0; }
        
        .card { background: #161927; padding: 30px; border-radius: 12px; border: 1px solid rgba(255,255,255,0.07); margin-bottom: 30px; }
        h2, h3 { color: #fff; margin-top: 0; }
        .alert { padding: 12px 20px; border-radius: 8px; margin-bottom: 20px; font-weight: 600; }
        .alert-success { background: #10b981; color: #fff; }
        .alert-error { background: #ef4444; color: #fff; }
        .form-group { margin-bottom: 20px; }
        input[type="file"] { display: block; width: 100%; padding: 12px; background: #1e2235; border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: #fff; margin-top: 8px; box-sizing: border-box; }
        
        button { background: #38bdf8; color: #0d0f18; border: none; padding: 12px 24px; border-radius: 8px; font-weight: 700; cursor: pointer; transition: 0.2s; }
        button:hover { background: #7dd3fc; }
        
        /* BUTTON LOGOUT */
        .btn-logout { background: transparent; color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.3); padding: 8px 16px; border-radius: 8px; font-weight: 600; transition: 0.3s; }
        .btn-logout:hover { background: #ef4444; color: #fff; box-shadow: 0 0 15px rgba(239, 68, 68, 0.2); }

        table { width: 100%; border-collapse: collapse; text-align: left; }
        tr { border-bottom: 1px solid rgba(255,255,255,0.05); }
        th { padding: 12px; color: #fff; border-bottom: 2px solid rgba(255,255,255,0.1); }
        td { padding: 12px; }
        .btn-delete { background: #ef4444; color: #fff; padding: 6px 12px; border-radius: 6px; font-size: 13px; font-weight: 600; cursor: pointer; border: none; }
        .btn-delete:hover { background: #f87171; }
        .badge { background: #252a42; padding: 4px 10px; border-radius: 20px; font-size: 13px; color: #38bdf8; }
    </style>
</head>
<body>
    <div class="container">
        
        <div class="admin-header">
            <h1><i class="fas fa-user-shield text-primary"></i> Panel Kendali Admin</h1>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout"><i class="fas fa-sign-out-alt"></i> Keluar / Logout</button>
            </form>
        </div>

        @if(session('sukses') || session('success'))
            <div class="alert alert-success">✓ {{ session('sukses') ?? session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">❌ {{ session('error') }}</div>
        @endif

        <div class="admin-tabs" style="display: flex; gap: 10px; margin-bottom: 25px;">
        <button onclick="switchTab('materi')" id="btn-materi" style="padding: 10px 20px; border-radius: 8px; border: none; font-weight: 600; font-size: 14px; background: #38bdf8; color: #0d0f18; cursor: pointer; transition: 0.3s;">
            <i class="fas fa-book-open"></i> Materi & Soal
        </button>
        
        <a href="{{ route('admin.peserta.index') }}" style="padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 14px; background: rgba(255,255,255,0.03); color: #8a90a6; border: 1px solid rgba(255,255,255,0.05); transition: 0.3s;" onmouseover="this.style.color='#fff';this.style.background='rgba(255,255,255,0.08)'" onmouseout="this.style.color='#8a90a6';this.style.background='rgba(255,255,255,0.03)'">
            <i class="fas fa-users"></i> Data Peserta
        </a>

        <button onclick="switchTab('statistik')" id="btn-statistik" style="padding: 10px 20px; border-radius: 8px; border: 1px solid rgba(255,255,255,0.05); font-weight: 600; font-size: 14px; background: rgba(255,255,255,0.03); color: #8a90a6; cursor: pointer; transition: 0.3s;">
            <i class="fas fa-chart-line"></i> Live Statistik
        </button>
    </div>

    <div id="tab-materi-content">
        <div class="card">
            <h2>📤 Upload Soal Ujian (Excel)</h2>
            <p style="color: #888; font-size: 14px;">Silakan pilih file Excel (.xlsx) yang berisi format soal, lalu klik tombol di bawah untuk memproses otomatis.<br>
            <b style="color:#38bdf8;">Butuh gambar di soal?</b> Insert gambar langsung ke sel Excel (kolom "gambar") di baris soal yang sesuai — sistem otomatis mendeteksinya. <i>Fitur gambar cuma jalan untuk format .xlsx, bukan .xls/.csv.</i></p>
            <form action="{{ route('admin.upload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="file_excel" style="color: #fff; font-weight: 500;">Pilih File Excel:</label>
                    <input type="file" name="file_excel" id="file_excel" required>
                </div>
                <button type="submit">🚀 Mulai Import Soal</button>
            </form>
        </div>

        <div class="card">
            <h3>📦 Daftar Materi Soal Saat Ini</h3>
            <table>
                <thead>
                    <tr>
                        <th>Nama Materi / Sesi</th>
                        <th>Durasi</th>
                        <th style="text-align: center;">Jumlah Soal</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sessions as $session)
                        <tr>
                            <td style="color: #fff; font-weight: 600;">{{ $session->name }}</td>
                            <td>{{ $session->duration }} Menit</td>
                            <td style="text-align: center;">
                                <span class="badge">{{ $session->questions_count }} Soal</span>
                            </td>
                            <td style="text-align: center;">
                                <form action="{{ route('admin.delete', $session->id) }}" method="POST" onsubmit="return confirm('Yakin mau hapus materi {{ $session->name }} beserta seluruh soalnya?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete">🗑️ Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="padding: 20px; text-align: center; color: #888;">Belum ada materi soal yang di-upload.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div> <div id="tab-statistik-content" style="display: none;">
        
        <div style="display: flex; gap: 20px; margin-bottom: 25px;">
            <div class="card" style="flex: 1; margin-bottom: 0; text-align: center;">
                <h4 style="color: #8a90a6; margin: 0 0 10px 0;">Total Peserta</h4>
                <h2 style="font-size: 2rem; margin: 0; color: #fff;">{{ $totalPeserta }}</h2>
            </div>
            <div class="card" style="flex: 1; margin-bottom: 0; text-align: center;">
                <h4 style="color: #8a90a6; margin: 0 0 10px 0;">Peserta Ujian</h4>
                <h2 style="font-size: 2rem; margin: 0; color: #38bdf8;">{{ $pesertaUjian }}</h2>
            </div>
            <div class="card" style="flex: 1; margin-bottom: 0; text-align: center;">
                <h4 style="color: #8a90a6; margin: 0 0 10px 0;">Rata-Rata Skor</h4>
                <h2 style="font-size: 2rem; margin: 0; color: #10b981;">{{ round($rataRataSkor, 1) }}</h2>
            </div>
        </div>

        <div class="card">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h3 style="margin: 0;">📊 Leaderboard & Hasil Ujian</h3>
                <a href="{{ route('admin.export.nilai') }}" style="background: #10b981; color: #fff; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 700; font-size: 14px; transition: 0.2s; display: inline-flex; align-items: center; gap: 8px;">
                    <i class="fas fa-file-excel"></i> Export Rekap Excel
                </a>
            </div>

            @php
    // Kelompokkan nilai berdasarkan peserta (bukan materi lagi)
    $groupedByPeserta = $rekapNilai->groupBy(fn($n) => $n->peserta->nomor_peserta ?? 'unknown');
@endphp

@forelse($groupedByPeserta as $nomorPeserta => $hasilPeserta)
    @php
        $namaSiswa = $hasilPeserta->first()->peserta->nama ?? '-';
        $pesertaId = $hasilPeserta->first()->peserta_id;
    @endphp
    <div class="card" style="margin-bottom: 20px; background: #1e2235;">
        <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 10px;">
            <div>
                <h3 style="color: #38bdf8; margin-bottom: 4px;">👤 {{ $namaSiswa }}</h3>
                <p style="color:#8a90a6; font-size:13px; margin-top:0; margin-bottom:15px;">No. Peserta: {{ $nomorPeserta }}</p>
            </div>
            <form action="{{ route('admin.nilai.deleteByPeserta', $pesertaId) }}" method="POST" onsubmit="return confirm('Yakin mau hapus SEMUA hasil ujian milik {{ $namaSiswa }}? Semua materi yang sudah dikerjakan akan terhapus dan tidak bisa dikembalikan.')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-delete"><i class="fas fa-trash-alt"></i> Hapus Semua</button>
            </form>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Materi</th>
                    <th>Waktu Submit</th>
                    <th style="text-align: center;">Benar/Salah</th>
                    <th style="text-align: right;">Skor</th>
                    <th style="text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($hasilPeserta->sortBy('examSession.name') as $nilai)
                    <tr>
                        <td style="color: #fff; font-weight: 600;">{{ $nilai->examSession->name ?? '-' }}</td>
                        <td style="font-size: 13px; color: #8a90a6;">{{ $nilai->created_at->format('d M Y H:i') }}</td>
                        <td style="text-align: center; font-size: 13px;">
                            <span style="color: #10b981;">{{ $nilai->jawaban_benar }} B</span> /
                            <span style="color: #ef4444;">{{ $nilai->jawaban_salah }} S</span>
                        </td>
                        <td style="text-align: right;">
                            <span class="badge" style="background: {{ $nilai->skor >= 70 ? 'rgba(16, 185, 129, 0.2)' : 'rgba(239, 68, 68, 0.2)' }}; color: {{ $nilai->skor >= 70 ? '#10b981' : '#ef4444' }}; font-weight: 700; padding: 6px 12px; font-size: 15px;">
                                {{ number_format($nilai->skor, 2) }}
                            </span>
                        </td>
                        <td style="text-align: center;">
                            <form action="{{ route('admin.nilai.delete', $nilai->id) }}" method="POST" onsubmit="return confirm('Hapus hasil {{ $nilai->examSession->name ?? '' }} milik {{ $namaSiswa }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete">🗑️ Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@empty
    <div class="card" style="text-align: center; color: #888; padding: 30px;">
        Belum ada peserta yang menyelesaikan ujian.
    </div>
@endforelse
        </div>
    </div> </div> 
    <script>
// 1. Fungsi untuk mengganti tampilan tab
function switchTab(tab) {
    const btnMateri = document.getElementById('btn-materi');
    const btnStat = document.getElementById('btn-statistik');
    const contentMateri = document.getElementById('tab-materi-content');
    const contentStat = document.getElementById('tab-statistik-content');

    if (tab === 'materi') {
        contentMateri.style.display = 'block';
        contentStat.style.display = 'none';
        
        btnMateri.style.background = '#38bdf8';
        btnMateri.style.color = '#0d0f18';
        btnMateri.style.border = 'none';
        
        btnStat.style.background = 'rgba(255,255,255,0.03)';
        btnStat.style.color = '#8a90a6';
        btnStat.style.border = '1px solid rgba(255,255,255,0.05)';
    } else {
        contentStat.style.display = 'block';
        contentMateri.style.display = 'none';
        
        btnStat.style.background = '#38bdf8';
        btnStat.style.color = '#0d0f18';
        btnStat.style.border = 'none';
        
        btnMateri.style.background = 'rgba(255,255,255,0.03)';
        btnMateri.style.color = '#8a90a6';
        btnMateri.style.border = '1px solid rgba(255,255,255,0.05)';
    }
}

// 2. Kode ini diletakkan di LUAR fungsi switchTab agar otomatis jalan saat web dibuka
document.addEventListener('DOMContentLoaded', function() {
    // Ambil parameter '?tab=' dari URL browser
    const urlParams = new URLSearchParams(window.location.search);
    const tabTerpilih = urlParams.get('tab');
    
    // Jika parameternya adalah statistik, otomatis ganti tab ke statistik
    if (tabTerpilih === 'statistik') {
        switchTab('statistik');
    } else {
        switchTab('materi'); // Default awal halaman dibuka
    }
});
</script>
