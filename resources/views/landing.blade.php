<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-bimtes.png') }}" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerbang Ujian - CBT BIMTES</title>
    <link href="https://fonts.googleapis.com/css2 family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { box-sizing: border-box; }

        body {
            background-color: #07080d;
            background-image:
                radial-gradient(circle at 15% 10%, rgba(56, 189, 248, 0.12), transparent 40%),
                radial-gradient(circle at 85% 90%, rgba(16, 185, 129, 0.10), transparent 45%),
                radial-gradient(circle at 50% 50%, rgba(99, 102, 241, 0.06), transparent 60%);
            color: #ccc;
            font-family: 'Plus Jakarta Sans', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .container { width: 100%; max-width: 500px; padding: 20px; }

        .card {
            background: linear-gradient(160deg, #181c2e 0%, #12141f 100%);
            padding: 40px 35px;
            border-radius: 20px;
            border: 1px solid rgba(255,255,255,0.08);
            box-shadow:
                0 20px 50px rgba(0,0,0,0.45),
                0 0 0 1px rgba(255,255,255,0.02) inset,
                0 1px 0 rgba(255,255,255,0.05) inset;
            text-align: center;
            position: relative;
            overflow: hidden;
            animation: fadeInUp 0.5s ease;
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, #38bdf8, #818cf8, #10b981);
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h1 {
            color: #fff;
            font-size: 1.9rem;
            font-weight: 700;
            margin-bottom: 5px;
            letter-spacing: -0.5px;
        }

        h1 i {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(56,189,248,0.18), rgba(56,189,248,0.04));
            color: #38bdf8 !important;
            font-size: 1.5rem;
            margin-bottom: 14px !important;
            box-shadow: 0 0 24px rgba(56, 189, 248, 0.25);
        }

        p.subtitle { color: #8a90a6; font-size: 14px; margin-top: 0; margin-bottom: 25px; line-height: 1.5; }

        .alert {
            padding: 12px 14px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-weight: 600;
            font-size: 14px;
            text-align: left;
            box-shadow: 0 6px 16px rgba(0,0,0,0.25);
        }
        .alert-success { background: linear-gradient(135deg, #10b981, #0ea271); color: #fff; }
        .alert-error { background: linear-gradient(135deg, #ef4444, #dc2626); color: #fff; }

        .form-group { margin-bottom: 20px; text-align: left; }
        label { display: block; color: #fff; font-size: 14px; font-weight: 500; margin-bottom: 8px; }

        input[type="text"] {
            width: 100%;
            padding: 13px;
            background: #1a1e30;
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 10px;
            color: #fff;
            font-size: 16px;
            font-family: 'JetBrains Mono', monospace;
            text-align: center;
            letter-spacing: 2px;
            transition: 0.2s;
        }
        input[type="text"]::placeholder { color: #4b5066; letter-spacing: 1px; }
        input[type="text"]:focus {
            outline: none;
            border-color: #38bdf8;
            background: #1e2336;
            box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.15), 0 0 16px rgba(56, 189, 248, 0.15);
        }

        button {
            width: 100%;
            background: linear-gradient(135deg, #38bdf8, #2dd4bf);
            color: #06131c;
            border: none;
            padding: 14px;
            border-radius: 10px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.25s;
            font-size: 15px;
            letter-spacing: 0.2px;
            box-shadow: 0 8px 20px rgba(56, 189, 248, 0.25);
        }
        button:hover { background: linear-gradient(135deg, #7dd3fc, #5eead4); transform: translateY(-1px); box-shadow: 0 10px 24px rgba(56, 189, 248, 0.35); }
        button:active { transform: translateY(0); }

        /* STYLE KETIKA SUDAH LOGIN */
        .welcome-box {
            background: linear-gradient(135deg, rgba(56, 189, 248, 0.08), rgba(16, 185, 129, 0.05));
            border: 1px solid rgba(56, 189, 248, 0.25);
            padding: 18px;
            border-radius: 14px;
            margin-bottom: 25px;
            text-align: left;
            position: relative;
        }
        .materi-list { display: flex; flex-direction: column; gap: 12px; text-align: left; }

        .materi-item {
            background: #181c2c;
            padding: 16px;
            border-radius: 12px;
            border: 1px solid rgba(255,255,255,0.06);
            display: flex;
            justify-content: space-between;
            align-items: center;
            text-decoration: none;
            transition: 0.25s;
        }
        .materi-item:hover {
            border-color: rgba(56, 189, 248, 0.4);
            background: #1f2438;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
        }
        .materi-info h4 { color: #fff; margin: 0 0 4px 0; font-size: 15px; font-weight: 600; }
        .materi-info span { color: #8a90a6; font-size: 12px; }

        .btn-start {
            width: auto;
            background: linear-gradient(135deg, #10b981, #059669);
            color: #fff;
            padding: 9px 16px;
            font-size: 13px;
            font-weight: 600;
            border-radius: 8px;
            text-decoration: none;
            transition: 0.2s;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
        }
        .btn-start:hover { background: linear-gradient(135deg, #34d399, #10b981); transform: translateY(-1px); }

        .btn-logout-siswa {
            background: transparent;
            color: #ef4444;
            border: none;
            padding: 0;
            font-weight: 600;
            font-size: 13px;
            cursor: pointer;
            text-decoration: underline;
            margin-top: 18px;
            width: auto;
            transition: 0.2s;
        }
        .btn-logout-siswa:hover { color: #f87171; }

        .admin-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-top: 28px;
            color: #4b5066;
            text-decoration: none;
            font-size: 12px;
            transition: 0.2s;
        }
        .admin-link:hover { color: #38bdf8; }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <h1><img src="{{ asset('images/logo-bimtes.png') }}" alt="Logo BIMTES Universal" style="width: 64px; height: 64px; object-fit: contain; margin-bottom: 10px;"><br>CBT BIMTES</h1>
            
            @if(session('success'))
                <div class="alert alert-success">✓ {{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-error">❌ {{ session('error') }}</div>
            @endif

            @if(!session()->has('peserta_id'))
                <p class="subtitle">Silakan masukkan Nomor Peserta resmi Anda untuk memulai ujian bimbingan tes.</p>
                
                <form action="{{ route('peserta.login') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label style="text-align: center;">Nomor Login Peserta:</label>
                        <input type="text" name="nomor_peserta" placeholder="CBT-{{ date('Y') }}-X-XXX" required autocomplete="off">
                    </div>
                    <button type="submit">Verifikasi & Masuk Sesi</button>
                </form>
                
                <a href="/login-admin" class="admin-link"><i class="fas fa-lock"></i> Login Dashboard Admin</a>

            @else
                <div class="welcome-box">
                    <div style="font-size: 12px; color: #38bdf8; font-weight: 600;">PESERTA AKTIF:</div>
                    <div style="font-size: 18px; color: #fff; font-weight: 700; margin: 2px 0;">{{ session('peserta_nama') }}</div>
                    <div style="font-size: 13px; color: #8a90a6; font-family: monospace;">ID: {{ session('peserta_nomor') }}</div>
                </div>

                <p class="subtitle" style="text-align: left; margin-bottom: 15px; color: #fff; font-weight: 600;"><i class="fas fa-book"></i> Pilih Materi Ujian Tersedia :</p>
                
                <div class="materi-list">
                    @forelse($materiUjian as $materi)
                        <div class="materi-item">
                            <div class="materi-info">
                                <h4>{{ $materi->name }}</h4>
                                <span><i class="far fa-clock"></i> {{ $materi->duration }} Menit &nbsp;|&nbsp; <i class="far fa-file-alt"></i> {{ $materi->questions_count }} Soal</span>
                            </div>
                            <a href="{{ url('/ujian') }}?session_id={{ $materi->id }}" class="btn-start">Mulai <i class="fas fa-chevron-right"></i></a>
                        </div>
                    @empty
                        <div style="text-align: center; color: #555; padding: 20px; font-size: 14px;">Belum ada materi ujian yang dirilis oleh Admin.</div>
                    @endforelse
                </div>

                <form action="{{ route('peserta.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-logout-siswa"><i class="fas fa-sign-out-alt"></i> Bukan akun saya? Keluar</button>
                </form>
            @endif
        </div>
    </div>
</body>
</html>