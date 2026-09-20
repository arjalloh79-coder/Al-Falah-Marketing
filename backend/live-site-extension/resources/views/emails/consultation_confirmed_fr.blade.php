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
            <h1>Rendez-vous Confirmé!</h1>
        </div>
        <div class="content">
            <p>Bonjour <strong>{{ $consultation->name }}</strong>,</p>
            <p>Bonne nouvelle! Votre demande de consultation a été officiellement <strong>Confirmée</strong>. Notre équipe est ravie de discuter de votre projet avec vous.</p>
            
            <div class="details">
                <p><strong>Sujet:</strong> {{ $consultation->subject }}</p>
                <p><strong>Date prévue:</strong> {{ date('d F Y', strtotime($consultation->meeting_date)) }}</p>
            </div>

            <p>Nous vous enverrons un lien de réunion ou vous contacterons directement à la date prévue. Si vous avez des questions avant cela, n'hésitez pas à répondre à cet email.</p>
            
            <p>Cordialement,<br><strong>L'équipe Al-Falah Digital Marketing</strong></p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Agence de Marketing Digital Al-Falah. Tous droits réservés.</p>
        </div>
    </div>
</body>
</html>