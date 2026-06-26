<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Мобильная версия оплаты</title>
</head>
<body style="margin:0;background:#0f172a;color:white;font-family:Arial,sans-serif;">

<div style="padding:24px;">
    <div style="background:#1e293b;padding:24px;border-radius:24px;">
        <h1 style="font-size:28px;margin-top:0;">Мобильная оплата</h1>

        <p><b>Парковка:</b> {{ $booking->spot->parkingLot->name }}</p>
        <p><b>Место:</b> {{ $booking->spot->name }}</p>
        <p><b>Госномер:</b> {{ $booking->car_number }}</p>
        <p><b>Время:</b> {{ $booking->duration_minutes }} минут</p>
        <p><b>Сумма:</b> {{ $booking->total_price }} ₽</p>

        <div style="background:white;padding:14px;border-radius:18px;text-align:center;margin:20px 0;">
            <img src="https://api.qrserver.com/v1/create-qr-code/?size=220x220&data={{ urlencode($booking->qr_code) }}"
                 style="width:220px;height:220px;">
            <p style="color:#111;font-size:12px;">{{ $booking->qr_code }}</p>
        </div>

        <a href="{{ route('payment.show', $booking) }}"
           style="display:block;text-align:center;background:#2563eb;color:white;padding:15px;border-radius:14px;text-decoration:none;font-weight:bold;">
            Вернуться к оплате
        </a>
    </div>
</div>

</body>
</html>