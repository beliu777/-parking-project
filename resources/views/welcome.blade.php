<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>ParkSpace — бронирование парковки</title>
</head>
<body style="margin:0;background:#0f172a;color:white;font-family:Arial, sans-serif;">

<header style="padding:25px 70px;display:flex;justify-content:space-between;align-items:center;background:#111827;">
    <div style="font-size:26px;font-weight:bold;color:#60a5fa;">
        ParkSpace
    </div>

    <nav style="display:flex;gap:25px;">
        <a href="/" style="color:white;text-decoration:none;">Главная</a>
        <a href="/parking" style="color:white;text-decoration:none;">Парковки</a>
    </nav>
</header>

<section style="
    min-height:560px;
    background:
        linear-gradient(rgba(15,23,42,.75), rgba(15,23,42,.9)),
        url('https://images.unsplash.com/photo-1502877338535-766e1452684a?auto=format&fit=crop&w=1600&q=80');
    background-size:cover;
    background-position:center;
    display:flex;
    align-items:center;
    padding:0 70px;
">
    <div style="max-width:700px;">
        <div style="display:inline-block;background:#2563eb;padding:8px 16px;border-radius:30px;margin-bottom:20px;">
            Умная парковка нового поколения
        </div>

        <h1 style="font-size:56px;line-height:1.1;margin:0 0 25px;">
            Забронируйте парковочное место онлайн
        </h1>

        <p style="font-size:20px;color:#d1d5db;margin-bottom:35px;">
            Выберите свободное место, оплатите бронирование и получите навигацию прямо к парковке.
        </p>

        <a href="/parking"
           style="background:#2563eb;color:white;padding:16px 28px;border-radius:12px;text-decoration:none;font-size:18px;font-weight:bold;">
            Найти парковку
        </a>
    </div>
</section>

<section style="padding:70px;">
    <h2 style="font-size:36px;text-align:center;margin-bottom:40px;">
        Возможности сервиса
    </h2>

    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:25px;">
        <div style="background:#1e293b;padding:30px;border-radius:20px;">
            <div style="font-size:42px;">🅿️</div>
            <h3>Бронирование места</h3>
            <p style="color:#cbd5e1;">
                Выберите зону, место и удобное время для парковки.
            </p>
        </div>

        <div style="background:#1e293b;padding:30px;border-radius:20px;">
            <div style="font-size:42px;">💳</div>
            <h3>Онлайн-оплата</h3>
            <p style="color:#cbd5e1;">
                Оплатите парковку прямо на сайте после оформления брони.
            </p>
        </div>

        <div style="background:#1e293b;padding:30px;border-radius:20px;">
            <div style="font-size:42px;">📍</div>
            <h3>Навигация</h3>
            <p style="color:#cbd5e1;">
                Получите маршрут до выбранного парковочного места.
            </p>
        </div>
    </div>
</section>

<section style="padding:70px;background:#111827;">
    <h2 style="font-size:36px;text-align:center;margin-bottom:40px;">
        Популярные зоны парковки
    </h2>

    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:25px;">
        <div style="background:#1e293b;border-radius:20px;overflow:hidden;">
            <img src="https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?auto=format&fit=crop&w=800&q=80"
                 style="width:100%;height:220px;object-fit:cover;">
            <div style="padding:25px;">
                <h3>Зона A</h3>
                <p style="color:#cbd5e1;">Удобная парковка рядом с главным входом.</p>
            </div>
        </div>

        <div style="background:#1e293b;border-radius:20px;overflow:hidden;">
            <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=800&q=80"
                 style="width:100%;height:220px;object-fit:cover;">
            <div style="padding:25px;">
                <h3>Зона B</h3>
                <p style="color:#cbd5e1;">Парковка для длительного бронирования.</p>
            </div>
        </div>

        <div style="background:#1e293b;border-radius:20px;overflow:hidden;">
            <img src="https://images.unsplash.com/photo-1511919884226-fd3cad34687c?auto=format&fit=crop&w=800&q=80"
                 style="width:100%;height:220px;object-fit:cover;">
            <div style="padding:25px;">
                <h3>VIP-зона</h3>
                <p style="color:#cbd5e1;">Премиальные места рядом с выездом.</p>
            </div>
        </div>
    </div>
</section>

<section style="padding:80px 70px;text-align:center;">
    <h2 style="font-size:38px;margin-bottom:20px;">
        Забронируйте место за пару минут
    </h2>

    <p style="color:#cbd5e1;font-size:18px;margin-bottom:30px;">
        Быстро, удобно и без поиска свободной парковки.
    </p>

    <a href="/parking"
       style="background:#22c55e;color:white;padding:16px 32px;border-radius:12px;text-decoration:none;font-size:18px;font-weight:bold;">
        Перейти к парковкам
    </a>
</section>

<footer style="padding:25px;text-align:center;background:#020617;color:#94a3b8;">
    © {{ date('Y') }} ParkSpace. Онлайн-бронирование парковочных мест.
</footer>

</body>
</html>