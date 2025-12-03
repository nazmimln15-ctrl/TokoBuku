<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: #f4f4f4;
            color: #333;
        }

        header {
            background: #4f46e5;
            color: white;
            padding: 20px 40px;
            text-align: center;
        }

        .hero {
            padding: 80px 20px;
            text-align: center;
            background: white;
        }

        .hero h1 {
            font-size: 42px;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .hero p {
            font-size: 18px;
            margin-bottom: 30px;
            color: #555;
        }

        .btn {
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 8px;
            font-size: 16px;
            transition: 0.3s ease;
        }

        .btn-primary {
            background: #4f46e5;
            color: white;
        }
        .btn-primary:hover {
            background: #3730a3;
        }

        .btn-outline {
            border: 2px solid #4f46e5;
            color: #4f46e5;
            margin-left: 10px;
        }
        .btn-outline:hover {
            background: #4f46e5;
            color: white;
        }

        footer {
            margin-top: 50px;
            padding: 20px;
            background: #e5e5e5;
            text-align: center;
            font-size: 14px;
            color: #666;
        }
    </style>
</head>

<body>

<header>
    <h2>Aplikasi Toko Buku</h2>
</header>

<div class="hero">
    <h1>Selamat Datang </h1>
    <p>Silakan login untuk mengelola data buku, atau daftar jika belum memiliki akun.</p>
    

    @if (Route::has('login'))
        @auth
            <a href="{{ url('/dashboard') }}" class="btn btn-primary">Masuk Dashboard</a>
        @else
            <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
            <a href="{{ route('register') }}" class="btn btn-outline">Register</a>
        @endauth
    @endif
</div>

<footer>
    © {{ date('Y') }} Aplikasi Toko Buku — Dibuat dengan Laravel Breeze
</footer>

</body>
</html>
