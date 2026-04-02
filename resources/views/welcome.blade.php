@extends('layouts.portal')

@section('title', 'Pusat Berita Indonesia')

@section('content')
    <div class="container mt-4">
        <!-- Hero Grid Section -->
        <div class="row g-3 mb-5">
            <!-- Large Focus (Left) -->
            <div class="col-lg-7">
                @if($latest_news->count() > 0)
                    @php $hero = $latest_news[0]; @endphp
                    <div class="hero-focus position-relative rounded-4 overflow-hidden h-100 shadow-sm">
                        <img src="{{ $hero->image ? Storage::url($hero->image) : 'https://images.unsplash.com/photo-1585829365234-7541b71239aa?q=80&w=2070&auto=format&fit=crop' }}" class="w-100 h-100 object-fit-cover" alt="{{ $hero->title }}" style="min-height: 500px;">
                        <div class="position-absolute bottom-0 start-0 w-100 p-4 pt-5" style="background: linear-gradient(to top, rgba(0,0,0,0.9) 0%, transparent 100%);">
                            <span class="badge bg-danger mb-2">HEADLINE</span>
                            <h2 class="text-white fw-bold display-6 mb-2">
                                <a href="{{ route('news.show', $hero->slug) }}" class="text-white text-decoration-none hover-indigo">{{ $hero->title }}</a>
                            </h2>
                            <p class="text-white-50 mb-0 d-none d-md-block">{{ Str::limit(strip_tags($hero->content), 150) }}</p>
                            <div class="text-white-50 small mt-3">{{ $hero->created_at->diffForHumans() }}</div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Small Items (Right) -->
            <div class="col-lg-5">
                <div class="row g-3 h-100">
                    @foreach($latest_news->skip(1)->take(4) as $news)
                        <div class="col-md-6 h-50">
                            <div class="position-relative rounded-3 overflow-hidden h-100 shadow-sm card-news">
                                <img src="{{ $news->image ? Storage::url($news->image) : 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?q=80&w=2070&auto=format&fit=crop' }}" class="w-100 h-100 object-fit-cover" alt="{{ $news->title }}" style="min-height: 242px;">
                                <div class="position-absolute bottom-0 start-0 w-100 p-3" style="background: linear-gradient(to top, rgba(0,0,0,0.85) 0%, transparent 100%);">
                                    <h6 class="text-white fw-bold mb-1">
                                        <a href="{{ route('news.show', $news->slug) }}" class="text-white text-decoration-none small">{{ Str::limit($news->title, 60) }}</a>
                                    </h6>
                                    <div class="text-white-50" style="font-size: 0.7rem;">{{ $news->created_at->diffForHumans() }}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="row g-5">
            <!-- News Feed -->
            <div class="col-lg-8">
                <h4 class="fw-bold mb-4 border-bottom pb-2 border-primary border-3 d-inline-block">Berita Terbaru</h4>
                
                <div class="mb-5">
                    <div id="latest-news-container">
                        @forelse ($all_news as $news)
                            @include('partials.news_card', ['news' => $news])
                        @empty
                            <div class="text-center py-5">
                                <p class="text-muted">Belum ada berita.</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Load More Button -->
                    @if($all_news->hasMorePages())
                        <div class="text-center mt-5">
                            <button id="load-more-btn" class="btn btn-outline-primary rounded-pill px-5 py-3 fw-bold shadow-sm" data-page="2">
                                MUAT LEBIH BANYAK
                            </button>
                            <div id="load-more-spinner" class="d-none mt-3">
                                <div class="spinner-border text-primary" role="status"></div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Category Blocks -->
                <div class="row g-4 mb-5">
                    @foreach($categories as $catName => $catNews)
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                                <div class="card-header bg-white border-0 pt-4 px-4">
                                    <h5 class="fw-bold mb-0 text-uppercase" style="color: var(--primary-indigo)">{{ $catName }}</h5>
                                </div>
                                <div class="card-body p-4">
                                    @foreach($catNews as $cn)
                                        <div class="mb-3 d-flex gap-3">
                                            <div class="flex-shrink-0" style="width: 100px;">
                                                <img src="{{ Storage::url($cn->image) }}" class="rounded-3 shadow-sm w-100" style="aspect-ratio: 16/9; object-fit: cover;" alt="">
                                            </div>
                                            <div>
                                                <h6 class="fw-bold mb-0">
                                                    <a href="{{ route('news.show', $cn->slug) }}" class="text-dark text-decoration-none small">{{ Str::limit($cn->title, 50) }}</a>
                                                </h6>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{ $all_news->links('pagination::bootstrap-5') }}
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="sticky-top" style="top: 100px;">
                    <!-- Sidebar Ad -->
                    @isset($ads['sidebar_square'])
                        <div class="mb-5 text-center">
                            <span class="ad-label">Advertisement</span>
                            <div class="shadow-sm rounded overflow-hidden">
                                <a href="{{ $ads['sidebar_square']->url_link }}" target="_blank">
                                    <img src="{{ Storage::url($ads['sidebar_square']->image_path) }}" class="img-fluid w-100" alt="Ad">
                                </a>
                            </div>
                        </div>
                    @endisset

                    <div class="card border-0 shadow-sm rounded-4 mb-5 p-4">
                        <h5 class="fw-bold mb-4">Terpopuler</h5>
                        @foreach($all_news->take(5) as $index => $news)
                            <div class="d-flex align-items-center mb-4 gap-3 pb-3 {{ !$loop->last ? 'border-bottom' : '' }}">
                                <div class="display-5 fw-bold text-light" style="opacity: 0.5;">0{{ $index + 1 }}</div>
                                <div>
                                    <h6 class="fw-bold mb-1">
                                        <a href="{{ route('news.show', $news->slug) }}" class="text-dark text-decoration-none">{{ Str::limit($news->title, 60) }}</a>
                                    </h6>
                                    <span class="small text-muted">{{ $news->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="card border-0 mb-5 shadow-sm rounded-4 bg-indigo text-white p-4" style="background-color: var(--primary-indigo)">
                        <h5 class="fw-bold mb-3">Newsletter</h5>
                        <p class="small mb-4 opacity-75">Update berita terkini langsung ke email Anda.</p>
                        <form class="d-flex gap-2">
                            <input type="email" class="form-control border-0 shadow-none p-2" placeholder="Email Anda" style="background: rgba(255,255,255,0.2); color: #fff;">
                            <button type="submit" class="btn btn-dark px-3 py-2 border-0 shadow-none"><small>DAFTAR</small></button>
                        </form>
                    </div>

                    <!-- Data Saver Mode Card -->
                    <div class="card border-0 mb-5 shadow-sm rounded-4 p-4 bg-light">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <h6 class="fw-bold m-0 text-dark">Mode Hemat Kuota</h6>
                            <div id="data-saver-status" class="small text-muted">Non-aktif</div>
                        </div>
                        <p class="small text-muted mb-3">Mengaburkan gambar untuk menghemat data internet Anda.</p>
                        <button onclick="toggleDataSaver()" class="btn btn-outline-primary btn-sm w-100 rounded-pill">
                            Toggle Mode
                        </button>
                    </div>

                    <!-- Trending Keywords Card -->
                    <div class="card border-0 mb-5 shadow-sm rounded-4 p-4">
                        <div class="d-flex align-items-center mb-3">
                            <svg class="text-danger me-2" width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z"></path><path d="M5 5a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4a1 1 0 10-2 0v4H5V7h4a1 1 0 000-2H5z"></path></svg>
                            <h6 class="fw-bold m-0 text-dark">Trending Keywords</h6>
                        </div>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach($trending_keywords as $keyword)
                                <a href="#" class="btn btn-sm btn-light rounded-pill px-3 py-1 fw-semibold text-secondary" style="font-size: 0.75rem; border: 1px solid var(--border-color);">
                                    #{{ $keyword }}
                                </a>
                            @endforeach
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
