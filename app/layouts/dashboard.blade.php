<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') — SIMPKL</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Syne:wght@700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #667eea;
            --primary-end: #764ba2;
            --gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --bg: #F8F9FA;
            --surface: #ffffff;
            --text: #1a1a2e;
            --r-2xl: 24px;
            --r-xl: 16px;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background-color: var(--bg);
            color: var(--text);
            margin: 0;
            display: flex;
        }

        /* Sidebar simple ala Modern Dashboard */
        .sidebar {
            width: 280px;
            height: 100vh;
            background: var(--surface);
            border-right: 1px solid rgba(0,0,0,0.05);
            padding: 32px;
            position: fixed;
        }

        .main-content {
            margin-left: 280px;
            width: calc(100% - 280px);
            padding: 40px;
        }

        .logo {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 1.5rem;
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 40px;
        }

        .nav-link {
            display: block;
            padding: 12px 16px;
            color: #64748b;
            text-decoration: none;
            border-radius: 12px;
            margin-bottom: 8px;
            transition: all 0.3s;
        }

        .nav-link.active {
            background: rgba(102, 126, 234, 0.1);
            color: var(--primary);
            font-weight: 600;
        }

        .card {
            background: var(--surface);
            border-radius: var(--r-2xl);
            padding: 24px;
            border: 1px solid rgba(0,0,0,0.05);
            box-shadow: 0 10px 30px rgba(0,0,0,0.02);
        }
    </style>
    @stack('styles')
</head>
<body>
    <aside class="sidebar">
        <div class="logo">SIMPKL</div>
        <nav>
            <a href="#" class="nav-link active">🏠 Dashboard</a>
            <a href="{{ route('siswa.jurnal.create') }}" class="nav-link">📝 Jurnal Harian</a>
            <a href="#" class="nav-link">📁 Laporan PKL</a>
            <a href="#" class="nav-link">📊 Nilai Saya</a>
        </nav>
    </aside>

    <main class="main-content">
        @yield('content')
    </main>
</body>
</html>