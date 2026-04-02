@extends('layouts.portal')

@section('title', 'Pusat Berita Indonesia')

@section('content')
    <div class="container mt-4">
        <!-- Professional Hero Grid -->
        <div class="row g-4 mb-5">
            <!-- Main Headline (Left) -->
            <div class="col-lg-8">
                @if($latest_news->count() > 0)
                    @php $hero = $latest_news[0]; @endphp
                    <div class="hero-focus position-relative rounded-5 overflow-hidden h-100 shadow-lg border-0 group">
                        <img src="{{ $hero->image ? Storage::url($hero->image) : 'https://images.unsplash.com/photo-1585829365234-7541b71239aa?q=80&w=2070&auto=format&fit=crop' }}" 
                             class="w-100 h-100 object-fit-cover transition-all duration-700 group-hover:scale-105" 
                             alt="{{ $hero->title }}" 
                             style="min-height: 550px;"
                             fetchpriority="high">
                        <div class="position-absolute bottom-0 start-0 w-100 p-4 p-md-5 pt-5" style="background: linear-gradient(to top, rgba(15, 23, 42, 0.95) 0%, rgba(15, 23, 42, 0.4) 50%, transparent 100%);">
                            <span class="badge bg-primary px-3 py-2 rounded-pill mb-3 shadow-sm font-sans fw-bold tracking-wider" style="font-size: 0.7rem;">UTAMA</span>
                            <h2 class="text-white fw-bold display-5 mb-3 font-playfair tracking-tight" style="line-height: 1.1;">
                                <a href="{{ route('news.show', $hero->slug) }}" class="text-white text-decoration-none hover:text-indigo-400 transition-colors">{{ $hero->title }}</a>
                            </h2>
                            <p class="text-slate-300 mb-4 d-none d-md-block fs-5 opacity-90" style="max-width: 90%;">{{ Str::limit(strip_tags($hero->content), 160) }}</p>
                            <div class="d-flex align-items-center gap-3 text-slate-400 small">
                                <span class="fw-medium text-white">{{ $hero->user?->name ?? 'Admin' }}</span>
                                <span class="opacity-30">•</span>
                                <span>{{ $hero->created_at->translatedFormat('d M Y') }}</span>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Secondary Headlines (Right) -->
            <div class="col-lg-4">
                <div class="d-flex flex-column gap-4 h-100">
                    @foreach($latest_news->skip(1)->take(3) as $news)
                        <div class="flex-grow-1">
                            <div class="position-relative rounded-4 overflow-hidden h-100 shadow-md card-news group border-0">
                                <img src="{{ $news->image ? Storage::url($news->image) : 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?q=80&w=2070&auto=format&fit=crop' }}" 
                                     class="w-100 h-100 object-fit-cover transition-all duration-500 group-hover:scale-110" 
                                     alt="{{ $news->title }}" 
                                     style="min-height: 165px;"
                                     loading="lazy">
                                <div class="position-absolute bottom-0 start-0 w-100 p-4" style="background: linear-gradient(to top, rgba(15, 23, 42, 0.9) 0%, transparent 100%);">
                                    <h5 class="text-white fw-bold mb-1 font-playfair" style="line-height: 1.3;">
                                        <a href="{{ route('news.show', $news->slug) }}" class="text-white text-decoration-none small stretched-link">{{ Str::limit($news->title, 65) }}</a>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Main Content Area -->
        <!-- Main Content Area -->
        <div class="row g-5">
            <!-- News Feed -->
            <div class="col-lg-8">
                <div class="d-flex align-items-center justify-content-between mb-4 pb-2 border-bottom border-slate-200">
                    <h4 class="fw-bold m-0 font-playfair fs-2 text-slate-900">Terbaru</h4>
                    <a href="#" class="text-primary text-decoration-none small fw-bold">LIHAT SEMUA</a>
                </div>
                
                <div class="mb-5">
                    <div id="latest-news-container">
                        @forelse ($all_news as $news)
                            @include('partials.news_card', ['news' => $news])
                        @empty
                            <div class="text-center py-5 bg-slate-50 rounded-4">
                                <p class="text-slate-400 mb-0">Belum ada berita yang diterbitkan.</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Load More Action -->
                    @if($all_news->hasMorePages())
                        <div class="text-center mt-4">
                            <button id="load-more-btn" class="btn btn-outline-primary rounded-pill px-5 py-3 fw-bold shadow-sm transition-all hover:bg-primary hover:text-white" data-page="2">
                                MUAT LEBIH BANYAK
                            </button>
                            <div id="load-more-spinner" class="d-none mt-3">
                                <div class="spinner-border text-primary border-2" role="status"></div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Section: Category Blocks -->
                <div class="row g-4 mb-5">
                    @foreach($categories as $catName => $catNews)
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 bg-white">
                                <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <h5 class="fw-bold mb-0 text-slate-900 font-playfair">{{ $catName }}</h5>
                                        <div class="h-1 bg-primary rounded-pill" style="width: 40px; height: 3px;"></div>
                                    </div>
                                </div>
                                <div class="card-body p-4 pt-2">
                                    @foreach($catNews as $cn)
                                        <div class="mb-4 d-flex gap-3 align-items-start group">
                                            <div class="flex-shrink-0" style="width: 90px;">
                                                <img src="{{ Storage::url($cn->image) }}" class="rounded-3 shadow-sm w-100 object-fit-cover" style="aspect-ratio: 4/3;" alt="">
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="fw-bold mb-1" style="line-height: 1.4;">
                                                    <a href="{{ route('news.show', $cn->slug) }}" class="text-slate-800 text-decoration-none small hover:text-primary transition-colors">{{ Str::limit($cn->title, 55) }}</a>
                                                </h6>
                                                <span class="text-slate-400" style="font-size: 0.7rem;">{{ $cn->created_at->translatedFormat('d M Y') }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="sticky-top" style="top: 110px;">
                    <!-- Ads Widget -->
                    @isset($ads['sidebar_square'])
                        <div class="mb-5">
                            <span class="ad-label border-bottom pb-1 mb-2 d-block text-center letter-spacing-1">SPONSORED</span>
                            <div class="shadow-sm rounded-4 overflow-hidden border">
                                <a href="{{ $ads['sidebar_square']->url_link }}" target="_blank">
                                    <img src="{{ Storage::url($ads['sidebar_square']->image_path) }}" class="img-fluid w-100" alt="Iklan">
                                </a>
                            </div>
                        </div>
                    @endisset

                    <!-- Popular News Widget -->
                    <div class="card border-0 shadow-sm rounded-4 mb-5 p-4 bg-white">
                        <h5 class="fw-bold mb-4 font-playfair border-start border-primary border-4 ps-3">Terpopuler</h5>
                        @foreach($all_news->take(5) as $index => $news)
                            <div class="d-flex align-items-start mb-4 gap-3 group">
                                <div class="fs-1 fw-black text-slate-100 font-playfair" style="line-height: 1; min-width: 45px;">0{{ $index + 1 }}</div>
                                <div>
                                    <h6 class="fw-bold mb-1" style="line-height: 1.4;">
                                        <a href="{{ route('news.show', $news->slug) }}" class="text-slate-800 text-decoration-none small hover:text-primary transition-colors">{{ Str::limit($news->title, 65) }}</a>
                                    </h6>
                                    <span class="text-slate-400 small" style="font-size: 0.75rem;">{{ $news->created_at->translatedFormat('d M Y') }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Newsletter Widget -->
                    <div class="card border-0 mb-5 shadow-lg rounded-4 text-white p-4" style="background: linear-gradient(135deg, #1e293b, #4f46e5);">
                        <div class="mb-3">
                            <svg width="40" height="40" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"></path></svg>
                        </div>
                        <h5 class="fw-bold mb-1">Berlangganan</h5>
                        <p class="small mb-4 opacity-80">Dapatkan kurasi berita terbaik setiap pagi di inbox Anda.</p>
                        <form class="d-flex flex-column gap-2">
                            <input type="email" class="form-control bg-white border-0 shadow-none px-3 py-2 rounded-3" placeholder="Alamat Email">
                            <button type="submit" class="btn btn-dark w-100 py-2 fw-bold tracking-wider rounded-3">SUBSCRIBE</button>
                        </form>
                    </div>

                    <!-- Trending Section -->
                    <div class="card border-0 mb-5 shadow-sm rounded-4 p-4 bg-white">
                        <div class="d-flex align-items-center mb-3">
                            <svg class="text-rose-500 me-2" width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z"></path><path d="M5 5a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4a1 1 0 10-2 0v4H5V7h4a1 1 0 000-2H5z"></path></svg>
                            <h6 class="fw-bold m-0 text-slate-900 font-playfair">Sedang Tren</h6>
                        </div>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach($trending_keywords as $keyword)
                                <a href="#" class="btn btn-sm btn-slate-50 border border-slate-200 rounded-pill px-3 py-1 fw-semibold text-slate-600 hover:bg-slate-100 transition-colors" style="font-size: 0.75rem;">
                                    #{{ $keyword }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loadMoreBtn = document.getElementById('load-more-btn');
            const container = document.getElementById('latest-news-container');
            const spinner = document.getElementById('load-more-spinner');

            if (loadMoreBtn) {
                loadMoreBtn.addEventListener('click', function() {
                    const page = loadMoreBtn.getAttribute('data-page');
                    const skip = (page - 1) * 10;

                    loadMoreBtn.classList.add('d-none');
                    spinner.classList.remove('d-none');

                    fetch(`/load-more?skip=${skip}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.html) {
                                container.insertAdjacentHTML('beforeend', data.html);
                                loadMoreBtn.setAttribute('data-page', parseInt(page) + 1);
                                loadMoreBtn.classList.remove('d-none');
                                
                                // Sync bookmarks for new cards
                                if (window.updateBookmarkUI) window.updateBookmarkUI();
                                if (window.applyDataSaver) window.applyDataSaver();
                            }

                            if (!data.hasMore) {
                                loadMoreBtn.remove();
                            }
                        })
                        .catch(error => console.error('Error:', error))
                        .finally(() => {
                            spinner.classList.add('d-none');
                        });
                });
            }
        });
    </script>

    <style>
        .news-item { animation: fadeIn 0.5s ease both; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        .hover-indigo:hover { color: var(--primary-indigo) !important; }
        .card-news:hover img { transform: scale(1.05); }
        .hero-focus:hover img { transform: scale(1.02); }
        .hero-focus img, .card-news img { transition: transform 0.8s ease; }
    </style>
@endsection
