<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to CultureLingo</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body style="background: #f3f4f6; display: flex; justify-content: center; items-center; min-height: 100vh; margin: 0;">
    <div class="admin-card" style="text-align: center; max-width: 500px; padding: 40px; margin: auto;">
        <span style="font-size: 4rem;">🌍</span>
        <h1 style="font-size: 2.5rem; font-weight: bold; margin: 20px 0; color: #4f46e5;">CultureLingo</h1>
        <p style="color: #4b5563; font-size: 1.1rem; margin-bottom: 30px;">
            Ontdek culturen, beantwoord quizvragen en verdien streaks. Log in of registreer een account om direct te beginnen met spelen!
        </p>
        <div style="display: flex; gap: 15px; justify-content: center;">
            <a href="{{ route('login') }}" class="btn btn-primary" style="padding: 12px 30px;">Log In</a>
            <a href="{{ route('register') }}" class="btn btn-dark" style="padding: 12px 30px;">Registreer</a>
        </div>
    </div>
</body>
</html>