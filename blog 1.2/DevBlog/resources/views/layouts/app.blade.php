<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'DevBlog - Modern Developer Platform')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Sprint 3 - Modern Animations & Styling -->
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --dark-gradient: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            --light-gradient: linear-gradient(135deg, #fafafa 0%, #f8f9fa 100%);
            --shadow-soft: 0 10px 40px rgba(0,0,0,0.1);
            --shadow-hover: 0 20px 60px rgba(0,0,0,0.15);
            --border-radius: 16px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --bounce: cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }
        
        * {
            transition: var(--transition);
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: var(--light-gradient);
            line-height: 1.6;
            color: #2d3748;
        }
        
        /* Sprint 3 - Modern Navbar */
        .navbar-modern {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: var(--shadow-soft);
            transition: var(--transition);
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        /* Sprint 3 - Modern Cards */
        .card-modern {
            border: none;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-soft);
            transition: var(--transition);
            overflow: hidden;
            background: white;
        }
        
        .card-modern:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-hover);
        }
        
        .card-modern .card-body {
            padding: 2rem;
        }
        
        /* Sprint 3 - Animated Buttons */
        .btn-modern {
            border-radius: 50px;
            padding: 12px 32px;
            font-weight: 600;
            border: none;
            position: relative;
            overflow: hidden;
            transition: var(--transition);
        }
        
        .btn-modern::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: var(--transition);
        }
        
        .btn-modern:hover::before {
            left: 100%;
        }
        
        .btn-primary-modern {
            background: var(--primary-gradient);
            color: white;
        }
        
        .btn-success-modern {
            background: var(--success-gradient);
            color: white;
        }
        
        .btn-secondary-modern {
            background: var(--secondary-gradient);
            color: white;
        }
        
        /* Sprint 3 - Hero Section - Fixed Readability */
        .hero-section {
            background: var(--primary-gradient);
            min-height: 70vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }
        
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.2);
            z-index: 1;
        }
        
        .hero-content {
            position: relative;
            z-index: 3;
        }
        
        .hero-section .text-white {
            color: #ffffff !important;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }
        
        /* Sprint 3 - Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        .animate-fade-up {
            animation: fadeInUp 0.8s var(--bounce);
        }
        
        .animate-fade-left {
            animation: fadeInLeft 0.8s var(--bounce);
        }
        
        .animate-fade-right {
            animation: fadeInRight 0.8s var(--bounce);
        }
        
        .animate-pulse {
            animation: pulse 2s infinite;
        }
        
        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
        
        /* Sprint 3 - Loading States */
        .skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }
        
        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }
        
        /* Sprint 3 - Modern Form Elements - Enhanced */
        .form-control-modern {
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 1rem 1.5rem;
            background: white;
            transition: var(--transition);
            font-size: 1rem;
            font-weight: 500;
            color: #1f2937;
        }
        
        .form-control-modern::placeholder {
            color: #9ca3af;
            font-weight: 400;
        }
        
        .form-control-modern:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
            background-color: #fafbff;
            outline: none;
        }
        
        .form-control-modern:hover {
            border-color: #cbd5e0;
        }
        
        /* Modern Auth Forms */
        .auth-card {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            border: none;
            max-width: 450px;
            margin: 0 auto;
        }
        
        .auth-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }
        
        .auth-title {
            font-size: 2rem;
            font-weight: 700;
            color: #1a202c;
            margin-bottom: 0.5rem;
        }
        
        .auth-subtitle {
            color: #4a5568;
            font-size: 1rem;
            margin-bottom: 0;
            font-weight: 500;
        }
        
        .form-group-modern {
            margin-bottom: 1.5rem;
        }
        
        .form-label-modern {
            display: block;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }
        
        .btn-auth {
            width: 100%;
            padding: 1rem;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 12px;
            border: none;
            transition: var(--transition);
            margin-bottom: 1rem;
        }
        
        .btn-auth-primary {
            background: var(--primary-gradient);
            color: white;
        }
        
        .btn-auth-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
            color: white;
        }
        
        .btn-auth-outline {
            background: transparent;
            color: #667eea;
            border: 2px solid #667eea;
        }
        
        .btn-auth-outline:hover {
            background: #667eea;
            color: white;
            transform: translateY(-1px);
        }
        
        .auth-divider {
            position: relative;
            text-align: center;
            margin: 1.5rem 0;
            color: #6b7280;
            font-size: 0.9rem;
            font-weight: 500;
        }
        
        .auth-divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #e5e7eb;
            z-index: 1;
        }
        
        .auth-divider span {
            background: white;
            padding: 0 1rem;
            position: relative;
            z-index: 2;
        }
        
        .auth-link {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            transition: var(--transition);
        }
        
        .auth-link:hover {
            color: #5a67d8;
            text-decoration: underline;
        }
        
        .remember-me {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }
        
        .remember-me input[type="checkbox"] {
            width: 1.2rem;
            height: 1.2rem;
            border-radius: 4px;
            border: 2px solid #d1d5db;
            cursor: pointer;
        }
        
        .remember-me input[type="checkbox"]:checked {
            background-color: #667eea;
            border-color: #667eea;
        }
        
        .remember-me label {
            color: #374151 !important;
            font-weight: 500;
        }
        
        /* Sprint 3 - Badge Animations - Fixed Contrast */
        .badge-modern {
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.85rem;
            transition: var(--transition);
            color: white !important;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
        }
        
        .badge-modern:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        
        /* Sprint 3 - Container Improvements */
        .container-modern {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }
        
        /* Sprint 3 - Responsive Typography */
        .display-1-modern {
            font-size: 3.5rem;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 1.5rem;
        }
        
        .lead-modern {
            font-size: 1.25rem;
            font-weight: 400;
            opacity: 0.9;
            line-height: 1.6;
        }
        
        /* Sprint 3 - Mobile Responsiveness */
        @media (max-width: 768px) {
            .display-1-modern {
                font-size: 2.5rem;
            }
            
            .hero-section {
                min-height: 60vh;
                text-align: center;
            }
            
            .btn-modern {
                padding: 10px 24px;
                font-size: 0.9rem;
            }
        }
        
        /* Sprint 3 - Better Text Contrast */
        .text-contrast {
            color: #1a202c !important;
            font-weight: 600;
        }
        
        .text-light-contrast {
            color: #4a5568 !important;
        }
        
        .bg-overlay {
            position: relative;
        }
        
        .bg-overlay::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.9);
            z-index: 1;
        }
        
        .bg-overlay > * {
            position: relative;
            z-index: 2;
        }
        
        /* Enhanced Alert Styles */
        .alert-modern {
            border: none;
            border-radius: 12px;
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
            font-weight: 500;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        .alert-success {
            background: linear-gradient(135deg, #48bb78, #38a169);
            color: white;
        }
        
        .alert-danger {
            background: linear-gradient(135deg, #f56565, #e53e3e);
            color: white;
        }
        
        .alert-info {
            background: linear-gradient(135deg, #4299e1, #3182ce);
            color: white;
        }
        
        /* Dark Mode Support - Improved */
        @media (prefers-color-scheme: dark) {
            body {
                background: var(--dark-gradient);
                color: #e2e8f0;
            }
            
            .card-modern {
                background: rgba(45, 55, 72, 0.95);
                color: #e2e8f0;
                border: 1px solid rgba(255, 255, 255, 0.1);
            }
            
            .navbar-modern {
                background: rgba(26, 32, 44, 0.95);
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            }
            
            .auth-card {
                background: #2d3748;
                color: #e2e8f0;
                border: 1px solid rgba(255, 255, 255, 0.1);
            }
            
            .form-label-modern {
                color: #f7fafc !important;
            }
            
            .auth-subtitle {
                color: #cbd5e0 !important;
            }
            
            .remember-me label {
                color: #e2e8f0 !important;
            }
            
            .auth-divider {
                color: #a0aec0 !important;
            }
            
            .form-control-modern {
                background: #4a5568;
                border-color: #718096;
                color: white;
            }
            
            .form-control-modern::placeholder {
                color: #a0aec0;
            }
            
            .form-control-modern:focus {
                background-color: #2d3748;
                border-color: #667eea;
            }
        }
    </style>
    
    @vite(['resources/js/app.js'])
    @stack('styles')
</head>
<body>
    <!-- Sprint 3 - Modern Navigation -->
    <nav class="navbar navbar-expand-lg navbar-modern fixed-top">
        <div class="container-modern">
            <a class="navbar-brand animate-pulse" href="{{ route('home') }}">
                <i class="fas fa-blog me-2"></i>DevBlog
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">
                            <i class="fas fa-home me-1"></i>Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('posts.index') }}">
                            <i class="fas fa-newspaper me-1"></i>Posts
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('categories.index') }}">
                            <i class="fas fa-tags me-1"></i>Categories
                        </a>
                    </li>
                </ul>
                
                <ul class="navbar-nav">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt me-1"></i>Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-primary-modern btn-modern ms-2" href="{{ route('register') }}">
                                <i class="fas fa-user-plus me-1"></i>Join Now
                            </a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                                <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center me-2" 
                                     style="width: 32px; height: 32px; font-size: 0.8rem;">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                                </div>
                                {{ Auth::user()->display_name }}
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('dashboard') }}">
                                    <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                                </a></li>
                                <li><a class="dropdown-item" href="{{ route('posts.create') }}">
                                    <i class="fas fa-plus me-2"></i>Write Post
                                </a></li>
                                <li><a class="dropdown-item" href="{{ route('posts.my') }}">
                                    <i class="fas fa-file-alt me-2"></i>My Posts
                                </a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <i class="fas fa-user-edit me-2"></i>Profile
                                </a></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                        @csrf
                                        <button class="dropdown-item" type="submit">
                                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Sprint 3 - Flash Messages -->
    @if(session('success') || session('error') || session('info'))
        <div style="margin-top: 80px;">
            <div class="container-modern">
                @if(session('success'))
                    <div class="alert alert-modern alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-modern alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                @if(session('info'))
                    <div class="alert alert-modern alert-info alert-dismissible fade show" role="alert">
                        <i class="fas fa-info-circle me-2"></i>
                        {{ session('info') }}
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                    </div>
                @endif
            </div>
        </div>
    @endif

    <!-- Sprint 3 - Main Content with proper spacing -->
    <main style="margin-top: {{ session()->hasAny(['success', 'error', 'info']) ? '0' : '80px' }};">
        @yield('content')
    </main>

    <!-- Sprint 3 - Modern Footer -->
    <footer class="bg-dark text-white py-5 mt-5">
        <div class="container-modern">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="mb-3">
                        <i class="fas fa-blog me-2"></i>DevBlog Platform
                    </h5>
                    <p class="lead-modern">
                        Built with ❤️ using Laravel & Livewire
                        <br><small class="opacity-75">Sprint 3 - Modern UI Complete</small>
                    </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <div class="d-flex justify-content-md-end gap-3">
                        <a href="#" class="text-white-50 hover:text-white">
                            <i class="fab fa-twitter fa-lg"></i>
                        </a>
                        <a href="#" class="text-white-50 hover:text-white">
                            <i class="fab fa-github fa-lg"></i>
                        </a>
                        <a href="#" class="text-white-50 hover:text-white">
                            <i class="fab fa-linkedin fa-lg"></i>
                        </a>
                    </div>
                    <small class="text-white-50 mt-3 d-block">
                        © {{ date('Y') }} DevBlog. All rights reserved.
                    </small>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Sprint 3 - Modern Interactions -->
    <script>
        // Modern scroll effects
        window.addEventListener('scroll', () => {
            const navbar = document.querySelector('.navbar-modern');
            if (window.scrollY > 50) {
                navbar.style.background = 'rgba(255, 255, 255, 0.98)';
                navbar.style.boxShadow = '0 15px 35px rgba(0,0,0,0.1)';
            } else {
                navbar.style.background = 'rgba(255, 255, 255, 0.95)';
                navbar.style.boxShadow = '0 10px 40px rgba(0,0,0,0.1)';
            }
        });

        // Intersection Observer for animations
        const observeElements = document.querySelectorAll('[class*="animate-"]');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animationPlayState = 'running';
                }
            });
        });

        observeElements.forEach(el => {
            el.style.animationPlayState = 'paused';
            observer.observe(el);
        });
    </script>
    
    @stack('scripts')
</body>
</html>
