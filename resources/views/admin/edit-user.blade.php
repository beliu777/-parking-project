<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Редактирование пользователя</title>
</head>
<body style="margin:0;background:#0f172a;color:white;font-family:Arial,sans-serif;">

<div style="min-height:100vh;display:flex;align-items:center;justify-content:center;padding:30px;">

    <div style="width:100%;max-width:600px;background:#1e293b;padding:35px;border-radius:24px;">

        <h1 style="font-size:34px;margin-bottom:25px;">
            Редактирование пользователя
        </h1>

        <form method="POST"
              action="{{ route('admin.users.update', $user) }}">

            @csrf

            <label>ФИО</label>

            <input
                name="name"
                value="{{ $user->name }}"
                required
                style="width:100%;box-sizing:border-box;margin:8px 0 18px;padding:14px;border-radius:12px;border:1px solid #475569;background:#0f172a;color:white;"
            >

            <label>Email</label>

            <input
                name="email"
                value="{{ $user->email }}"
                required
                style="width:100%;box-sizing:border-box;margin:8px 0 18px;padding:14px;border-radius:12px;border:1px solid #475569;background:#0f172a;color:white;"
            >

            <label style="display:flex;align-items:center;gap:10px;margin-bottom:25px;">

                <input
                    type="checkbox"
                    name="is_admin"
                    {{ $user->is_admin ? 'checked' : '' }}
                >

                Выдать права администратора

            </label>

            <button
                style="width:100%;padding:16px;background:#2563eb;color:white;border:0;border-radius:14px;font-weight:bold;font-size:16px;cursor:pointer;">
                Сохранить
            </button>

        </form>

        <a href="/admin"
           style="display:block;text-align:center;margin-top:18px;color:#60a5fa;">
            Назад
        </a>

    </div>

</div>

</body>
</html>