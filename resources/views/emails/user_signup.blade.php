<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Welcome to Al-Falah Agency</title>
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
        .details { 
            background-color: #f0f7ff; 
            padding: 20px; 
            border-radius: 8px; 
            margin: 20px 0;
            border-left: 4px solid #3b82f6;
        }
        .details p {
            margin: 8px 0;
            font-size: 15px;
        }
        .details p:first-child {
            margin-top: 0;
        }
        .details p:last-child {
            margin-bottom: 0;
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
        .badge {
            display: inline-block;
            background-color: #d1fae5;
            color: #065f46;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">

        {{-- ===== HEADER ===== --}}
        <div class="header">
            <h1>🎉 Welcome to Al-Falah Agency!</h1>
            <p>We're thrilled to have you on board.</p>
        </div>

        {{-- ===== MAIN CONTENT ===== --}}
        <div class="content">

            <span class="badge">Account Created Successfully</span>

            <p>Hello <strong>{{ $user->name }}</strong>,</p>

            <p>
                Thank you for signing up with <strong>Al-Falah Digital Marketing Agency</strong>. 
                Your account has been created successfully and you're all set to get started.
            </p>

            <p>
                We are committed to helping you grow your business with our expert digital 
                marketing solutions. Our team is here to support you every step of the way.
            </p>

            {{-- ===== ACCOUNT DETAILS ===== --}}
            <div class="details">
                <p><strong>Your Account Details</strong></p>
                <hr style="border: none; border-top: 1px solid #dbeafe; margin: 10px 0;">
                <p><strong>Name:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Member Since:</strong> {{ date('F d, Y') }}</p>
            </div>

            <p>
                If you have any questions or need assistance, feel free to reach out to our 
                support team by replying to this email. We're happy to help!
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
            <p>You are receiving this email because you registered on our platform.</p>
        </div>

    </div>
</body>
</html>