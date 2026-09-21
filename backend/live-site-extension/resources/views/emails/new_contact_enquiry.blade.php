<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Contact Enquiry</title>
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
        .header p {
            margin: 5px 0 0;
            font-size: 14px;
            opacity: 0.9;
        }
        .content {
            padding: 30px;
        }
        .field {
            margin: 0 0 16px;
        }
        .field-label {
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #999;
            margin: 0 0 4px;
        }
        .field-value {
            font-size: 15px;
            margin: 0;
        }
        .message-box {
            background-color: #f9fafb;
            border-left: 4px solid #3b82f6;
            padding: 15px;
            border-radius: 4px;
            white-space: pre-wrap;
        }
        .button-wrap {
            text-align: center;
            margin: 25px 0 5px;
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
            <h1>📬 New Contact Enquiry</h1>
            <p>Al-Falah Digital Marketing Agency</p>
        </div>

        <div class="content">

            <div class="field">
                <p class="field-label">From</p>
                <p class="field-value">{{ $enquiry->first_name }} {{ $enquiry->last_name }} &lt;{{ $enquiry->email }}&gt;</p>
            </div>

            @if ($enquiry->phone)
            <div class="field">
                <p class="field-label">Phone</p>
                <p class="field-value">{{ $enquiry->phone }}</p>
            </div>
            @endif

            <div class="field">
                <p class="field-label">Service Interest</p>
                <p class="field-value">{{ $enquiry->service_interest }}</p>
            </div>

            <div class="field">
                <p class="field-label">Message</p>
                <p class="message-box">{{ $enquiry->message }}</p>
            </div>

            <div class="button-wrap">
                <a href="{{ url('/admin/contacts') }}" class="button">View in Admin Panel</a>
            </div>

        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} Al-Falah Digital Marketing Agency. Sent because someone submitted the contact form on your website.</p>
        </div>

    </div>
</body>
</html>
