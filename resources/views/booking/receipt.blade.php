<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Талон оплаты парковки</title>

    <style>
        @media print {
            .no-print {
                display: none !important;
            }

            body {
                background: white !important;
            }

            .receipt {
                box-shadow: none !important;
                border: 1px solid #000 !important;
            }
        }
    </style>
</head>

<body style="margin:0;background:#0f172a;font-family:Arial,sans-serif;color:white;">

<div style="min-height:100vh;display:flex;align-items:center;justify-content:center;padding:30px;">

    <div class="receipt" style="background:white;color:#111;width:100%;max-width:420px;padding:30px;border-radius:22px;box-shadow:0 20px 60px rgba(0,0,0,.45);">

        <div style="text-align:center;border-bottom:2px dashed #999;padding-bottom:18px;margin-bottom:20px;">
            <h1 style="margin:0;font-size:28px;">ParkSpace</h1>
            <p style="margin:8px 0 0;color:#555;">Мини-чек оплаты парковки</p>
        </div>

        <div style="text-align:center;margin-bottom:22px;">
            <div style="font-size:56px;font-weight:800;">
                {{ $booking->spot->name }}
            </div>

            <p style="margin:0;color:#555;">
                Парковочное место
            </p>
        </div>

        <div style="border-top:2px dashed #999;border-bottom:2px dashed #999;padding:18px 0;margin-bottom:20px;">
            <p><strong>ФИО:</strong> {{ $booking->user->name }}</p>
            <p><strong>Email:</strong> {{ $booking->user->email }}</p>
            <p><strong>Госномер:</strong> {{ $booking->car_number }}</p>
            <p><strong>Зона:</strong> {{ $booking->spot->zone }}</p>
            <p><strong>Начало аренды:</strong> {{ $booking->start_time }}</p>
            <p><strong>Конец аренды:</strong> {{ $booking->end_time }}</p>
            <p><strong>Сумма:</strong> {{ $booking->total_price }} ₽</p>
            <p><strong>Статус:</strong> Парковка оплачена</p>
            <p><strong>Способ оплаты:</strong> {{ $booking->payment->method === 'balance' ? 'Баланс сайта' : 'Банковская карта' }}</p>
        </div>

        <div style="text-align:center;">
            <p style="font-size:14px;color:#555;margin-bottom:5px;">
                Чек №{{ $booking->id }}
            </p>

            <p style="font-size:13px;color:#777;margin:0;">
                Спасибо за использование ParkSpace
            </p>
        </div>

        <div class="no-print" style="display:flex;gap:12px;margin-top:25px;">
            <button onclick="window.print()"
                    style="flex:1;background:#2563eb;color:white;border:0;padding:13px;border-radius:12px;font-weight:bold;cursor:pointer;">
                Печать
            </button>

            <a href="{{ route('dashboard') }}"
               style="flex:1;background:#475569;color:white;text-align:center;padding:13px;border-radius:12px;text-decoration:none;font-weight:bold;">
                Назад
            </a>
        </div>

    </div>

</div>

</body>
</html>