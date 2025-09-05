<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Custom Styles -->
    <style>
        .nav-link {
            position: relative;
            transition: all 0.3s ease;
            white-space: nowrap;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #3b82f6, #8b5cf6);
            transition: width 0.3s ease;
        }
        
        .nav-link:hover::after,
        .nav-link.active::after {
            width: 100%;
        }
        
        .sidebar-item {
            transition: all 0.3s ease;
            border-radius: 0.5rem;
        }
        
        .sidebar-item:hover {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(139, 92, 246, 0.1));
            transform: translateX(5px);
        }
        
        .sidebar-item.active {
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
        }
        
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-slide-in {
            animation: slideIn 0.5s ease-out;
        }
        
        /* Ensure proper text wrapping */
        .break-words {
            word-wrap: break-word;
            overflow-wrap: break-word;
        }
        
        /* Better flex behavior */
        .min-w-0 {
            min-width: 0;
        }
        
        .flex-shrink-0 {
            flex-shrink: 0;
        }
        
        /* Prevent overflow */
        .overflow-hidden {
            overflow: hidden;
        }
        
        .text-ellipsis {
            text-overflow: ellipsis;
            overflow: hidden;
            white-space: nowrap;
        }

        /* Fix for 100% zoom layout issues */
        body { overflow-x: auto; }

        .container-fluid {
            width: 100%;
            max-width: none;
            padding-left: 1rem;
            padding-right: 1rem;
        }

        /* Global compact rules to improve fit at 100% zoom */
        @media (min-width: 1024px) and (max-width: 1535px) {
            .compact-header { padding-top: 0.5rem; padding-bottom: 0.5rem; }
            .compact-cards { gap: 1rem; }
            .compact-card { padding: 0.75rem; }
            .compact-title { font-size: 1rem; }
            .compact-subtitle { font-size: 0.7rem; }
            .compact-number { font-size: 1.25rem; }
            .compact-icon { width: 1rem; height: 1rem; }
        }

        /* Ensure navigation doesn't wrap at 100% zoom */
        @media (min-width: 1024px) {
            .nav-container {
                flex-wrap: nowrap;
                overflow-x: auto;
                scrollbar-width: thin;
            }
            
            .nav-links {
                flex-shrink: 1;
                min-width: 0;
                overflow-x: auto;
                scrollbar-width: thin;
                white-space: nowrap;
            }
        }

        /* Responsive adjustments for better 100% zoom experience */
        @media (max-width: 1279px) {
            .nav-links {
                display: none;
            }
            
            .mobile-nav-toggle {
                display: block;
            }
        }

        @media (min-width: 1280px) {
            .nav-links {
                display: flex;
            }
            
            .mobile-nav-toggle {
                display: none;
            }
        }

        /* Ensure content fits properly at 100% zoom */
        .content-wrapper {
            width: 100%;
            max-width: 100%;
            overflow-x: auto;
            /* Offset for sticky navbar to avoid overlap at 100% zoom */
            padding-top: 8.5rem; /* extra headroom so headers never clip */
        }

        /* Make tables responsive */
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        /* Ensure grid layouts work properly */
        .grid-responsive {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1rem;
        }

        @media (min-width: 640px) {
            .grid-responsive {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (min-width: 1024px) {
            .grid-responsive {
                grid-template-columns: repeat(4, 1fr);
            }
        }

        @media (min-width: 1280px) {
            .grid-responsive {
                grid-template-columns: repeat(4, 1fr);
            }
        }

        /* Additional fixes for 100% zoom */
        @media (max-width: 1279px) {
            .nav-links {
                display: none !important;
            }
            
            .mobile-nav-toggle {
                display: block !important;
            }
        }
        
        @media (min-width: 1280px) {
            .nav-links {
                display: flex !important;
            }
            
            .mobile-nav-toggle {
                display: none !important;
            }
        }
    </style>
</head>
<body class="font-sans antialiased bg-gradient-to-br from-gray-900 via-gray-800 to-black">
    <div class="min-h-screen">
        {{-- Navbar utama admin: tetap tampil hanya jika bukan pelaku_umkm --}}
        @if(!(auth()->check() && auth()->user()->role === 'pelaku_umkm'))
            @include('layouts.navigation')
        @endif
        <!-- Page Content with animation -->
        <main class="animate-slide-in content-wrapper pt-14">
            @yield('content')
        </main>
    </div>

    <!-- Alpine.js for mobile menu -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('navigation', () => ({
                open: false
            }))
        })
    </script>
</body>
</html>
