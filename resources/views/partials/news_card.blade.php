<div class="mb-4 pb-4 border-bottom position-relative news-item">
    <div class="row g-4 align-items-center">
        <div class="col-md-4">
            <div class="position-relative overflow-hidden rounded-3 shadow-sm">
                <img src="{{ $news->image ? Storage::url($news->image) : 'https://via.placeholder.com/400x250' }}" class="img-fluid w-100" style="aspect-ratio: 16/9; object-fit: cover;" alt="{{ $news->title }}">
                <!-- Bookmark Button -->
                <button class="btn btn-sm btn-light position-absolute top-0 end-0 m-2 rounded-circle shadow-sm bookmark-btn" 
                        onclick="toggleBookmark({{ $news->id }}, '{{ addslashes($news->title) }}', '{{ route('news.show', $news->slug) }}', '{{ $news->image ? Storage::url($news->image) : '' }}')"
                        data-id="{{ $news->id }}" style="z-index: 5; opacity: 0.8;">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 16px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path></svg>
                </button>
            </div>
        </div>
        <div class="col-md-8">
            <div class="mb-2">
                <span class="text-primary small fw-bold text-uppercase">Terbaru</span>
                <span class="text-muted small ms-2">• {{ $news->created_at->format('H:i') }} WIB</span>
            </div>
            <h4 class="fw-bold">
                <a href="{{ route('news.show', $news->slug) }}" class="text-dark text-decoration-none hover-indigo">
                    {{ $news->title }}
                </a>
            </h4>
            <p class="text-secondary small">{{ Str::limit(strip_tags($news->content), 120) }}</p>
        </div>
    </div>
</div>
