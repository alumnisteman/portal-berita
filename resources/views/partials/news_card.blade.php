<div class="mb-5 pb-5 border-bottom news-item group">
    <div class="row g-4 align-items-start">
        <div class="col-md-5 col-lg-4">
            <div class="position-relative overflow-hidden rounded-4 shadow-sm aspect-video">
                <img src="{{ $news->image ? Storage::url($news->image) : 'https://via.placeholder.com/600x338' }}" 
                     class="img-fluid w-100 h-100 object-fit-cover transition-all duration-500 group-hover:scale-110" 
                     alt="{{ $news->title }}"
                     loading="lazy">
                
                <!-- Category Tag -->
                <div class="position-absolute top-0 start-0 m-3">
                    <span class="badge bg-white text-primary rounded-pill shadow-sm py-2 px-3 fw-bold small opacity-90">NEWS</span>
                </div>

                <!-- Bookmark Action -->
                <button class="btn btn-white position-absolute top-0 end-0 m-3 rounded-circle shadow-sm bookmark-btn d-flex align-items-center justify-content-center p-2" 
                        onclick="toggleBookmark({{ $news->id }}, '{{ addslashes($news->title) }}', '{{ route('news.show', $news->slug) }}', '{{ $news->image ? Storage::url($news->image) : '' }}')"
                        data-id="{{ $news->id }}" 
                        style="width: 38px; height: 38px; z-index: 10; border: none; background: rgba(255,255,255,0.9);">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path></svg>
                </button>
            </div>
        </div>
        <div class="col-md-7 col-lg-8">
            <div class="d-flex align-items-center gap-2 mb-2 text-slate-500 small">
                <span class="fw-bold text-primary text-uppercase letter-spacing-1" style="font-size: 0.75rem;">{{ $news->user->name }}</span>
                <span class="opacity-50">•</span>
                <span>{{ $news->created_at->translatedFormat('d M Y, H:i') }} WIB</span>
            </div>
            <h3 class="fw-bold mb-3 tracking-tight font-playfair" style="line-height: 1.25;">
                <a href="{{ route('news.show', $news->slug) }}" class="text-slate-900 text-decoration-none hover:text-indigo-600 transition-colors">
                    {{ $news->title }}
                </a>
            </h3>
            <p class="text-slate-600 mb-0 opacity-80" style="font-size: 1rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                {{ Str::limit(strip_tags($news->content), 180) }}
            </p>
        </div>
    </div>
</div>
