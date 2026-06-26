<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Личный кабинет</title>
</head>
<body style="margin:0;background:#0f172a;color:white;font-family:Arial,sans-serif;">

<header style="padding:24px 70px;background:#111827;display:flex;justify-content:space-between;align-items:center;">
    <a href="/" style="color:#60a5fa;font-size:26px;font-weight:bold;text-decoration:none;">ParkRegion</a>

    <div style="display:flex;gap:20px;align-items:center;">
        <a href="/parking" style="color:white;text-decoration:none;">Парковки</a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button style="background:#ef4444;color:white;border:0;padding:10px 18px;border-radius:10px;cursor:pointer;">
                Выйти
            </button>
        </form>
    </div>
</header>

<div style="padding:50px 70px;">

    <h1 style="font-size:38px;margin-bottom:30px;">Личный кабинет</h1>

    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:20px;margin-bottom:35px;">
        <div style="background:#1e293b;padding:25px;border-radius:20px;">
            <p style="color:#94a3b8;">Всего бронирований</p>
            <h2 style="font-size:34px;margin:0;color:#60a5fa;">{{ $bookings->count() }}</h2>
        </div>

        <div style="background:#1e293b;padding:25px;border-radius:20px;">
            <p style="color:#94a3b8;">Оплачено</p>
            <h2 style="font-size:34px;margin:0;color:#22c55e;">{{ $paidBookings }}</h2>
        </div>

        <div style="background:#1e293b;padding:25px;border-radius:20px;">
            <p style="color:#94a3b8;">Активные</p>
            <h2 style="font-size:34px;margin:0;color:#fbbf24;">{{ $activeBookings }}</h2>
        </div>
    </div>

    <div style="background:#1e293b;padding:30px;border-radius:24px;">
        <h2 style="font-size:26px;margin-bottom:20px;">История парковок</h2>

        @forelse($bookings as $booking)
            <div style="background:#0f172a;padding:20px;border-radius:18px;margin-bottom:15px;display:flex;justify-content:space-between;align-items:center;">
                <div>
                    <h3 style="margin:0 0 8px;">
                        {{ $booking->spot->parkingLot->name ?? 'Парковка' }}
                    </h3>

                    <p style="margin:0;color:#94a3b8;">
                        Место: {{ $booking->spot->name ?? '—' }}
                    </p>

                    <p style="margin:6px 0 0;color:#94a3b8;">
                        Госномер: {{ $booking->car_number ?? '—' }}
                    </p>

                    <p style="margin:6px 0 0;color:#94a3b8;">
                        {{ $booking->start_time }} — {{ $booking->end_time }}
                    </p>

                    <p style="margin:6px 0 0;color:#94a3b8;">
                        Сумма: {{ $booking->total_price }} ₽
                    </p>
                </div>

                <div style="text-align:right;">
                    @if($booking->status === 'paid')
                        <span style="color:#22c55e;font-weight:bold;">Оплачено</span>
                    @elseif($booking->status === 'waiting_payment')
                        <span style="color:#fbbf24;font-weight:bold;">Ожидает оплаты</span>
                    @else
                        <span style="color:#94a3b8;font-weight:bold;">{{ $booking->status }}</span>
                    @endif

                    <br>

                    @if($booking->status === 'waiting_payment')
                        <a href="{{ route('payment.show', $booking) }}"
                           style="display:inline-block;margin-top:10px;background:#2563eb;color:white;padding:9px 14px;border-radius:10px;text-decoration:none;">
                            Оплатить
                        </a>
                    @else
                        <a href="{{ route('payment.success', $booking) }}"
                           style="display:inline-block;margin-top:10px;background:#16a34a;color:white;padding:9px 14px;border-radius:10px;text-decoration:none;">
                            QR / Навигация
                        </a>

                        <a href="{{ route('booking.receipt', $booking) }}"
                           style="display:inline-block;margin-top:10px;background:#475569;color:white;padding:9px 14px;border-radius:10px;text-decoration:none;">
                            Чек
                        </a>
                    @endif
                </div>
            </div>
        @empty
            <p style="color:#94a3b8;">У вас пока нет парковок.</p>
        @endforelse
    </div>

</div>

</body>
</html>