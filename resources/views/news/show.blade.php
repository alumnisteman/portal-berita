@extends('layouts.portal')

@section('title', $berita->title)
@section('meta_description', Str::limit(strip_tags($berita->content), 150))
@section('og_type', 'article')
@section('og_image', $berita->image ? Storage::url($berita->image) : asset('favicon.ico'))

@push('head')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "NewsArticle",
  "headline": "{{ $berita->title }}",
  "image": [
    "{{ $berita->image ? Storage::url($berita->image) : asset('favicon.ico') }}"
  ],
  "datePublished": "{{ $berita->created_at->toIso8601String() }}",
  "dateModified": "{{ $berita->updated_at->toIso8601String() }}",
  "author": [{
      "@type": "Person",
      "name": "{{ $berita->user?->name ?? 'Admin' }}",
      "url": "{{ url('/') }}"
    }]
}
</script>
@endpush

@section('content')
    <article class="py-5 mb-5 bg-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <!-- Article Header -->
                    <div class="text-center mb-5 pb-3">
                        <nav aria-label="breadcrumb" class="mb-4 d-flex justify-content-center">
                            <ol class="breadcrumb mb-0 px-3 py-2 bg-slate-50 rounded-pill small fw-bold">
                                <li class="breadcrumb-item"><a href="/" class="text-decoration-none text-slate-400">Home</a></li>
                                <li class="breadcrumb-item active text-primary" aria-current="page">Berita</li>
                            </ol>
                        </nav>
                        
                        <h1 class="display-3 fw-black mb-4 font-playfair tracking-tight text-slate-900" style="line-height: 1.1;">{{ $berita->title }}</h1>
                        
                        <div class="d-flex align-items-center justify-content-center flex-wrap gap-4 text-slate-500 mb-4">
                            <div class="d-flex align-items-center">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($berita->user?->name ?? 'Admin') }}&background=4f46e5&color=fff" class="rounded-circle me-2 shadow-sm" width="32" height="32" alt="">
                                @if($berita->category)
                                    <span class="badge bg-indigo-soft text-primary border-0 px-3 py-2 rounded-pill fw-bold text-uppercase me-3" style="font-size: 0.75rem; letter-spacing: 1px;">
                                        {{ $berita->category->name }}
                                    </span>
                                @endif
                                <span class="fw-bold text-slate-900">{{ $berita->user?->name ?? 'Admin' }}</span>
                            </div>
                            <span class="opacity-30 d-none d-md-inline">•</span>
                            <div class="d-flex align-items-center">
                                <svg class="me-2 text-slate-400" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <span>{{ $berita->created_at?->translatedFormat('d F Y, H:i') ?? '-' }} WIB</span>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="d-flex justify-content-center gap-2">
                            <button class="btn btn-slate-100 rounded-pill px-4 py-2 fw-bold text-slate-700 shadow-sm transition-all hover:bg-slate-200 border-0 bookmark-btn" 
                                    onclick="toggleBookmark({{ $berita->id }}, '{{ addslashes($berita->title) }}', '{{ url()->current() }}', '{{ $berita->image ? Storage::url($berita->image) : '' }}')"
                                    data-id="{{ $berita->id }}">
                                <svg class="me-2" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path></svg>
                                <span>Simpan</span>
                            </button>
                        </div>
                    </div>

                    @if($berita->image)
                        <div class="mb-5 rounded-5 overflow-hidden shadow-2xl border-0">
                            <img src="{{ Storage::url($berita->image) }}" class="w-100 img-fluid object-fit-cover" 
                                 alt="{{ $berita->title }}" style="aspect-ratio: 16/9; max-height: 600px;" fetchpriority="high" loading="lazy">
                        </div>
                    @endif

                    <!-- Top Ad Slot -->
                    @if(config('services.google.adsense_id'))
                    <div class="ad-slot-horizontal my-4 text-center">
                        <ins class="adsbygoogle"
                             style="display:block"
                             data-ad-client="{{ config('services.google.adsense_id') }}"
                             data-ad-slot="top_article"
                             data-ad-format="auto"
                             data-full-width-responsive="true"></ins>
                        <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
                    </div>
                    @endif

                    <div class="row g-5">
                        <div class="col-lg-8">
                            <!-- Premium AI Summary -->
                            <div class="mb-5 p-4 rounded-4 border-0 shadow-sm position-relative overflow-hidden" 
                                 style="background: linear-gradient(135deg, #f8faff 0%, #eff6ff 100%); border: 1px solid #dbeafe !important;">
                                <div class="d-flex align-items-center mb-3 gap-2">
                                    <div class="ai-sparkle">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" class="text-primary"><path d="M9.81 12L11 12M13 12L14.19 12M12 9.81L12 11M12 13L12 14.19M17.66 17.66L16.24 16.24M17.66 6.34L16.24 7.76M6.34 17.66L7.76 16.24M6.34 6.34L7.76 7.76" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><circle cx="12" cy="12" r="5" stroke="currentColor" stroke-width="2"/></svg>
                                    </div>
                                    <h6 class="fw-black m-0 text-primary small text-uppercase tracking-widest">Ringkasan AI (Beta)</h6>
                                </div>
                                <p class="text-slate-700 mb-0 fst-italic lh-base" style="font-size: 1.05rem;">
                                    {{ $berita->summary ?? 'AI sedang merangkum esensi berita ini khusus untuk Anda...' }}
                                </p>
                            </div>

                            <!-- Main Content Body -->
                            <div class="berita-content text-slate-800 leading-relaxed mb-5" style="font-size: 1.25rem; line-height: 1.85; font-family: 'Inter', sans-serif;">
                                @php
                                    $paragraphs = explode("\n\n", $berita->linked_content ?? $berita->content);
                                @endphp

                                @foreach($paragraphs as $index => $paragraph)
                                    <p class="mb-4">{!! nl2br(e($paragraph)) !!}</p>
                                    
                                    @if($index == 1 && config('services.google.adsense_id'))
                                        <div class="ad-slot-in-article my-5 text-center">
                                            <ins class="adsbygoogle"
                                                 style="display:block; text-align:center;"
                                                 data-ad-layout="in-article"
                                                 data-ad-format="fluid"
                                                 data-ad-client="{{ config('services.google.adsense_id') }}"
                                                 data-ad-slot="mid_article"></ins>
                                            <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
                                        </div>
                                    @endif

                                    @if($index == 1 && isset($ads['article_interruption']))
                                        <div class="ad-in-article my-5 p-4 rounded-4 border bg-slate-50 text-center shadow-sm">
                                            <span class="ad-label border-bottom pb-1 mb-3 d-inline-block text-slate-400 small letter-spacing-1">SPONSORED CONTENT</span>
                                            <a href="{{ $ads['article_interruption']->url_link }}" target="_blank" class="d-block overflow-hidden rounded-3">
                                                <img src="{{ Storage::url($ads['article_interruption']->image_path) }}" class="img-fluid transition-transform hover:scale-105" alt="Iklan" loading="lazy">
                                            </a>
                                        </div>
                                    @endif
                                @endforeach
                                
                                <!-- Bottom Ad Slot -->
                                @if(config('services.google.adsense_id'))
                                <div class="ad-slot-horizontal mt-5 text-center">
                                    <ins class="adsbygoogle"
                                         style="display:block"
                                         data-ad-client="{{ config('services.google.adsense_id') }}"
                                         data-ad-slot="bottom_article"
                                         data-ad-format="auto"
                                         data-full-width-responsive="true"></ins>
                                    <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
                                </div>
                                @endif
                            </div>

                            <!-- Share Section -->
                            <div class="p-4 p-md-5 rounded-5 border-0 shadow-sm mb-5 bg-slate-50 text-center">
                                <h6 class="fw-bold mb-4 text-slate-900 font-playfair fs-4">Sukai artikel ini? Bagikan!</h6>
                                <div class="d-flex justify-content-center gap-2 flex-wrap">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank" class="btn btn-primary rounded-pill px-4 py-2 border-0 shadow-sm" style="background-color: #1877F2">Facebook</a>
                                    <a href="https://twitter.com/intent/tweet?text={{ urlencode($berita->title) }}&url={{ url()->current() }}" target="_blank" class="btn btn-dark rounded-pill px-4 py-2 border-0 shadow-sm" style="background-color: #000000">𝕏</a>
                                    <a href="https://api.whatsapp.com/send?text={{ urlencode($berita->title . ' - ' . url()->current()) }}" target="_blank" class="btn btn-success rounded-pill px-4 py-2 border-0 shadow-sm" style="background-color: #25D366">WhatsApp</a>
                                    <button onclick="navigator.clipboard.writeText('{{ url()->current() }}'); alert('Tautan disalin!')" class="btn btn-white rounded-pill px-4 py-2 border shadow-sm">Salin Link</button>
                                </div>
                            </div>

                            <!-- Disqus -->
                            <div id="disqus_thread" class="mt-5 pt-5 border-top border-slate-200"></div>
                        </div>

                        <!-- Sidebar -->
                        <div class="col-lg-4">
                            <div class="sticky-top" style="top: 120px;">
                                <!-- Top Headlines Mini Widget -->
                                <div class="card border-0 shadow-sm rounded-4 p-4 mb-5 bg-white">
                                    <h5 class="fw-bold mb-4 font-playfair border-start border-primary border-4 ps-3">Terpopuler</h5>
                                    @foreach($related_news->take(5) as $index => $news)
                                        <div class="d-flex align-items-start mb-4 gap-3 group">
                                            <div class="fs-4 fw-black text-slate-200 font-playfair" style="line-height: 1;">{{ $index + 1 }}</div>
                                            <h6 class="small fw-bold mb-0 lh-base">
                                                <a href="{{ route('news.show', $news->slug) }}" class="text-slate-800 text-decoration-none hover:text-primary transition-colors">{{ Str::limit($news->title, 70) }}</a>
                                            </h6>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Related Tags/Keywords -->
                                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white mb-5">
                                    <h6 class="fw-bold mb-3 d-flex align-items-center font-playfair">
                                        <svg class="text-rose-500 me-2" width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z"></path><path d="M5 5a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4a1 1 0 10-2 0v4H5V7h4a1 1 0 000-2H5z"></path></svg>
                                        Topik Terkait
                                    </h6>
                                    <div class="d-flex flex-wrap gap-2">
                                        @foreach($trending_keywords as $keyword)
                                            <a href="#" class="btn btn-sm btn-slate-50 border border-slate-200 rounded-pill px-3 py-1 fw-semibold text-slate-600 hover:bg-slate-100 transition-colors" style="font-size: 0.75rem;">
                                                #{{ $keyword }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>

                                @isset($ads['sidebar_square'])
                                    <div class="text-center rounded-4 overflow-hidden border shadow-sm">
                                        <span class="ad-label d-block bg-slate-50 border-bottom py-1 small text-slate-400">IKLAN</span>
                                        <a href="{{ $ads['sidebar_square']->url_link }}" target="_blank">
                                            <img src="{{ Storage::url($ads['sidebar_square']->image_path) }}" class="img-fluid w-100" alt="" loading="lazy">
                                        </a>
                                    </div>
                                @endisset
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- "Baca Juga" Section -->
            <div class="mt-5 pt-lg-5">
                <div class="d-flex align-items-center justify-content-between mb-5 border-bottom pb-4">
                    <h3 class="fw-bold m-0 font-playfair display-6">Baca Juga</h3>
                    <a href="/" class="text-primary fw-bold text-decoration-none">EXPLORE MORE →</a>
                </div>
                <div class="row g-4">
                    @foreach($related_news as $related)
                        <div class="col-lg-4 col-md-6">
                            <div class="card border-0 shadow-sm rounded-5 overflow-hidden h-100 bg-white group hover:shadow-xl transition-all">
                                @if($related->image)
                                    <div class="overflow-hidden aspect-video">
                                        <img src="{{ Storage::url($related->image) }}" class="card-img-top w-100 h-100 object-fit-cover transition-transform group-hover:scale-110" alt="{{ $related->title }}" loading="lazy">
                                    </div>
                                @endif
                                <div class="card-body p-4">
                                    <h5 class="card-title fw-bold mb-3 font-playfair lh-base">
                                        <a href="{{ route('news.show', $related->slug) }}" class="text-slate-900 text-decoration-none hover:text-primary transition-colors">
                                            {{ Str::limit($related->title, 75) }}
                                        </a>
                                    </h5>
                                    <div class="d-flex align-items-center gap-2 text-slate-400 small fw-medium mt-auto">
                                        <span>{{ $related->created_at->translatedFormat('d M Y') }}</span>
                                        <span class="opacity-30">•</span>
                                        <span>5 Min Read</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </article>

    <script>
        var disqus_config = function () {
            this.page.url = "{{ url()->current() }}";
            this.page.identifier = "{{ $berita->slug }}";
        };
        (function() {
            var d = document, s = d.createElement('script');
            s.src = 'https://info-portal-php.disqus.com/embed.js';
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
        })();
    </script>
@endsection
