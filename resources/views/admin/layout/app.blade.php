<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fc;
            font-family: 'Poppins', sans-serif;
        }

        /* Sidebar */
        .sidebar {
            width: 240px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #0048ff;
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 1.5rem 0;
        }

        .sidebar .brand {
            font-size: 1.4rem;
            font-weight: 600;
            text-align: center;
            margin-bottom: 2rem;
        }

        .sidebar a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 12px 25px;
            font-size: 0.95rem;
            border-left: 4px solid transparent;
            transition: all 0.3s ease;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: rgba(255, 255, 255, 0.15);
            border-left: 4px solid #fff;
        }

        .sidebar .bottom-links {
            font-size: 0.85rem;
            text-align: center;
        }

        /* Dropdown */
        .dropdown-menu-sidebar {
            display: flex;
            flex-direction: column;
        }

        .dropdown-btn {
            background: none;
            border: none;
            color: #fff;
            padding: 12px 25px;
            text-align: left;
            font-size: 0.95rem;
            cursor: pointer;
            width: 100%;
            border-left: 4px solid transparent;
            transition: all 0.3s ease;
        }

        .dropdown-btn:hover,
        .dropdown-btn.active {
            background: rgba(255, 255, 255, 0.15);
            border-left: 4px solid #fff;
        }

        .dropdown-container {
            display: none;
            flex-direction: column;
            background: rgba(255, 255, 255, 0.05);
        }

        .dropdown-container.show {
            display: flex !important;
        }

        .dropdown-container a {
            padding-left: 40px;
            font-size: 0.9rem;
        }

        /* Main Content */
        .main-content {
            margin-left: 240px;
            padding: 2rem;
        }

        .topbar {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .profile {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #fff;
            padding: 6px 12px;
            border-radius: 50px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        }

        .profile img {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
        }

        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>

    {{-- SIDEBAR --}}
    <div class="sidebar">
        <div>
            <div class="brand">Admin Panel</div>

            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">🏠 Dashboard</a>
            <a href="{{ route('admin.stok-barang.index') ?? '#' }}" class="{{ request()->is('admin/stok-barang*') ? 'active' : '' }}">📦 Stok Barang</a>
            <a href="{{ route('admin.barang-masuk.index') ?? '#' }}" class="{{ request()->is('admin/barang-masuk*') ? 'active' : '' }}">📥 Barang Masuk</a>
            <a href="{{ route('admin.barang-keluar.index') ?? '#' }}" class="{{ request()->is('admin/barang-keluar*') ? 'active' : '' }}">📤 Barang Keluar</a>

            {{-- Kelola Pengguna (Dropdown) --}}
            @php
                $isKelolaActive = request()->is('admin/kelola-admin*') || request()->is('admin/kelola-pembeli*');
            @endphp

            <div class="dropdown-menu-sidebar">
                <button class="dropdown-btn {{ $isKelolaActive ? 'active' : '' }}">
                    👥 Kelola Pengguna
                    <span style="float:right;">▼</span>
                </button>
                <div class="dropdown-container {{ $isKelolaActive ? 'show' : '' }}">
                    <a href="{{ route('admin.kelola-admin.index') ?? '#' }}" class="{{ request()->is('admin/kelola-admin*') ? 'active' : '' }}">🧑‍💼 Kelola Admin</a>
                    <a href="{{ route('admin.kelola-pembeli.index') ?? '#' }}" class="{{ request()->is('admin/kelola-pembeli*') ? 'active' : '' }}">🛒 Kelola Pembeli</a>
                </div>
            </div>

            <a href="{{ route('admin.profile') ?? '#' }}" class="{{ request()->is('admin/profile*') ? 'active' : '' }}">⚙️ Profil</a>
        </div>

        <div class="bottom-links text-center mt-3">
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-sm btn-light text-danger fw-bold">Logout</button>
            </form>
        </div>
    </div>

    {{-- MAIN CONTENT --}}
    <div class="main-content">
        <div class="topbar">
            @php
                use Illuminate\Support\Facades\Auth;
                $admin = Auth::guard('admin')->user();
            @endphp

            <div class="profile">
                <img src="{{ $admin && $admin->avatar ? asset('storage/' . $admin->avatar) : asset('images/default-avatar.png') }}" alt="Avatar">
                <div>
                    <strong>{{ $admin->name ?? 'Admin' }}</strong><br>
                    <small>Admin</small>
                </div>
            </div>
        </div>

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Dropdown toggle sidebar
        document.querySelectorAll('.dropdown-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                this.classList.toggle('active');
                const dropdown = this.nextElementSibling;
                dropdown.classList.toggle('show');
            });
        });
    </script>
</body>
</html>
