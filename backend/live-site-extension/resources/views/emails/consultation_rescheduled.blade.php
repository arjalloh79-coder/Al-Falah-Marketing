<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Arial', sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #e1e1e1; border-radius: 10px; }
        .header { background-color: #f59e0b; color: white; padding: 20px; text-align: center; border-radius: 10px 10px 0 0; }
        .content { padding: 20px; }
        .details { background-color: #fffbeb; padding: 15px; border-radius: 8px; border: 1px solid #fef3c7; margin: 20px 0; }
        .old-date { text-decoration: line-through; color: #991b1b; }
        .new-date { color: #065f46; font-size: 18px; font-weight: bold; }
        .footer { text-align: center; font-size: 12px; color: #777; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Meeting Re-scheduled</h1>
        </div>
        <div class="content">
            <p>Hello <strong>{{ $consultation->name }}</strong>,</p>
            <p>We are writing to inform you that your upcoming consultation has been <strong>re-scheduled</strong> to a new date.</p>
            
            <div class="details">
                <p><strong>Subject:</strong> {{ $consultation->subject }}</p>
                <p><strong>Previous Date:</strong> <span class="old-date">{{ date('F d, Y', strtotime($old_date)) }}</span></p>
                <p><strong>New Confirmed Date:</strong> <span class="new-date">{{ date('F d, Y', strtotime($consultation->meeting_date)) }}</span></p>
            </div>

            <p>We apologize for any inconvenience this change may cause. If this new time does not work for you, please reply to this email to suggest a better time.</p>
            
            <p>See you soon,<br><strong>Al-Falah Digital Marketing Team</strong></p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Al-Falah Digital Marketing Agency. All rights reserved.</p>
        </div>
    </div>
</body>
</html>