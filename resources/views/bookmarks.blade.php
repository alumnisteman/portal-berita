@extends('layouts.portal')

@section('title', 'Berita Tersimpan')

@section('content')
<div id="bookmarks-root" class="py-5">
    <div class="row justify-content-center mb-5">
        <div class="col-lg-8 text-center">
            <h1 class="display-4 fw-bold font-playfair mb-3">Koleksi Berita Anda</h1>
            <p class="lead text-muted opacity-75">Baca kembali berita favorit dan simpanan penting Anda.</p>
            <div class="d-flex justify-content-center mt-4">
                <button onclick="clearAllBookmarks()" class="btn btn-link text-danger text-decoration-none small fw-bold d-none" id="clear-all-btn">
                     HAPUS SEMUA KOLEKSI
                </button>
            </div>
        </div>
    </div>

    <div id="bookmarks-container" class="row g-4 row-cols-1 row-cols-md-2 row-cols-xl-3">
        <!-- JS Injection -->
    </div>

    <div id="no-bookmarks" class="text-center py-5 d-none">
        <div class="mb-4 opacity-50">
            <svg width="120" height="120" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path></svg>
        </div>
        <h3 class="fw-bold">Masih Kosong</h3>
        <p class="text-muted max-w-lg mx-auto">Anda belum menyimpan berita apa pun. Jelajahi kanal kami dan simpan berita untuk dibaca nanti.</p>
        <a href="/" class="btn btn-modern px-5 py-3 mt-3">Mulai Menjelajah</a>
    </div>
</div>

<script>
    function renderBookmarks() {
        const container = document.getElementById('bookmarks-container');
        const noBookmarks = document.getElementById('no-bookmarks');
        const clearBtn = document.getElementById('clear-all-btn');
        const bookmarks = JSON.parse(localStorage.getItem('bookmarks') || '[]');

        container.innerHTML = '';
        
        if (bookmarks.length === 0) {
            noBookmarks.classList.remove('d-none');
            clearBtn.classList.add('d-none');
            return;
        }

        noBookmarks.classList.add('d-none');
        clearBtn.classList.remove('d-none');

        bookmarks.forEach(news => {
            const card = `
                <div class="col" id="bm-card-${news.id}">
                    <article class="card-news h-100 shadow-sm border-0 bg-white">
                        <div class="position-relative overflow-hidden">
                            <img src="${news.image || 'https://via.placeholder.com/400x250'}" class="w-100 transition-all hover-scale" style="aspect-ratio: 16/9; object-fit: cover;" alt="">
                            <button class="btn btn-danger position-absolute top-0 end-0 m-3 rounded-circle shadow p-2 d-flex align-items-center" 
                                    onclick="removeBookmark(${news.id})" title="Hapus">
                                <svg width="16" height="16" fill="white" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </button>
                        </div>
                        <div class="card-body p-4 d-flex flex-column">
                            <h5 class="fw-bold mb-3 font-outfit" style="line-height: 1.4;">
                                <a href="${news.url}" class="text-dark text-decoration-none hover-indigo">${news.title}</a>
                            </h5>
                            <div class="mt-auto pt-3 border-top d-flex justify-content-between align-items-center">
                                <span class="small text-muted fw-semibold">Tersimpan</span>
                                <span class="small text-muted opacity-75">${new Date(news.savedAt).toLocaleDateString('id-ID', {day:'numeric', month:'short'})}</span>
                            </div>
                        </div>
                    </article>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', card);
        });

        if(window.applyDataSaver) window.applyDataSaver();
    }

    window.removeBookmark = function(id) {
        let bookmarks = JSON.parse(localStorage.getItem('bookmarks') || '[]');
        bookmarks = bookmarks.filter(b => b.id !== id);
        localStorage.setItem('bookmarks', JSON.stringify(bookmarks));
        renderBookmarks();
        if(window.updateBookmarkUI) window.updateBookmarkUI();
    };

    window.clearAllBookmarks = function() {
        if(confirm('Hapus semua berita yang tersimpan?')) {
            localStorage.setItem('bookmarks', '[]');
            renderBookmarks();
            if(window.updateBookmarkUI) window.updateBookmarkUI();
        }
    };

    document.addEventListener('DOMContentLoaded', renderBookmarks);
</script>
@endsection
