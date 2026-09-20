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
            <h1>Rendez-vous Reprogrammé</h1>
        </div>
        <div class="content">
            <p>Bonjour <strong>{{ $consultation->name }}</strong>,</p>
            <p>Nous vous informons que votre prochaine consultation a été <strong>reprogrammée</strong> à une nouvelle date.</p>
            
            <div class="details">
                <p><strong>Sujet:</strong> {{ $consultation->subject }}</p>
                <p><strong>Date précédente:</strong> <span class="old-date">{{ date('d F Y', strtotime($old_date)) }}</span></p>
                <p><strong>Nouvelle date confirmée:</strong> <span class="new-date">{{ date('d F Y', strtotime($consultation->meeting_date)) }}</span></p>
            </div>

            <p>Nous nous excusons pour tout désagrément que ce changement pourrait causer. Si cette nouvelle date ne vous convient pas, veuillez répondre à cet email pour suggérer un meilleur créneau.</p>
            
            <p>À bientôt,<br><strong>L'équipe Al-Falah Digital Marketing</strong></p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Agence de Marketing Digital Al-Falah. Tous droits réservés.</p>
        </div>
    </div>
</body>
</html>