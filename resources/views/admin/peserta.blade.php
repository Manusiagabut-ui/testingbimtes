<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-bimtes.png') }}" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Peserta - CBT BIMTES</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #0d0f18; color: #ccc; font-family: 'Plus Jakarta Sans', sans-serif; margin: 0; padding: 40px; }
        .container { max-width: 1000px; margin: 0 auto; }
        
        .admin-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; border-bottom: 1px solid rgba(255,255,255,0.05); padding-bottom: 15px; }
        .admin-header h1 { color: #fff; font-size: 1.8rem; font-weight: 700; margin: 0; }
        
        .admin-tabs { display: flex; gap: 10px; margin-bottom: 25px; }
        .tab-item { padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 14px; transition: 0.3s; }
        .tab-item.inactive { background: rgba(255,255,255,0.03); color: #8a90a6; border: 1px solid rgba(255,255,255,0.05); }
        .tab-item.inactive:hover { background: rgba(255,255,255,0.08); color: #fff; }
        .tab-item.active { background: #38bdf8; color: #0d0f18; }
        
        .btn-logout { background: transparent; color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.3); padding: 8px 16px; border-radius: 8px; font-weight: 600; cursor: pointer; transition: 0.3s; }
        .btn-logout:hover { background: #ef4444; color: #fff; }

        .grid-layout { display: grid; grid-template-columns: 1fr 2fr; gap: 25px; }
        @media(max-width: 768px) { .grid-layout { grid-template-columns: 1fr; } }

        .card { background: #161927; padding: 25px; border-radius: 12px; border: 1px solid rgba(255,255,255,0.07); height: fit-content; }
        h3 { color: #fff; margin-top: 0; margin-bottom: 15px; font-size: 1.2rem; }
        
        .alert { padding: 12px 20px; border-radius: 8px; margin-bottom: 20px; font-weight: 600; font-size: 14px; }
        .alert-success { background: #10b981; color: #fff; }
        .alert-error { background: #ef4444; color: #fff; }
        
        .form-group { margin-bottom: 15px; }
        label { display: block; color: #fff; font-size: 14px; font-weight: 500; margin-bottom: 6px; }
        input[type="text"], input[type="number"], input[type="file"], select { width: 100%; padding: 10px 12px; background: #1e2235; border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: #fff; box-sizing: border-box; font-size: 14px; }
        input:focus, select:focus { outline: none; border-color: #38bdf8; }
        select option { background: #161927; color: #fff; }
        
        button.btn-block { width: 100%; display: block; }
        button { background: #38bdf8; color: #0d0f18; border: none; padding: 11px 20px; border-radius: 8px; font-weight: 700; cursor: pointer; transition: 0.2s; font-size: 14px; }
        button:hover { background: #7dd3fc; }
        
        .table-container { max-height: 500px; overflow-y: auto; }
        table { width: 100%; border-collapse: collapse; text-align: left; }
        tr { border-bottom: 1px solid rgba(255,255,255,0.05); }
        th { padding: 12px; color: #fff; border-bottom: 2px solid rgba(255,255,255,0.1); font-size: 14px; }
        td { padding: 12px; font-size: 14px; }
        
        .btn-delete { background: #ef4444; color: #fff; padding: 5px 10px; border-radius: 6px; font-size: 12px; font-weight: 600; cursor: pointer; border: none; }
        .btn-delete:hover { background: #f87171; }
    </style>
</head>
<body>
    <div class="container">
        
        <div class="admin-header">
            <h1><i class="fas fa-user-shield"></i> Panel Kendali Admin</h1>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout"><i class="fas fa-sign-out-alt"></i> Keluar / Logout</button>
            </form>
        </div>

        <div class="admin-tabs">
            <a href="{{ route('admin.dashboard') }}?tab=materi" class="tab-item inactive"><i class="fas fa-book-open"></i> Materi & Soal</a>
            
            <a href="{{ route('admin.peserta.index') }}" class="tab-item active"><i class="fas fa-users"></i> Data Peserta</a>
            
            <a href="{{ route('admin.dashboard') }}?tab=statistik" class="tab-item inactive"><i class="fas fa-chart-line"></i> Live Statistik</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">✓ {{ session('success') }}</div>
        @endif
        @if(session('error') || $errors->any())
            <div class="alert alert-error">❌ {{ session('error') ?? $errors->first() }}</div>
        @endif

        <div class="grid-layout">
            <div>
                <div class="card" style="margin-bottom: 25px;">
                    <h3><i class="fas fa-file-excel" style="color: #10b981;"></i> Upload Excel Peserta</h3>
                    <p style="color: #888; font-size: 12px; margin-top: 0; line-height: 1.5;">
                        Sistem akan menggenerate Nomor otomatis. Aturan kolom Excel:<br>
                        <strong>Kolom A:</strong> Nama Lengkap<br>
                        <strong>Kolom B:</strong> Gender (Ketik: <code style="color:#38bdf8">L</code> atau <code style="color:#ef4444">P</code>)<br>
                        <strong>Kolom C:</strong> Angka Urutan Absen (Contoh: <code style="color:#10b981">1</code>, <code style="color:#10b981">2</code>)
                    </p>
                    <form action="{{ route('admin.peserta.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="file" name="file_excel" required>
                        </div>
                        <button type="submit" class="btn-block">🚀 Import & Generate Kode</button>
                    </form>
                </div>

                <div class="card">
                    <h3><i class="fas fa-user-plus" style="color: #38bdf8;"></i> Tambah Manual</h3>
                    <form action="{{ route('admin.peserta.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" name="nama" placeholder="Contoh: Ahmad Subagja" required>
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select name="jenis_kelamin" required>
                                <option value="" disabled selected>-- Pilih Gender --</option>
                                <option value="1">Laki-laki (Kode: 1)</option>
                                <option value="2">Perempuan (Kode: 2)</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nomor Urut Absen</label>
                            <input type="number" name="no_absen" placeholder="Contoh: 1 atau 15" min="1" required>
                        </div>
                        <button type="submit" class="btn-block">➕ Generate & Tambah</button>
                    </form>
                </div>
            </div>

            <div class="card">
                <h3><i class="fas fa-list"></i> Daftar Peserta Terdaftar ({{ count($pesertas) }} Orang)</h3>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Nomor Peserta (Auto)</th>
                                <th>Nama Lengkap</th>
                                <th style="text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pesertas as $peserta)
                                <tr>
                                    <td style="color: #38bdf8; font-weight: 600; font-family: monospace; font-size: 15px;">{{ $peserta->nomor_peserta }}</td>
                                    <td style="color: #fff;">{{ $peserta->nama }}</td>
                                    <td style="text-align: center;">
                                        <form action="{{ route('admin.peserta.destroy', $peserta->id) }}" method="POST" onsubmit="return confirm('Hapus peserta {{ $peserta->nama }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-delete">🗑️ Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" style="text-align: center; color: #888; padding: 40px 0;">Belum ada data peserta. Silakan coba tambah manual atau upload Excel dengan format baru!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</body>
</html>