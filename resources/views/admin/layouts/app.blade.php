<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - @yield('title')</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/WebsiteJWPku.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/WebsiteJWPku.png') }}">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Custom Navbar Styling */
        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 0 0 15px 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        
        /* Main Content Styling */
        .main-content {
            background: #f8f9fa;
            min-height: calc(100vh - 76px);
            padding-top: 20px;
        }
        
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }
        
        /* Navbar Styling */
        .navbar-nav .nav-link {
            font-size: 0.875rem;
            padding: 8px 16px;
        }
        
        .navbar-nav .nav-link.active {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            font-weight: 600;
        }
        
        .navbar-nav .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        
        .dropdown-menu {
            border: none;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.15);
        }
        
        .dropdown-item {
            border-radius: 8px;
            margin: 2px 8px;
            transition: all 0.3s ease;
        }
        
        .dropdown-item:hover {
            background: linear-gradient(135deg, #0d6efd 0%, #0056b3 100%);
            color: white;
            transform: translateX(5px);
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .main-content {
                padding-top: 10px;
            }
            
            .navbar-nav .nav-link {
                padding: 8px 16px;
                margin: 2px 0;
            }
            
            .navbar {
                border-radius: 0 0 10px 10px;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <!-- Brand/Logo -->
            <a class="navbar-brand d-flex align-items-center" href="{{ route('admin.layanan.index') }}">
                <img src="{{ asset('images/WebsiteJWPku.png') }}" alt="WebsiteJWPku" width="40" height="40" class="me-2">
                <span class="fw-bold">WebsiteJWPku</span>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu" aria-controls="navMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.layanan.*') ? 'active' : '' }}" href="{{ route('admin.layanan.index') }}">
                            Katalog Website
                        </a>
                    </li>
                    <li class="nav-item ms-4">
                        <a class="nav-link {{ request()->routeIs('admin.pesan.*') ? 'active' : '' }}" href="{{ route('admin.pesan.order') }}">
                            Pesan Masuk
                            @if(isset($unreadMessagesCount) && $unreadMessagesCount > 0)
                                <span class="badge bg-danger ms-1">{{ $unreadMessagesCount }}</span>
                            @endif
                        </a>
                    </li>
                </ul>
                
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Admin
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li>
                                <form method="POST" action="{{ route('admin.logout') }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
            <main class="px-md-4 main-content">
                <div class="pt-3">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </main>
    </div>

    <!-- Footer -->
    <footer class="text-white py-3 mt-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 15px 15px 0 0; box-shadow: 0 -4px 15px rgba(0,0,0,0.1);">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <p class="mb-1">&copy; {{ date('Y') }} WebsiteJWPKU. All rights reserved.</p>
                    <small class="text-white-50">Developed by Donnie</small>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
