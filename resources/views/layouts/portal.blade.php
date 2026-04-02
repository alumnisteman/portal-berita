<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Portal Berita Terkini') - Info Portal</title>
    <meta name="description" content="@yield('meta_description', 'Portal berita terpercaya menyajikan informasi terkini seputar Politik, Ekonomi, Teknologi, dan Gaya Hidup.')">
    <meta name="keywords" content="portal berita, info terkini, berita indonesia, berita hari ini, @yield('meta_keywords')">
    <meta name="author" content="Info Portal">
    <meta name="robots" content="index, follow">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'Portal Berita Terkini') - Info Portal">
    <meta property="og:description" content="@yield('meta_description', 'Portal berita terpercaya menyajikan informasi terkini seputar Politik, Ekonomi, Teknologi, dan Gaya Hidup.')">
    <meta property="og:image" content="@yield('og_image', asset('favicon.ico'))">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('title', 'Portal Berita Terkini') - Info Portal">
    <meta property="twitter:description" content="@yield('meta_description', 'Portal berita terpercaya menyajikan informasi terkini seputar Politik, Ekonomi, Teknologi, dan Gaya Hidup.')">
    <meta property="twitter:image" content="@yield('og_image', asset('favicon.ico'))">

    @if(config('services.google.analytics_id'))
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('services.google.analytics_id') }}"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', '{{ config('services.google.analytics_id') }}');
    </script>
    @endif

    @if(config('services.google.adsense_id'))
    <!-- Google AdSense -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client={{ config('services.google.adsense_id') }}" crossorigin="anonymous"></script>
    @endif
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts - Inter & Playfair Display -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,700;0,800;0,900;1,700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-indigo: #4f46e5;
            --primary-dark: #0f172a;
            --accent-rose: #e11d48;
            --text-main: #334155;
            --text-muted: #64748b;
            --bg-light: #f8fafc;
            --card-bg: #ffffff;
            --border-color: #e2e8f0;
            --nav-bg: rgba(255, 255, 255, 0.85);
            --sidebar-bg: #ffffff;
        }

        body.dark-mode {
            --primary-dark: #f8fafc;
            --text-main: #cbd5e1;
            --text-muted: #94a3b8;
            --bg-light: #020617;
            --card-bg: #0f172a;
            --card-border: rgba(255, 255, 255, 0.1);
            --border-color: #1e293b;
            --nav-bg: rgba(2, 6, 23, 0.9);
            --sidebar-bg: #0f172a;
        }

        body { 
            font-family: 'Inter', sans-serif; 
            background-color: var(--bg-light); 
            color: var(--text-main);
            line-height: 1.625;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        h1, h2, h3, h4, h5, h6, .font-playfair { 
            font-family: 'Playfair Display', serif; 
            color: var(--primary-dark);
            letter-spacing: -0.02em;
        }

        /* Glassmorphism Navbar */
        .navbar-custom {
            background: var(--nav-bg) !important;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }

        .navbar-brand { 
            font-family: 'Playfair Display', serif; 
            font-weight: 700; 
            font-size: 1.6rem; 
            background: linear-gradient(45deg, var(--primary-indigo), var(--accent-rose));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Modern Hero Section */
        .hero-section { 
            background: var(--bg-light);
            padding: 4rem 0; 
            border-bottom: 1px solid var(--border-color);
        }

        /* Modern News Cards */
        .card-news { 
            background: var(--card-bg);
            border: none; 
            border-radius: 1.5rem; 
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            margin-bottom: 2rem;
            border: 1px solid var(--border-color);
        }

        .card-news:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        /* Consistent PRO 16:9 Aspect Ratio */
        .card-news img { 
            aspect-ratio: 16/9;
            width: 100%;
            height: auto;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .card-news:hover img { 
            transform: scale(1.05); 
        }

        .category-pill { 
            background-color: rgba(99, 102, 241, 0.1); 
            color: var(--primary-indigo); 
            font-weight: 600;
            font-size: 0.75rem; 
            text-transform: uppercase; 
            padding: 0.4rem 1rem; 
            border-radius: 2rem;
            letter-spacing: 0.05em;
            display: inline-block;
            margin-bottom: 1rem;
        }

        .footer { 
            background-color: #020617; 
            color: #94a3b8; 
            padding: 4rem 0; 
            margin-top: 6rem; 
        }

        .btn-modern { 
            background-color: var(--primary-indigo); 
            color: white; 
            border: none; 
            border-radius: 0.75rem;
            padding: 0.6rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-modern:hover { 
            background-color: #4f46e5; 
            color: white; 
            transform: scale(1.05);
            box-shadow: 0 10px 15px -3px rgba(99, 102, 241, 0.3);
        }

        /* Custom Pagination */
        .pagination .page-item .page-link {
            border: none;
            margin: 0 3px;
            border-radius: 0.5rem;
            color: var(--primary-dark);
            background-color: var(--card-bg);
        }

        .pagination .page-item.active .page-link {
            background-color: var(--primary-indigo);
            color: white;
            box-shadow: 0 4px 6px rgba(99, 102, 241, 0.2);
        }

        .dark-toggle {
            cursor: pointer;
            padding: 8px;
            border-radius: 50%;
            background: var(--bg-light);
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--border-color);
            color: var(--primary-dark);
        }
        .dark-toggle:hover { transform: rotate(15deg); background: rgba(99, 102, 241, 0.1); }

        /* Breaking News Ticker */
        .breaking-news {
            background: #fff;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
            overflow: hidden;
            white-space: nowrap;
            position: relative;
        }
        .bn-label {
            background: var(--accent-rose);
            color: #fff;
            padding: 5px 15px;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.75rem;
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            display: flex;
            align-items: center;
            z-index: 10;
        }
        .bn-content {
            display: inline-block;
            padding-left: 100%;
            animation: ticker 30s linear infinite;
        }
        @keyframes ticker {
            0% { transform: translate3d(0, 0, 0); }
            100% { transform: translate3d(-100%, 0, 0); }
        }
        .bn-item { display: inline-block; padding: 0 20px; font-weight: 600; color: var(--primary-dark); }
        .bn-item:hover { color: var(--primary-indigo); }

        /* Ad Slots */
        .ad-slot-top {
            background: #f1f5f9;
            margin: 20px auto;
            text-align: center;
            min-height: 90px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border-radius: 8px;
        }
        .ad-label {
            font-size: 10px;
            color: #94a3b8;
            text-transform: uppercase;
            display: block;
            margin-bottom: 5px;
        }
        /* Wallpaper Ad */
        .ad-wallpaper {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background-size: cover;
            background-position: center top;
            background-attachment: fixed;
            cursor: pointer;
        }
        @media (max-width: 1200px) { .ad-wallpaper { display: none; } }

        /* AI Animations & Utilities */
        .ai-pulse {
            width: 12px;
            height: 12px;
            background: var(--primary-indigo);
            border-radius: 50%;
            display: inline-block;
            box-shadow: 0 0 0 0 rgba(99, 102, 241, 0.7);
            animation: ai-pulse 2s infinite;
        }
        @keyframes ai-pulse {
            0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(99, 102, 241, 0.7); }
            70% { transform: scale(1); box-shadow: 0 0 0 10px rgba(99, 102, 241, 0); }
            100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(99, 102, 241, 0); }
        }
        .bg-indigo-soft { background: rgba(99, 102, 241, 0.05); }
        body.dark-mode .bg-indigo-soft { background: rgba(99, 102, 241, 0.15); }
        
        .shadow-indigo-10 { box-shadow: 0 10px 15px -3px rgba(99, 102, 241, 0.1); }
        .hover-scale { transition: transform 0.3s ease; }
        .hover-scale:hover { transform: scale(1.02); }

        .ad-sticky-bottom {
            position: fixed;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1050;
            width: 100%;
            max-width: 728px;
            background: #fff;
            box-shadow: 0 -4px 10px rgba(0,0,0,0.1);
            display: none;
        }
        @media (max-width: 768px) { .ad-sticky-bottom { display: block; } }
    </style>
</head>
<body class="{{ isset($ads['wallpaper']) ? 'has-wallpaper' : '' }}">

    @isset($ads['wallpaper'])
        <a href="{{ $ads['wallpaper']->url_link }}" target="_blank" class="ad-wallpaper" style="background-image: url('{{ Storage::url($ads['wallpaper']->image_path) }}')"></a>
    @endisset

    <nav class="navbar navbar-expand-lg navbar-light navbar-custom sticky-top py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="/">
                <span class="fw-bold text-uppercase tracking-tighter" style="letter-spacing: -1px; font-size: 1.5rem; background: linear-gradient(90deg, #1e293b, #4f46e5); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">PORTAL<span style="color: #4f46e5; -webkit-text-fill-color: #4f46e5;">BERITA</span></span>
            </a>
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto gap-1 align-items-center">
                    <li class="nav-item">
                        <a class="nav-link px-3 fw-medium text-slate-700 {{ request()->is('/') ? 'active text-primary' : '' }}" href="/">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link px-3 dropdown-toggle fw-medium text-slate-700" href="#" role="button" data-bs-toggle="dropdown">Kategori</a>
                        <ul class="dropdown-menu border-0 shadow-xl rounded-4 p-2 mt-2">
                            <li><a class="dropdown-item rounded-3 py-2" href="#">Nasional</a></li>
                            <li><a class="dropdown-item rounded-3 py-2" href="#">Ekonomi</a></li>
                            <li><a class="dropdown-item rounded-3 py-2" href="#">Teknologi</a></li>
                            <li><a class="dropdown-item rounded-3 py-2" href="#">Hiburan</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3 fw-medium text-slate-700 {{ request()->is('bookmarks') ? 'active text-primary' : '' }}" href="/bookmarks">Terarsip</a>
                    </li>
                </ul>
                <div class="ms-lg-4 d-flex align-items-center gap-3">
                    <div class="dark-toggle" id="theme-toggle" title="Ganti Tema">
                        <svg class="sun-icon d-none" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707M16.243 17.657l.707-.707M7.757 6.364l.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z"></path></svg>
                        <svg class="moon-icon" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                    </div>
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn btn-modern px-4 py-2">Dasbor</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-modern px-4 py-2">Masuk</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    @isset($latest_news)
    <div class="breaking-news">
        <div class="bn-label">Breaking News</div>
        <div class="bn-content">
            @foreach($latest_news as $news)
                <a href="{{ route('news.show', $news->slug) }}" class="bn-item text-decoration-none">
                    {{ $news->title }} &nbsp; • &nbsp;
                </a>
            @endforeach
        </div>
    </div>
    @endisset

    <div class="container">
        @isset($ads['top_leaderboard'])
            <div class="ad-slot-top">
                <div>
                    <span class="ad-label">Advertisement</span>
                    <a href="{{ $ads['top_leaderboard']->url_link }}" target="_blank">
                        <img src="{{ Storage::url($ads['top_leaderboard']->image_path) }}" alt="Ad">
                    </a>
                </div>
            </div>
        @endisset
    </div>

    <main>
        @yield('content')
    </main>

    <footer class="footer">
        <div class="container text-center">
            <h5 class="navbar-brand text-white mb-4">Info Portal</h5>
            <p class="mb-4">Informasi terpercaya untuk generasi cerdas.</p>
            <div class="d-flex justify-content-center gap-4 mb-4 flex-wrap">
                <a href="{{ route('about') }}" class="text-decoration-none" style="color: #94a3b8">Tentang Kami</a>
                <a href="{{ route('privacy') }}" class="text-decoration-none" style="color: #94a3b8">Kebijakan Privasi</a>
                <a href="mailto:redaksi@infoportal.id" class="text-decoration-none" style="color: #94a3b8">Kontak</a>
            </div>
            <p class="small" style="color: #64748b">&copy; {{ date('Y') }} Info Portal. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Pro Features JS -->
    <script>
        // Dark Mode Logic
        const themeToggle = document.getElementById('theme-toggle');
        const sunIcon = themeToggle.querySelector('.sun-icon');
        const moonIcon = themeToggle.querySelector('.moon-icon');
        
        // Check for saved theme
        if (localStorage.getItem('theme') === 'dark' || 
            (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.body.classList.add('dark-mode');
            sunIcon.classList.remove('d-none');
            moonIcon.classList.add('d-none');
        }

        themeToggle.addEventListener('click', () => {
            document.body.classList.toggle('dark-mode');
            const isDark = document.body.classList.contains('dark-mode');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
            
            sunIcon.classList.toggle('d-none');
            moonIcon.classList.toggle('d-none');
        });

        // Mode Hemat Kuota (Data Saver)
        let dataSaver = localStorage.getItem('data-saver') === 'true';
        function applyDataSaver() {
            const images = document.querySelectorAll('.card-news img, .hero-focus img');
            images.forEach(img => {
                if (dataSaver) {
                    img.style.filter = 'blur(10px) grayscale(100%)';
                    img.title = 'Mode Hemat Kuota Aktif';
                } else {
                    img.style.filter = 'none';
                }
            });
        }
        
        // Initial apply
        applyDataSaver();

        window.toggleDataSaver = function() {
            dataSaver = !dataSaver;
            localStorage.setItem('data-saver', dataSaver);
            applyDataSaver();
            alert('Mode Hemat Kuota: ' + (dataSaver ? 'Aktif' : 'Non-aktif'));
        };

        // Bookmark Logic (LocalStorage)
        function getBookmarks() {
            return JSON.parse(localStorage.getItem('bookmarks') || '[]');
        }

        window.toggleBookmark = function(id, title, url, image) {
            let bookmarks = getBookmarks();
            const index = bookmarks.findIndex(b => b.id === id);
            
            if (index > -1) {
                bookmarks.splice(index, 1);
            } else {
                bookmarks.push({id, title, url, image, savedAt: new Date().toISOString()});
            }
            
            localStorage.setItem('bookmarks', JSON.stringify(bookmarks));
            updateBookmarkUI();
            
            // Optional: Notify user
            const btn = document.querySelector(`.bookmark-btn[data-id="${id}"]`);
            if (btn) {
                btn.classList.add('animate-ping');
                setTimeout(() => btn.classList.remove('animate-ping'), 500);
            }
        };

        function updateBookmarkUI() {
            const bookmarks = getBookmarks();
            document.querySelectorAll('.bookmark-btn').forEach(btn => {
                const id = parseInt(btn.getAttribute('data-id'));
                const isBookmarked = bookmarks.some(b => b.id === id);
                if (isBookmarked) {
                    btn.classList.remove('btn-light');
                    btn.classList.add('btn-primary');
                    btn.querySelector('svg').setAttribute('fill', 'currentColor');
                } else {
                    btn.classList.remove('btn-primary');
                    btn.classList.add('btn-light');
                    btn.querySelector('svg').setAttribute('fill', 'none');
                }
            });
        }

        // Wait for DOM to finish loading for bookmarks
        document.addEventListener('DOMContentLoaded', () => {
            updateBookmarkUI();

            @auth
                // Sync LocalStorage to DB for logged-in users
                const syncBookmarks = async () => {
                    const bookmarks = getBookmarks();
                    if (bookmarks.length === 0) return;

                    try {
                        const response = await fetch('{{ route('bookmarks.sync') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ bookmarks })
                        });
                        const result = await response.json();
                        console.log('Bookmarks synced:', result.message);
                    } catch (e) {
                        console.error('Failed to sync bookmarks:', e);
                    }
                };
                syncBookmarks();
            @endauth
        });
    </script>
</body>
</html>
