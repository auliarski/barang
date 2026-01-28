<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Pembeli</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-5">
    <h1>Selamat Datang, {{ Auth::guard('pembeli')->user()->name }}!</h1>
    <a href="{{ route('pembeli.logout') }}"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
       class="btn btn-danger mt-3">Logout</a>

    <form id="logout-form" action="{{ route('pembeli.logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</body>
</html>
