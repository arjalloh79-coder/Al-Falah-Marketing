<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Arial', sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #e1e1e1; border-radius: 10px; }
        .header { background-color: #3b82f6; color: white; padding: 20px; text-align: center; border-radius: 10px 10px 0 0; }
        .content { padding: 20px; }
        .details { background-color: #f9fafb; padding: 15px; border-radius: 8px; margin: 20px 0; }
        .footer { text-align: center; font-size: 12px; color: #777; margin-top: 20px; }
        .btn { display: inline-block; padding: 10px 20px; background-color: #3b82f6; color: white; text-decoration: none; border-radius: 5px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Meeting Confirmed!</h1>
        </div>
        <div class="content">
            <p>Hello <strong>{{ $consultation->name }}</strong>,</p>
            <p>Great news! Your consultation request has been officially <strong>Confirmed</strong>. Our team is excited to speak with you about your project.</p>
            
            <div class="details">
                <p><strong>Topic:</strong> {{ $consultation->subject }}</p>
                <p><strong>Scheduled Date:</strong> {{ date('F d, Y', strtotime($consultation->meeting_date)) }}</p>
            </div>

            <p>We will send you a meeting link or contact you directly on the scheduled date. If you have any questions before then, feel free to reply to this email.</p>
            
            <p>Best Regards,<br><strong>Al-Falah Digital Marketing Team</strong></p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Al-Falah Digital Marketing Agency. All rights reserved.</p>
        </div>
    </div>
</body>
</html>