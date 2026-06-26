<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Сеть парковок</title>
</head>
<body style="margin:0;background:#0f172a;color:white;font-family:Arial,sans-serif;">

<header style="padding:24px 70px;background:#111827;display:flex;justify-content:space-between;align-items:center;">
    <a href="/" style="color:#60a5fa;font-size:26px;font-weight:bold;text-decoration:none;">ParkRegion</a>

    <div style="display:flex;gap:20px;">
        <a href="/parking" style="color:white;text-decoration:none;">Парковки</a>
        @auth
            <a href="/dashboard" style="color:white;text-decoration:none;">Кабинет</a>
        @else
            <a href="/login" style="color:white;text-decoration:none;">Войти</a>
        @endauth
    </div>
</header>

<div style="padding:60px 70px;">
    <h1 style="font-size:44px;margin-bottom:15px;">Сеть парковок региона</h1>
    <p style="color:#94a3b8;font-size:18px;margin-bottom:35px;">
        Выберите парковку. Система автоматически назначит свободное место после заявки.
    </p>

    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:25px;">
        @foreach($lots as $lot)
            <a href="{{ route('booking.lot.create', $lot) }}"
               style="background:#1e293b;padding:28px;border-radius:24px;text-decoration:none;color:white;display:block;box-shadow:0 20px 50px rgba(0,0,0,.25);">
                <h2 style="font-size:26px;margin:0 0 10px;">{{ $lot->name }}</h2>
                <p style="color:#94a3b8;">{{ $lot->region }}</p>
                <p>{{ $lot->address }}</p>
                <p style="color:#22c55e;font-weight:bold;">
                    Свободно мест: {{ $lot->spots->where('status', 'free')->count() }}
                </p>

                <div style="margin-top:18px;background:#2563eb;padding:13px;border-radius:14px;text-align:center;font-weight:bold;">
                    Оформить парковку
                </div>
            </a>
        @endforeach
    </div>
</div>

</body>
</html>