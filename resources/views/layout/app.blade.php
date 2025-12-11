<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Hệ Thống Cứu Trợ</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.13.3/cdn.min.js" defer></script>
    <script>
        window.tailwind = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            DEFAULT: '#6366f1'
                        }
                    }
                }
            }
        }
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />


    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            background: linear-gradient(135deg, #0b1220 0%, #111827 100%);
            min-height: 100vh;
            color: #e5e7eb;
        }

        .dashboard-container { display: grid; grid-template-columns: 280px 1fr; min-height: 100vh; }

        /* Sidebar */
        .sidebar { background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(20px); padding: 2rem 1rem; box-shadow: 2px 0 20px rgba(0, 0, 0, 0.1); border-right: 1px solid rgba(255, 255, 255, 0.2); }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #e5e7eb;
        }

        .logo i {
            font-size: 2rem;
            background: linear-gradient(45deg, #ff6b6b, #4ecdc4);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .logo h2 {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1f2937;
        }

        .nav-menu {
            list-style: none;
        }

        .nav-item {
            margin-bottom: 0.5rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.75rem 1rem;
            color: #6b7280;
            text-decoration: none;
            border-radius: 12px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-weight: 500;
        }

        .nav-link:hover, .nav-link.active {
            background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
            color: white;
            transform: translateX(4px);
            box-shadow: 0 4px 20px rgba(34, 197, 94, 0.35);
        }

        .nav-link i {
            font-size: 1.1rem;
            width: 20px;
        }

        /* Main Content */
        .main-content {
            padding: 2rem 2rem 2rem 1rem;
            overflow-y: auto;
        }

        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(20px); padding: 1.5rem 2rem; border-radius: 20px; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1); }

        .header h1 {
            color: #1f2937;
            font-size: 2rem;
            font-weight: 700;
        }

        /* Cards */
        .card { 
            border: 0; 
            border-radius: 20px; 
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1); 
            margin-bottom: 24px; 
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(20px);
        }
        .card-header { 
            border-bottom: 2px solid #f3f4f6; 
            background: transparent; 
            color: #1f2937;
            font-weight: 700;
            font-size: 1.25rem;
            padding: 1rem 1.5rem;
        }
        .card > .overflow-x-auto { padding: 1rem 1.5rem; }
        .table { margin-bottom: 0; color: #1f2937; }
        .table thead th { 
            font-weight: 700; 
            color: #374151; 
            background: #f9fafb !important; 
            border-color: #e5e7eb;
        }
        .table tbody tr { border-bottom: 1px solid #e5e7eb; }
        .table tbody tr:hover { background: #f8fafc; }
        .badge { padding: 6px 10px; border-radius: 10px; font-weight: 600; }
        .btn-custom { 
            background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
            border: none; 
            color: white; 
            border-radius: 12px; 
            padding: 0.75rem 1.5rem; 
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(34, 197, 94, 0.35);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .btn-custom:hover { 
            background: linear-gradient(135deg, #16a34a 0%, #15803d 100%); 
            color: white; 
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(34, 197, 94, 0.5);
        }
        .form-label { font-weight: 600; color: #374151; }
        .text-muted { color: #6b7280 !important; }

        /* Page Header */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 2rem;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            padding: 1.5rem 2rem;
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .page-title h2 {
            font-size: 1.75rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 0.5rem;
        }

        .page-title p {
            color: #6b7280;
            font-size: 0.95rem;
            margin: 0;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .dashboard-container {
                grid-template-columns: 1fr;
            }
            
            .sidebar {
                position: fixed;
                top: 0;
                left: -280px;
                height: 100vh;
                z-index: 1000;
                transition: left 0.3s ease;
            }
            
            .sidebar.open {
                left: 0;
            }
        }

        @media (max-width: 768px) {
            .main-content {
                padding: 1rem;
            }
            
            .header {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }
        }

        /* Custom Scrollbar */
        .main-content::-webkit-scrollbar {
            width: 6px;
        }

        .main-content::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 3px;
        }

        .main-content::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }

        .main-content::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Animations */
        .fade-in {
            animation: fadeIn 0.6s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .slide-in {
            animation: slideIn 0.4s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container" x-data="{ sidebarOpen: false, activeTab: '{{ request()->route()->getName() }}' }">
        <!-- Sidebar -->
        <aside class="sidebar" :class="{ 'open': sidebarOpen }">
            <div class="logo">
                <i class="fas fa-hands-helping"></i>
                <h2>Cứu trợ VN</h2>
            </div>
            
            <nav>
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a href="/dashboard" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>Tổng quan</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/relief_requests" class="nav-link {{ request()->is('relief_requests*') ? 'active' : '' }}">
                            <i class="fas fa-list-check"></i>
                            <span>Yêu Cầu</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/relief_supplies" class="nav-link {{ request()->is('relief_supplies*') ? 'active' : '' }}">
                            <i class="fas fa-warehouse"></i>
                            <span>Kho Hàng</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/distributions" class="nav-link {{ request()->is('distributions*') ? 'active' : '' }}">
                            <i class="fas fa-truck"></i>
                            <span>Phân Phối</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <header class="header">
                <div>
                    <h1>@yield('title')</h1>
                    <p style="color: #6b7280; margin-top: 0.5rem;">
                        Cập nhật: <span x-text="new Date().toLocaleString('vi-VN')"></span>
                    </p>
                </div>
                
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <div style="text-align: right;">
                        <div style="font-weight: 600; color: #1f2937;">Admin User</div>
                        <div style="font-size: 0.875rem; color: #6b7280;">Điều phối viên</div>
            </div>
        </div>
            </header>

        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
        </main>
    </div>

    <script>
        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.createElement('button');
            menuToggle.innerHTML = '<i class="fas fa-bars"></i>';
            menuToggle.style.cssText = `position: fixed; top: 1rem; left: 1rem; z-index: 1001; background: rgba(255, 255, 255, 0.9); border: none; padding: 0.75rem; border-radius: 8px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); display: none; cursor: pointer;`;
            
            document.body.appendChild(menuToggle);
            
            function checkScreenSize() {
                if (window.innerWidth <= 1024) {
                    menuToggle.style.display = 'block';
                } else {
                    menuToggle.style.display = 'none';
                }
            }
            
            checkScreenSize();
            window.addEventListener('resize', checkScreenSize);
            
            menuToggle.addEventListener('click', () => {
                const root = document.querySelector('[x-data]');
                const current = root.__x.$data.sidebarOpen;
                root.__x.$data.sidebarOpen = !current;
            });
        });
    </script>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    @stack('scripts')
</body>
</html>
