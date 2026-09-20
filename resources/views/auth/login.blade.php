<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Bank Sampah Resik Berdaya</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            background-color: #f4f6f9;
        }

        .login-container {
            display: flex;
            width: 100%;
            min-height: 100vh;
        }

        /* Left Panel - Image */
        .left-panel {
            flex: 1;
            position: relative;
            background: #153834;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 40px;
            overflow: hidden;
            min-height: 500px;
        }

        .left-panel::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
           background: url("{{ asset('assets/sampahtumbuhan.jpg') }}") center / cover no-repeat;
            opacity: 0.5;
        }

        .left-panel-content {
            position: relative;
            z-index: 2;
        }

        .brand-header {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .recycle-icon {
            width: 48px;
            height: 48px;
            fill: white;
        }

        .brand-name {
            color: white;
            font-size: 22px;
            font-weight: 700;
            line-height: 1.2;
        }

        .brand-name span {
            display: block;
            font-size: 14px;
            font-weight: 400;
            opacity: 0.9;
        }

        .tagline {
            color: white;
            font-size: 20px;
            font-weight: 600;
            line-height: 1.5;
            margin-top: 20px;
            max-width: 280px;
        }

        .left-image {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 60%;

            opacity: 0.85;
        }

        .left-panel-bottom {
            position: relative;
            z-index: 2;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            padding-bottom: 20px;
        }

        .bottom-recycle {
            width: 60px;
            height: 60px;
            fill: white;
            opacity: 0.9;
        }

        /* Right Panel - Form */
        .right-panel {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
            background: white;
        }

        .form-wrapper {
            width: 100%;
            max-width: 420px;
        }

        .form-header {
            margin-bottom: 32px;
        }

        .form-header h1 {
            font-size: 28px;
            font-weight: 700;
            color: #1a1a2e;
            margin-bottom: 8px;
        }

        .form-header p {
            color: #6c757d;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #1a1a2e;
            font-size: 14px;
        }

        .input-wrapper {
            position: relative;
        }

        .form-group input {
            width: 100%;
            padding: 12px 16px;
            border: 1.5px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
            background: #fafafa;
            color: #333;
        }

        .form-group input:focus {
            outline: none;
            border-color: #2d6a4f;
            background: white;
            box-shadow: 0 0 0 3px rgba(45, 106, 79, 0.1);
        }

        .form-group input::placeholder {
            color: #adb5bd;
        }

        .toggle-password {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #6c757d;
            padding: 4px;
            display: flex;
            align-items: center;
        }

        .toggle-password svg {
            width: 20px;
            height: 20px;
        }

        .btn-masuk {
            width: 100%;
            padding: 14px;
            background:#153834;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 700;
            font-size: 16px;
            transition: all 0.3s ease;
            margin-top: 8px;
            letter-spacing: 0.5px;
        }

        .btn-masuk:hover {
            background: linear-gradient(135deg, #1b4332 0%, #2d6a4f 100%);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(45, 106, 79, 0.3);
        }

        .btn-masuk:active {
            transform: translateY(0);
        }

        .forgot-link {
            display: inline-block;
            margin-top: 16px;
            color: #153834;
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            transition: color 0.2s;
        }

        .forgot-link:hover {
            color: #1b4332;
            text-decoration: underline;
        }

        .form-footer {
            margin-top: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            color: #6c757d;
            font-size: 12px;
        }

        .form-footer svg {
            width: 20px;
            height: 20px;
            fill: #2d6a4f;
        }

        .error {
            background: #fff5f5;
            color: #c53030;
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 20px;
            border-left: 3px solid #c53030;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
            }

            .left-panel {
                min-height: 220px;
                padding: 24px;
                flex: none;
            }

            .brand-name {
                font-size: 18px;
            }

            .tagline {
                font-size: 16px;
                margin-top: 12px;
            }

            .left-image {
                display: none;
            }

            .right-panel {
                padding: 32px 24px;
                flex: 1;
            }

            .form-header h1 {
                font-size: 24px;
            }

            .bottom-recycle {
                width: 40px;
                height: 40px;
            }
        }

        @media (max-width: 480px) {
            .left-panel {
                padding: 20px;
                min-height: 180px;
            }

            .brand-header {
                gap: 8px;
            }

            .recycle-icon {
                width: 36px;
                height: 36px;
            }

            .brand-name {
                font-size: 16px;
            }

            .tagline {
                font-size: 14px;
            }

            .right-panel {
                padding: 24px 20px;
            }

            .form-header h1 {
                font-size: 22px;
            }
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-wrapper {
            animation: fadeInUp 0.6s ease;
        }

        .left-panel-content {
            animation: fadeInUp 0.6s ease 0.2s both;
        }
    </style>
</head>
<body>

<div class="login-container">
    <!-- Left Panel -->
    <div class="left-panel">
        <div class="left-panel-content">

        <div class="brand-icon">
            ♻

                <div class="brand-name">
                    Bank Sampah
                    <span>Resik Berdaya</span>
                </div>
            </div>
            <div class="tagline">
                Sampah hari ini,<br>berkah untuk esok
            </div>
        </div>
        <div class="left-image"></div>
        <div class="left-panel-bottom">
            <svg class="bottom-recycle" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">

            </svg>
        </div>
    </div>

    <!-- Right Panel -->
    <div class="right-panel">
        <div class="form-wrapper">
            <div class="form-header">
                <h1>Selamat Datang</h1>
                <p>Silakan masuk untuk melanjutkan</p>
            </div>

            @if ($errors->any())
                <div class="error">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login.process') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email">Username / Email</label>
                    <input type="text" name="email" id="email" value="{{ old('email') }}" placeholder="Masukkan username atau email" required autofocus>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <input type="password" name="password" id="password" placeholder="Masukkan password" required>
                        <button type="button" class="toggle-password" onclick="togglePassword()">
                            <svg id="eye-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-masuk">Masuk</button>
            </form>

            <a href="#" class="forgot-link">Lupa password?</a>

            <div class="form-footer">

        <div class="brand-icon">
            ♻
        </div>
                <span>Bank Sampah Resik Berdaya</span>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eye-icon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.innerHTML = '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line>';
        } else {
            passwordInput.type = 'password';
            eyeIcon.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle>';
        }
    }
</script>

</body>
</html>
