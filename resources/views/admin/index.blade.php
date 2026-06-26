<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Админка ParkRegion</title>
</head>
<body style="margin:0;background:#0f172a;color:white;font-family:Arial,sans-serif;">

<header style="padding:24px 70px;background:#111827;display:flex;justify-content:space-between;align-items:center;">
    <a href="/admin" style="color:#60a5fa;font-size:26px;font-weight:bold;text-decoration:none;">
        ParkRegion Admin
    </a>

    <form method="POST" action="{{ route('admin.logout') }}">
        @csrf
        <button style="background:#ef4444;color:white;border:0;padding:10px 18px;border-radius:10px;cursor:pointer;">
            Выйти
        </button>
    </form>
</header>

<div style="padding:40px 70px;">

    <h1 style="font-size:38px;margin-bottom:25px;">Админ-панель</h1>

    @if(session('success'))
        <div style="background:#16a34a;padding:14px;border-radius:12px;margin-bottom:25px;">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div style="background:#dc2626;padding:14px;border-radius:12px;margin-bottom:25px;">
            @foreach($errors->all() as $error)
                <p style="margin:0;">{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <section style="background:#1e293b;padding:30px;border-radius:24px;margin-bottom:35px;">
        <h2 style="font-size:28px;margin-bottom:20px;">Пользователи</h2>

        <table style="width:100%;border-collapse:collapse;">
            <tr style="background:#0f172a;">
                <th style="padding:12px;border:1px solid #334155;">ID</th>
                <th style="padding:12px;border:1px solid #334155;">ФИО</th>
                <th style="padding:12px;border:1px solid #334155;">Email</th>
                <th style="padding:12px;border:1px solid #334155;">Админ</th>
                <th style="padding:12px;border:1px solid #334155;">Брони</th>
                <th style="padding:12px;border:1px solid #334155;">Действия</th>
            </tr>

            @foreach($users as $user)
                <tr>
                    <td style="padding:12px;border:1px solid #334155;">{{ $user->id }}</td>
                    <td style="padding:12px;border:1px solid #334155;">{{ $user->name }}</td>
                    <td style="padding:12px;border:1px solid #334155;">{{ $user->email }}</td>
                    <td style="padding:12px;border:1px solid #334155;">
                        @if($user->is_admin)
                            <span style="color:#22c55e;font-weight:bold;">Да</span>
                        @else
                            Нет
                        @endif
                    </td>
                    <td style="padding:12px;border:1px solid #334155;">
                        {{ $user->bookings()->count() }}
                    </td>
                    <td style="padding:12px;border:1px solid #334155;">
                        <a href="{{ route('admin.users.edit', $user) }}"
                           style="background:#2563eb;color:white;padding:8px 12px;border-radius:8px;text-decoration:none;">
                            Изменить
                        </a>

                        @if($user->id !== auth()->id())
                            <form method="POST" action="{{ route('admin.users.delete', $user) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button style="background:#dc2626;color:white;border:0;padding:8px 12px;border-radius:8px;cursor:pointer;">
                                    Удалить
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
    </section>

    <section style="background:#1e293b;padding:30px;border-radius:24px;margin-bottom:35px;">
        <h2 style="font-size:28px;margin-bottom:20px;">Распределение по парковкам</h2>

        @foreach(\App\Models\ParkingLot::with('spots')->get() as $lot)
            <div style="background:#0f172a;padding:24px;border-radius:22px;margin-bottom:25px;">
                <h3 style="font-size:24px;margin:0 0 8px;">{{ $lot->name }}</h3>
                <p style="color:#94a3b8;margin:0 0 18px;">{{ $lot->address }}</p>

                <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:14px;">
                    @foreach($lot->spots as $spot)
                        @php
                            $bg = $spot->status === 'free' ? '#166534' : ($spot->status === 'busy' ? '#7f1d1d' : '#334155');
                            $label = $spot->status === 'free' ? 'Свободно' : ($spot->status === 'busy' ? 'Занято' : 'Неактивно');
                        @endphp

                        <div style="background:{{ $bg }};padding:16px;border-radius:16px;text-align:center;">
                            <h4 style="margin:0 0 6px;">{{ $spot->name }}</h4>
                            <p style="margin:0 0 10px;">{{ $label }}</p>

                            <a href="{{ route('admin.spots.status', $spot) }}"
                               style="display:block;background:#475569;color:white;padding:8px;border-radius:10px;text-decoration:none;">
                                Статус
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </section>

    <section style="background:#1e293b;padding:30px;border-radius:24px;">
        <h2 style="font-size:28px;margin-bottom:20px;">История бронирований</h2>

        <table style="width:100%;border-collapse:collapse;">
            <tr style="background:#0f172a;">
                <th style="padding:12px;border:1px solid #334155;">ID</th>
                <th style="padding:12px;border:1px solid #334155;">Пользователь</th>
                <th style="padding:12px;border:1px solid #334155;">Парковка</th>
                <th style="padding:12px;border:1px solid #334155;">Место</th>
                <th style="padding:12px;border:1px solid #334155;">Госномер</th>
                <th style="padding:12px;border:1px solid #334155;">Цена</th>
                <th style="padding:12px;border:1px solid #334155;">Статус</th>
                <th style="padding:12px;border:1px solid #334155;">Действие</th>
            </tr>

            @foreach($bookings as $booking)
                <tr>
                    <td style="padding:12px;border:1px solid #334155;">{{ $booking->id }}</td>
                    <td style="padding:12px;border:1px solid #334155;">{{ $booking->user->name ?? '—' }}</td>
                    <td style="padding:12px;border:1px solid #334155;">{{ $booking->spot->parkingLot->name ?? '—' }}</td>
                    <td style="padding:12px;border:1px solid #334155;">{{ $booking->spot->name ?? '—' }}</td>
                    <td style="padding:12px;border:1px solid #334155;">{{ $booking->car_number ?? '—' }}</td>
                    <td style="padding:12px;border:1px solid #334155;">{{ $booking->total_price }} ₽</td>
                    <td style="padding:12px;border:1px solid #334155;">{{ $booking->status }}</td>
                    <td style="padding:12px;border:1px solid #334155;">
                        <form method="POST" action="{{ route('admin.bookings.cancelRefund', $booking) }}">
                            @csrf
                            <button style="background:#f59e0b;color:white;border:0;padding:8px 12px;border-radius:8px;cursor:pointer;">
                                Отменить
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </section>

</div>

</body>
</html>