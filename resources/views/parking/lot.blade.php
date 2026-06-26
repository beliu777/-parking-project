<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>{{ $lot->name }}</title>
</head>
<body style="margin:0;background:#0f172a;color:white;font-family:Arial,sans-serif;">

<header style="padding:24px 70px;background:#111827;">
    <a href="/parking" style="color:#60a5fa;text-decoration:none;font-size:24px;font-weight:bold;">← Все парковки</a>
</header>

<div style="padding:50px 70px;">
    <h1 style="font-size:42px;margin-bottom:10px;">{{ $lot->name }}</h1>
    <p style="color:#94a3b8;font-size:18px;">{{ $lot->address }}</p>

    <div style="background:#1e293b;padding:35px;border-radius:28px;margin-top:35px;">
        <h2 style="font-size:30px;margin-bottom:10px;">Схема парковки</h2>
        <p style="color:#94a3b8;margin-bottom:25px;">Нажмите на свободное место.</p>

        <div style="height:70px;background:#334155;border-radius:16px;margin-bottom:25px;display:flex;align-items:center;justify-content:center;color:#cbd5e1;">
            Проезд
        </div>

        <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:18px;">
            @foreach($lot->spots as $spot)
                @if($spot->status === 'free')
                    <a href="{{ route('booking.create', $spot->id) }}"
                       style="background:#166534;color:white;text-decoration:none;padding:35px 15px;border-radius:18px;text-align:center;font-weight:bold;font-size:22px;border:2px solid #22c55e;">
                        {{ $spot->name }}
                        <div style="font-size:14px;margin-top:8px;">Свободно</div>
                    </a>
                @elseif($spot->status === 'busy')
                    <div style="background:#7f1d1d;color:white;padding:35px 15px;border-radius:18px;text-align:center;font-weight:bold;font-size:22px;border:2px solid #ef4444;">
                        {{ $spot->name }}
                        <div style="font-size:14px;margin-top:8px;">Занято</div>
                    </div>
                @else
                    <div style="background:#334155;color:white;padding:35px 15px;border-radius:18px;text-align:center;font-weight:bold;font-size:22px;border:2px solid #64748b;">
                        {{ $spot->name }}
                        <div style="font-size:14px;margin-top:8px;">Неактивно</div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>

</body>
</html>