<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Оплата парковки</title>
</head>
<body style="margin:0;background:#0f172a;color:white;font-family:Arial,sans-serif;">

<div style="min-height:100vh;display:flex;align-items:center;justify-content:center;padding:30px;">
    <div style="width:100%;max-width:760px;background:#1e293b;padding:35px;border-radius:26px;">

        <h1 style="font-size:34px;">Фейковая оплата картой</h1>

        <p style="color:#94a3b8;">
            QR-код индивидуален для этой парковки и этой заявки.
        </p>

        @if($errors->any())
            <div style="background:#dc2626;padding:14px;border-radius:12px;margin:20px 0;">
                @foreach($errors->all() as $error)
                    <p style="margin:0;">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <div style="display:grid;grid-template-columns:1fr 190px;gap:25px;margin:25px 0;">

            <div style="background:#0f172a;padding:22px;border-radius:18px;">

                <p>
                    <b>Парковка:</b>
                    {{ $booking->spot->parkingLot->name }}
                </p>

                <p>
                    <b>Адрес:</b>
                    {{ $booking->spot->parkingLot->address }}
                </p>

                <p>
                    <b>Назначенное место:</b>
                    {{ $booking->spot->name }}
                </p>

                <p>
                    <b>Телефон:</b>
                    {{ $booking->phone }}
                </p>

                <p>
                    <b>Госномер:</b>
                    {{ $booking->car_number }}
                </p>

                <p>
                    <b>Время:</b>
                    {{ $booking->duration_minutes }} минут
                </p>

                <p>
                    <b>Сумма:</b>
                    {{ $booking->total_price }} ₽
                </p>

            </div>

            <div style="background:white;padding:12px;border-radius:18px;text-align:center;">

                <a href="{{ route('payment.mobile', $booking) }}"
                   style="text-decoration:none;">

                    <img
                        src="https://api.qrserver.com/v1/create-qr-code/?size=160x160&data={{ urlencode(route('payment.mobile', $booking)) }}"
                        style="width:160px;height:160px;"
                    >

                    <p style="color:#111;font-size:12px;margin:8px 0 0;">
                        Открыть мобильную версию
                    </p>

                </a>

            </div>

        </div>

        <form method="POST" action="{{ route('payment.pay', $booking) }}">
            @csrf

            <input
                name="card_number"
                placeholder="0000 0000 0000 0000"
                required
                style="width:100%;box-sizing:border-box;margin-bottom:12px;padding:14px;border-radius:12px;border:1px solid #475569;background:#0f172a;color:white;"
            >

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">

                <input
                    name="card_date"
                    placeholder="12/28"
                    required
                    style="width:100%;box-sizing:border-box;margin-bottom:12px;padding:14px;border-radius:12px;border:1px solid #475569;background:#0f172a;color:white;"
                >

                <input
                    name="card_cvv"
                    placeholder="CVV"
                    required
                    style="width:100%;box-sizing:border-box;margin-bottom:12px;padding:14px;border-radius:12px;border:1px solid #475569;background:#0f172a;color:white;"
                >

            </div>

            <button
                style="width:100%;padding:16px;background:#22c55e;color:white;border:0;border-radius:14px;font-weight:bold;font-size:16px;cursor:pointer;">
                Оплатить
            </button>

        </form>

    </div>
</div>

</body>
</html>