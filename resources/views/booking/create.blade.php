<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Заявка на парковку</title>
</head>
<body style="margin:0;background:#0f172a;color:white;font-family:Arial,sans-serif;">

<div style="min-height:100vh;padding:50px 20px;display:flex;justify-content:center;align-items:center;">
    <div style="width:100%;max-width:620px;background:#1e293b;padding:35px;border-radius:26px;box-shadow:0 20px 60px rgba(0,0,0,.4);">

        <h1 style="font-size:32px;margin-bottom:10px;">Заявка на парковку</h1>

        <p style="color:#94a3b8;margin-bottom:20px;">
            {{ $lot->name }} · {{ $lot->address }}
        </p>

        <div style="background:#0f172a;padding:18px;border-radius:18px;margin-bottom:25px;">
            Свободных мест сейчас: <b style="color:#22c55e;">{{ $freeCount }}</b>
        </div>

        @if($errors->any())
            <div style="background:#dc2626;padding:14px;border-radius:12px;margin-bottom:20px;">
                @foreach($errors->all() as $error)
                    <p style="margin:0;">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('booking.store') }}">
            @csrf

            <input type="hidden" name="parking_lot_id" value="{{ $lot->id }}">

            <label>Телефон</label>
            <input name="phone" required placeholder="+7 999 000-00-00"
                   style="width:100%;box-sizing:border-box;margin:8px 0 18px;padding:14px;border-radius:12px;border:1px solid #475569;background:#0f172a;color:white;">

            <label>Госномер авто</label>
            <input name="car_number" required placeholder="А123ВС777"
                   style="width:100%;box-sizing:border-box;margin:8px 0 18px;padding:14px;border-radius:12px;border:1px solid #475569;background:#0f172a;color:white;">

            <label>Время парковки</label>
            <select name="duration_minutes" required
                    style="width:100%;box-sizing:border-box;margin:8px 0 25px;padding:14px;border-radius:12px;border:1px solid #475569;background:#0f172a;color:white;">
                <option value="15">15 минут</option>
                <option value="30">30 минут</option>
                <option value="45">45 минут</option>
                <option value="60">1 час</option>
            </select>

            <button style="width:100%;padding:16px;background:#2563eb;color:white;border:0;border-radius:14px;font-weight:bold;font-size:16px;cursor:pointer;">
                Сгенерировать QR и перейти к оплате
            </button>
        </form>

        <a href="{{ route('parking.index') }}" style="display:block;text-align:center;margin-top:18px;color:#60a5fa;">
            Назад к парковкам
        </a>
    </div>
</div>

</body>
</html>