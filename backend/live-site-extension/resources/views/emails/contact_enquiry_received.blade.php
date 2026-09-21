<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>We received your message</title>
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
            font-size: 24px;
            letter-spacing: 1px;
        }
        .content {
            padding: 30px;
        }
        .content p {
            margin: 0 0 15px;
            font-size: 15px;
        }
        .message-box {
            background-color: #f9fafb;
            border-left: 4px solid #3b82f6;
            padding: 15px;
            border-radius: 4px;
            white-space: pre-wrap;
            font-size: 14px;
            color: #555;
            margin: 0 0 20px;
        }
        .button-wrap {
            text-align: center;
            margin: 25px 0 5px;
        }
        .button {
            display: inline-block;
            background-color: #25D366;
            color: #ffffff !important;
            text-decoration: none;
            padding: 14px 32px;
            border-radius: 8px;
            font-weight: bold;
            font-size: 15px;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #999;
            padding: 20px 30px;
            background-color: #f9fafb;
            border-top: 1px solid #e1e1e1;
        }
    </style>
</head>
<body>
    <div class="container">

        <div class="header">
            <h1>✅ Message Received</h1>
            <p>Al-Falah Digital Marketing Agency</p>
        </div>

        <div class="content">

            <p>Hello <strong>{{ $enquiry->first_name }}</strong>,</p>

            <p>
                Thanks for reaching out about <strong>{{ $enquiry->service_interest }}</strong>.
                We've received your message and a member of our team will get back to you
                within <strong>24 hours</strong>.
            </p>

            <p>For your records, here's what you sent us:</p>

            <p class="message-box">{{ $enquiry->message }}</p>

            <p>Need a faster answer? Message us directly on WhatsApp:</p>

            <div class="button-wrap">
                <a href="{{ \App\Support\Contact::whatsappUrl(null, 'en') }}" class="button">Chat on WhatsApp</a>
            </div>

        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} Al-Falah Digital Marketing Agency. All rights reserved.</p>
        </div>

    </div>
</body>
</html>
