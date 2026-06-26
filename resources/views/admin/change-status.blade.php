<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Смена статуса места</title>
</head>
<body style="margin:0;background:#0f172a;color:white;font-family:Arial,sans-serif;">

<div style="min-height:100vh;display:flex;align-items:center;justify-content:center;padding:20px;">

    <div style="width:100%;max-width:460px;background:#1e293b;padding:35px;border-radius:24px;box-shadow:0 20px 60px rgba(0,0,0,.4);">

        <h1 style="font-size:30px;margin-bottom:10px;">
            Место {{ $spot->name }}
        </h1>

        <p style="color:#94a3b8;margin-bottom:25px;">
            Зона: {{ $spot->zone }} · Цена: {{ $spot->price_per_hour }} ₽/час
        </p>

        <form method="POST" action="{{ route('admin.spots.updateStatus', $spot) }}">
            @csrf

            <label style="display:block;margin-bottom:8px;">Выберите статус</label>

            <select name="status"
                    style="width:100%;box-sizing:border-box;margin-bottom:24px;padding:14px;border-radius:12px;border:1px solid #475569;background:#0f172a;color:white;">
                <option value="free" {{ $spot->status === 'free' ? 'selected' : '' }}>
                    Свободно
                </option>

                <option value="busy" {{ $spot->status === 'busy' ? 'selected' : '' }}>
                    Занято
                </option>

                <option value="inactive" {{ $spot->status === 'inactive' ? 'selected' : '' }}>
                    Неактивно
                </option>
            </select>

            <button style="width:100%;padding:15px;background:#2563eb;color:white;border:0;border-radius:14px;font-weight:bold;cursor:pointer;">
                Сохранить статус
            </button>
        </form>

        <a href="{{ route('admin.index') }}"
           style="display:block;text-align:center;margin-top:18px;color:#94a3b8;text-decoration:none;">
            Назад в админку
        </a>

    </div>

</div>

</body>
</html>