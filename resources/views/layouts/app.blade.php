<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Stockify')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --navy: #17243d;
            --blue: #3478f6;
            --bg: #f4f7fc;
        }

        body {
            margin: 0;
            background: var(--bg);
            font-family: 'Segoe UI', sans-serif;
            color: #1c2940;
        }

        .sidebar {
            width: 245px;
            min-height: 100vh;
            background: var(--navy);
            color: white;
            position: fixed;
            left: 0;
            top: 0;
            padding: 24px 15px;
        }

        .brand {
            font-size: 22px;
            font-weight: 700;
            padding: 5px 12px 30px;
        }

        .brand i {
            color: #4c91ff;
            margin-right: 8px;
        }

        .nav-link-custom {
            display: block;
            color: #d3dcec;
            padding: 13px 15px;
            text-decoration: none;
            border-radius: 12px;
            margin-bottom: 7px;
            transition: .2s;
        }

        .nav-link-custom:hover,
        .nav-link-custom.active {
            background: var(--blue);
            color: white;
        }

        .main-content {
            margin-left: 245px;
            min-height: 100vh;
        }

        .topbar {
            background: white;
            padding: 17px 30px;
            border-bottom: 1px solid #e8edf5;
        }

        .page-content {
            padding: 30px;
        }

        .stat-card, .content-card {
            border: none;
            border-radius: 18px;
            background: white;
            box-shadow: 0 4px 18px rgba(32, 55, 90, .05);
        }

        .stat-card {
            padding: 23px;
            height: 100%;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 22px;
        }

        .content-card {
            padding: 22px;
        }

        .btn-primary {
            background: var(--blue);
            border-color: var(--blue);
            border-radius: 10px;
        }

        .table thead th {
            background: #f3f6fb;
            color: #526078;
            border: none;
            padding: 14px;
        }

        .table tbody td {
            padding: 13px;
            vertical-align: middle;
        }

        .form-control, .form-select {
            border-radius: 10px;
            padding: 11px 13px;
        }

        .badge-stock-low {
            background: #ffe3e8;
            color: #d63352;
        }

        .badge-stock-safe {
            background: #dcf7e9;
            color: #16864c;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 75px;
                padding: 20px 8px;
            }

            .sidebar .brand span,
            .sidebar .nav-link-custom span {
                display: none;
            }

            .sidebar .nav-link-custom {
                text-align: center;
                font-size: 20px;
            }

            .main-content {
                margin-left: 75px;
            }

            .page-content {
                padding: 15px;
            }

            .topbar {
                padding: 15px;
            }
        }
    </style>
</head>
<body>

    <aside class="sidebar">
        <div class="brand">
            <i class="bi bi-box-seam"></i>
            <span>Stockify</span>
        </div>

        <a href="{{ route('dashboard') }}"
           class="nav-link-custom {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-house me-2"></i>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('items.index') }}"
           class="nav-link-custom {{ request()->routeIs('items.*') ? 'active' : '' }}">
            <i class="bi bi-box me-2"></i>
            <span>Data Barang</span>
        </a>

        <a href="{{ route('categories.index') }}"
            class="nav-link-custom {{ request()->routeIs('categories.*') ? 'active' : '' }}">
            <i class="bi bi-tags me-2"></i>
            <span>Kategori</span>
        </a>

        <hr class="border-secondary">

        <a href="{{ route('transactions.create', ['type' => 'masuk']) }}"
            class="nav-link-custom">
            <i class="bi bi-box-arrow-in-down me-2"></i>
            <span>Barang Masuk</span>
        </a>

        <a href="{{ route('transactions.create', ['type' => 'keluar']) }}"
            class="nav-link-custom">
            <i class="bi bi-box-arrow-up me-2"></i>
            <span>Barang Keluar</span>
        </a>

        <a href="{{ route('transactions.index') }}"
            class="nav-link-custom {{ request()->routeIs('transactions.index') ? 'active' : '' }}">
            <i class="bi bi-clock-history me-2"></i>
            <span>Riwayat Transaksi</span>
        </a>
    </aside>

    <div class="main-content">
        <header class="topbar d-flex justify-content-between align-items-center">
            <div class="text-secondary">
                <i class="bi bi-list me-2"></i>
                Sistem Inventori Barang
            </div>
            <div class="fw-semibold">
                <i class="bi bi-person-circle me-2 text-primary"></i>
                Admin
            </div>
        </header>

        <main class="page-content">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
