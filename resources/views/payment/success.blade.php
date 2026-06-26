<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Бронирование оплачено</title>
</head>
<body id="pageBody" style="background:#0f172a;color:white;font-family:Arial,sans-serif;padding:40px">

<div style="position:fixed;right:20px;top:20px;z-index:10;">
    <button onclick="toggleTheme()"
            style="background:#2563eb;color:white;border:0;padding:10px 16px;border-radius:12px;cursor:pointer;">
        🌙 / ☀️
    </button>
</div>

<div id="cardBox" style="max-width:800px;margin:auto;background:#1e293b;padding:30px;border-radius:20px">

    <h1 style="font-size:36px;color:#22c55e">Оплата прошла успешно</h1>

    <p style="font-size:20px;margin-top:20px">
        Ваше парковочное место забронировано.
    </p>

    <div style="background:#111827;padding:20px;border-radius:15px;margin-top:25px;color:white;">
        <p><b>ФИО:</b> {{ auth()->user()->name }}</p>
        <p><b>Место:</b> {{ $booking->spot->name }}</p>
        <p><b>Зона:</b> {{ $booking->spot->zone }}</p>
        <p><b>Госномер:</b> {{ $booking->car_number }}</p>
        <p><b>Стоимость:</b> {{ $booking->total_price }} ₽</p>
        <p><b>Начало:</b> {{ $booking->start_time }}</p>
        <p><b>Конец:</b> {{ $booking->end_time }}</p>
        <p><b>Оплата:</b> {{ $booking->payment->method === 'balance' ? 'Баланс сайта' : 'Банковская карта' }}</p>
    </div>

    <div style="margin-top:30px">
        <h2 style="font-size:24px">Живая карта и навигация</h2>

        <p>
            Адрес парковки: г. Москва, Парковочная улица, 10
        </p>

        <iframe
            src="https://yandex.ru/map-widget/v1/?text=Москва%20Парковочная%20улица%2010&z=15"
            width="100%"
            height="350"
            frameborder="0"
            style="border-radius:18px;margin-top:15px;">
        </iframe>

        <a href="https://yandex.ru/maps/?text=Москва Парковочная улица 10"
           target="_blank"
           style="display:inline-block;margin-top:15px;padding:14px 20px;background:#16a34a;color:white;border-radius:12px;text-decoration:none;font-weight:bold">
            Открыть маршрут
        </a>

        <a href="{{ route('booking.receipt', $booking) }}"
           style="display:inline-block;margin-top:15px;margin-left:10px;padding:14px 20px;background:#2563eb;color:white;border-radius:12px;text-decoration:none;font-weight:bold">
            Распечатать чек
        </a>

        <a href="/parking"
           style="display:inline-block;margin-top:15px;margin-left:10px;padding:14px 20px;background:#475569;color:white;border-radius:12px;text-decoration:none;font-weight:bold">
            Назад к парковкам
        </a>
    </div>

</div>

<script>
    function applyTheme() {
        const theme = localStorage.getItem('theme') || 'dark';
        const body = document.getElementById('pageBody');
        const card = document.getElementById('cardBox');

        if (theme === 'light') {
            body.style.background = '#f1f5f9';
            body.style.color = '#0f172a';
            card.style.background = '#ffffff';
            card.style.color = '#0f172a';
        } else {
            body.style.background = '#0f172a';
            body.style.color = 'white';
            card.style.background = '#1e293b';
            card.style.color = 'white';
        }
    }

    function toggleTheme() {
        const current = localStorage.getItem('theme') || 'dark';
        localStorage.setItem('theme', current === 'dark' ? 'light' : 'dark');
        applyTheme();
    }

    applyTheme();
</script>

</body>
</html>