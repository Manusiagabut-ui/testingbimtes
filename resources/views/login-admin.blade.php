<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-bimtes.png') }}" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - CBT BIMTES</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --bg: #07080d;
            --surface: #181420;
            --primary: #ef4444; /* Merah neon khusus tanda admin */
            --primary-light: #f87171;
            --primary-glow: rgba(239, 68, 68, 0.25);
            --text: #ffffff;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            background-color: var(--bg);
            background-image:
                radial-gradient(circle at 20% 15%, rgba(239, 68, 68, 0.14), transparent 40%),
                radial-gradient(circle at 80% 85%, rgba(168, 85, 247, 0.08), transparent 45%);
            color: var(--text);
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .login-box {
            max-width: 400px;
            width: 100%;
            background: linear-gradient(160deg, #1b1622 0%, #130f18 100%);
            padding: 42px 32px;
            border-radius: 18px;
            border: 1px solid rgba(255,255,255,0.07);
            box-shadow:
                0 24px 50px rgba(0,0,0,0.5),
                0 0 0 1px rgba(255,255,255,0.02) inset,
                0 1px 0 rgba(255,255,255,0.05) inset;
            text-align: center;
            position: relative;
            overflow: hidden;
            animation: fadeInUp 0.5s ease;
        }

        .login-box::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, #ef4444, #f97316, #ef4444);
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .lock-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(239,68,68,0.18), rgba(239,68,68,0.04));
            font-size: 1.7rem;
            color: var(--primary);
            margin-bottom: 18px;
            box-shadow: 0 0 26px var(--primary-glow);
        }

        h2 { font-size: 1.6rem; font-weight: 700; margin-bottom: 8px; letter-spacing: -0.3px; }
        p { color: #8a90a6; font-size: 0.9rem; margin-bottom: 25px; }

        .form-group { text-align: left; margin-bottom: 20px; position: relative; }
        .form-group i { position: absolute; left: 15px; top: 40px; color: #5a5f78; transition: 0.2s; }

        label { display: block; font-size: 0.85rem; font-weight: 600; color: #c4b5fd; margin-bottom: 8px; letter-spacing: 0.3px; }
        input[type="password"] {
            width: 100%;
            background: #0c0a10;
            border: 1px solid rgba(255,255,255,0.08);
            padding: 13px 15px 13px 42px;
            border-radius: 10px;
            color: #fff;
            font-size: 1rem;
            letter-spacing: 1px;
            transition: 0.25s;
        }
        input[type="password"]:focus {
            outline: none;
            border-color: var(--primary);
            background: #150f15;
            box-shadow: 0 0 0 3px var(--primary-glow), 0 0 18px var(--primary-glow);
        }
        input[type="password"]:focus + i,
        .form-group:focus-within i { color: var(--primary); }

        .btn-submit {
            width: 100%;
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
            border: none;
            padding: 15px;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 700;
            letter-spacing: 0.2px;
            cursor: pointer;
            transition: 0.25s;
            margin-top: 10px;
            box-shadow: 0 8px 20px var(--primary-glow);
        }
        .btn-submit:hover {
            background: linear-gradient(135deg, #f87171, #ef4444);
            transform: translateY(-2px);
            box-shadow: 0 12px 26px var(--primary-glow);
        }
        .btn-submit:active { transform: translateY(0); }

        .alert {
            background: linear-gradient(135deg, #ef4444, #b91c1c);
            padding: 12px 14px;
            border-radius: 10px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 20px;
            text-align: left;
            box-shadow: 0 6px 16px rgba(0,0,0,0.3);
        }
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-top: 22px;
            color: #6b7088;
            text-decoration: none;
            font-size: 0.85rem;
            transition: 0.2s;
        }
        .back-link:hover { color: #fff; }
    </style>
</head>
<body>

    <div class="login-box">
        <div class="lock-icon"><i class="fas fa-user-lock"></i></div>
        <h2>Panel Keamanan Admin</h2>
        <p>Masukkan kata sandi rahasia untuk masuk</p>

        @if(session('error'))
            <div class="alert"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>KATA SANDI ADMIN</label>
                <i class="fas fa-key"></i>
                <input type="password" name="password" placeholder="••••••••••••" required autofocus>
            </div>
            <button type="submit" class="btn-submit">Buka Akses Dashboard →</button>
        </form>

        <a href="{{ route('landing') }}" class="back-link"><i class="fas fa-arrow-left"></i> Kembali ke Menu Utama</a>
    </div>

</body>
</html>