<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Вход</title>
</head>
<body style="margin:0;background:#0f172a;color:white;font-family:Arial,sans-serif;">

<div style="min-height:100vh;display:flex;align-items:center;justify-content:center;padding:20px;">
    <div style="width:100%;max-width:420px;background:#1e293b;padding:35px;border-radius:24px;box-shadow:0 20px 60px rgba(0,0,0,.35);">
        <h1 style="font-size:30px;margin-bottom:25px;text-align:center;">Вход</h1>

        @if($errors->any())
            <div style="background:#dc2626;padding:12px;border-radius:12px;margin-bottom:15px;">
                @foreach($errors->all() as $error)
                    <p style="margin:0;">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
            @csrf

            <label>Электронная почта</label>
            <input type="email" name="email" required style="width:100%;box-sizing:border-box;margin:8px 0 18px;padding:14px;border-radius:12px;border:1px solid #475569;background:#0f172a;color:white;">

            <label>Пароль</label>
            <input type="password" name="password" required style="width:100%;box-sizing:border-box;margin:8px 0 24px;padding:14px;border-radius:12px;border:1px solid #475569;background:#0f172a;color:white;">

            <button style="width:100%;padding:15px;background:#2563eb;color:white;border:0;border-radius:14px;font-weight:bold;font-size:16px;">
                Войти
            </button>
        </form>

        <p style="text-align:center;margin-top:18px;">
            Нет аккаунта?
            <a href="{{ route('register') }}" style="color:#60a5fa;">Зарегистрироваться</a>
        </p>
    </div>
</div>

</body>
</html>