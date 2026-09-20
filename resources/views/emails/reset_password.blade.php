<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reset Your Al-Falah Password</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 0;
            border: 1px solid #e1e1e1;
            border-radius: 10px;
            overflow: hidden;
            background-color: #ffffff;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }
        .header {
            background-color: #3b82f6;
            color: white;
            padding: 30px 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 26px;
            letter-spacing: 1px;
        }
        .header p {
            margin: 5px 0 0;
            font-size: 14px;
            opacity: 0.9;
        }
        .content {
            padding: 30px;
        }
        .content p {
            margin: 0 0 15px;
            font-size: 15px;
        }
        .button-wrap {
            text-align: center;
            margin: 25px 0;
        }
        .button {
            display: inline-block;
            background-color: #3b82f6;
            color: #ffffff !important;
            text-decoration: none;
            padding: 14px 32px;
            border-radius: 8px;
            font-weight: bold;
            font-size: 15px;
        }
        .fallback-link {
            font-size: 13px;
            color: #666;
            word-break: break-all;
        }
        .divider {
            border: none;
            border-top: 1px solid #e1e1e1;
            margin: 25px 0;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #999;
            padding: 20px 30px;
            background-color: #f9fafb;
            border-top: 1px solid #e1e1e1;
        }
        .footer p {
            margin: 4px 0;
        }
    </style>
</head>
<body>
    <div class="container">

        {{-- ===== HEADER ===== --}}
        <div class="header">
            <h1>🔒 Password Reset Request</h1>
            <p>Al-Falah Digital Marketing Agency</p>
        </div>

        {{-- ===== MAIN CONTENT ===== --}}
        <div class="content">

            <p>Hello <strong>{{ $user->name }}</strong>,</p>

            <p>
                We received a request to reset the password for your Al-Falah account.
                Click the button below to choose a new password.
            </p>

            <div class="button-wrap">
                <a href="{{ $resetUrl }}" class="button">Reset My Password</a>
            </div>

            <p>
                This link will expire in 60 minutes. If you didn't request a password
                reset, you can safely ignore this email — your password will remain
                unchanged.
            </p>

            <p class="fallback-link">
                If the button above doesn't work, copy and paste this link into your browser:<br>
                {{ $resetUrl }}
            </p>

            <hr class="divider">

            <p>
                Best Regards,<br>
                <strong>Al-Falah Digital Marketing Team</strong>
            </p>

        </div>

        {{-- ===== FOOTER ===== --}}
        <div class="footer">
            <p>&copy; {{ date('Y') }} Al-Falah Digital Marketing Agency. All rights reserved.</p>
            <p>You are receiving this email because a password reset was requested for your account.</p>
        </div>

    </div>
</body>
</html>
