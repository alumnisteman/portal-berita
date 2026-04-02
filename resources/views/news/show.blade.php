@extends('layouts.portal')

@section('title', $berita->title)

@section('content')
    <article class="py-5 mb-5 overflow-hidden">
        <div class="container py-lg-5">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                        <div class="text-center mb-5 pb-3 position-relative">
                            <span class="category-pill border-0 shadow-sm" style="background: rgba(99, 102, 241, 0.1); color: var(--primary-indigo); font-weight: 700;">NEWS PORTAL</span>
                            <h1 class="display-4 fw-bold mt-3 mb-4 font-playfair" style="line-height: 1.2; font-size: 3.5rem;">{{ $berita->title }}</h1>
                            
                            <!-- Bookmark Button -->
                            <button class="btn btn-outline-primary rounded-pill px-4 py-2 border-2 shadow-sm mb-4 bookmark-btn" 
                                    onclick="toggleBookmark({{ $berita->id }}, '{{ $berita->title }}', '{{ url()->current() }}', '{{ $berita->image ? Storage::url($berita->image) : '' }}')"
                                    data-id="{{ $berita->id }}">
                                <svg class="w-5 h-5 me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 20px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path></svg>
                                <span>Simpan Berita</span>
                            </button>

                            <div class="d-flex align-items-center justify-content-center gap-4 text-muted small fw-semibold">
                                <div class="d-flex align-items-center">
                                    <div class="bg-indigo text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px; background-color: var(--primary-indigo); font-size: 0.7rem;">
                                        {{ strtoupper(substr($berita->user->name, 0, 1)) }}
                                    </div>
                                    <span>Oleh {{ $berita->user->name }}</span>
                                </div>
                                <span class="text-secondary opacity-50">•</span>
                                <span>{{ $berita->created_at->format('d M Y, H:i') }} WIB</span>
                            </div>
                        </div>

                        @if($berita->image)
                            <div class="mb-5 pb-2 text-center rounded-5 overflow-hidden shadow-lg position-relative shadow-indigo-10">
                                <img src="{{ Storage::url($berita->image) }}" class="img-fluid w-100 transition-all hover-scale" alt="{{ $berita->title }}" style="aspect-ratio: 16/9; object-fit: cover;">
                            </div>
                        @endif

                        <!-- AI Summary Section -->
                        <div class="mb-5 p-4 rounded-4 border-start border-primary border-5 shadow-sm bg-indigo-soft">
                            <div class="d-flex align-items-center mb-2 gap-2">
                                <div class="ai-pulse me-2"></div>
                                <h6 class="fw-bold m-0 text-primary uppercase small" style="letter-spacing: 0.1em;">AI Summary (BETA)</h6>
                            </div>
                            <p class="text-secondary mb-0 ital" style="font-size: 0.95rem;">
                                {{ $berita->summary ?? 'AI sedang merangkum berita ini untuk Anda... Secara singkat, berita ini membahas tentang ' . Str::limit($berita->title, 100) . '.' }}
                            </p>
                        </div>

                        <div class="row">
                            <div class="col-lg-8 f-reading">
                                <div class="berita-content fs-5 text-secondary pe-lg-5 leading-relaxed mb-5" style="line-height: 1.8; color: #334155 !important;">
                                    @php
                                        $paragraphs = explode("\n\n", $berita->content);
                                        $adInserted = false;
                                    @endphp

                                    @foreach($paragraphs as $index => $paragraph)
                                        <p>{!! nl2br(e($paragraph)) !!}</p>
                                        
                                        @if($index == 1 && isset($ads['article_interruption']))
                                            <div class="ad-article-interruption my-5 p-3 bg-light rounded-3 border text-center">
                                                <span class="ad-label">Advertisement</span>
                                                <a href="{{ $ads['article_interruption']->url_link }}" target="_blank">
                                                    <img src="{{ Storage::url($ads['article_interruption']->image_path) }}" class="img-fluid rounded" alt="Ad">
                                                </a>
                                            </div>
                                            @php $adInserted = true; @endphp
                                        @endif
                                    @endforeach
                                </div>

                                <div class="p-5 rounded-5 border-0 shadow-sm mb-5 position-relative" style="background: #f8fafc; border: 1px solid rgba(0,0,0,0.03) !important;">
                                    <div class="position-absolute top-0 start-50 translate-middle">
                                        <span class="badge bg-white text-dark shadow-sm px-4 py-2 rounded-pill font-playfair" style="font-size: 1rem;">Bagikan Cerita Ini</span>
                                    </div>
                                    <div class="d-flex justify-content-center gap-4 pt-3 flex-wrap text-center">
                                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank" class="btn btn-primary rounded-pill px-4 py-2 border-0 shadow-sm" style="background-color: #1877F2">Facebook</a>
                                        <a href="https://twitter.com/intent/tweet?text={{ urlencode($berita->title) }}&url={{ url()->current() }}" target="_blank" class="btn btn-dark rounded-pill px-4 py-2 border-0 shadow-sm" style="background-color: #000000">X / Twitter</a>
                                        <a href="https://api.whatsapp.com/send?text={{ urlencode($berita->title . ' - ' . url()->current()) }}" target="_blank" class="btn btn-success rounded-pill px-4 py-2 border-0 shadow-sm" style="background-color: #25D366">WhatsApp</a>
                                        <button onclick="navigator.clipboard.writeText('{{ url()->current() }}'); alert('Link disalin!')" class="btn btn-light rounded-pill px-4 py-2 border-0 shadow-sm">Copy Link</button>
                                    </div>
                                </div>

                                <!-- Disqus Comments -->
                                <div id="disqus_thread" class="mt-5 pt-4 border-top"></div>
                                <script>
                                    var disqus_config = function () {
                                        this.page.url = "{{ urlcurrent() }}";
                                        this.page.identifier = "{{ $berita->slug }}";
                                    };
                                    (function() {
                                        var d = document, s = d.createElement('script');
                                        s.src = 'https://info-portal-php.disqus.com/embed.js';
                                        s.setAttribute('data-timestamp', +new Date());
                                        (d.head || d.body).appendChild(s);
                                    })();
                                </script>
                            </div>

                        <!-- Mini Sidebar inside article -->
                        <div class="col-lg-4">
                            <div class="sticky-top" style="top: 120px;">
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

                                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                                    <h6 class="fw-bold mb-4">Terpopuler</h6>
                                    @foreach($related_news as $index => $news)
                                        <div class="d-flex align-items-center mb-3 gap-2">
                                            <div class="fw-bold text-muted opacity-50">0{{ $index + 1 }}</div>
                                            <h6 class="small fw-bold mb-0">
                                                <a href="{{ route('news.show', $news->slug) }}" class="text-dark text-decoration-none">{{ Str::limit($news->title, 50) }}</a>
                                            </h6>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Trending Keywords -->
                                <div class="card border-0 shadow-sm rounded-4 p-4">
                                    <h6 class="fw-bold mb-3 d-flex align-items-center">
                                        <svg class="text-danger me-2" width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z"></path><path d="M5 5a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4a1 1 0 10-2 0v4H5V7h4a1 1 0 000-2H5z"></path></svg>
                                        Trending
                                    </h6>
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
            </div>

            <div class="mt-5 pt-lg-5">
                <div class="d-flex align-items-center mb-5">
                    <h3 class="fw-bold m-0 border-start border-primary border-5 ps-3" style="font-size: 1.8rem; color: var(--primary-dark);">Baca Juga</h3>
                </div>
                <div class="row g-4 justify-content-center">
                    @foreach($related_news as $related)
                        <div class="col-lg-4 col-md-6">
                            <div class="card-news h-100 flex-column d-flex border-0 shadow-sm bg-white" style="border-radius: 1.5rem;">
                                @if($related->image)
                                    <img src="{{ Storage::url($related->image) }}" class="card-img-top w-100" style="aspect-ratio: 16/9; object-fit: cover;" alt="{{ $related->title }}">
                                @endif
                                <div class="card-body p-4 d-flex flex-column">
                                    <h5 class="card-title fw-bold">
                                        <a href="{{ route('news.show', $related->slug) }}" class="text-dark text-decoration-none" style="line-height: 1.4;">
                                            {{ Str::limit($related->title, 60) }}
                                        </a>
                                    </h5>
                                    <p class="card-text text-secondary small mt-auto opacity-75 fw-semibold">{{ $related->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </article>
@endsection
