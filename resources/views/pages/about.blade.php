@extends('layouts.portal')

@section('title', 'Tentang Kami')
@section('meta_description', 'Tentang Info Portal - Portal berita terpercaya yang menyajikan informasi terkini dan akurat untuk masyarakat Indonesia.')

@section('content')
<div class="py-5 bg-white">
    <div class="container">

        <!-- Hero About -->
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center">
                <span class="badge bg-indigo-soft text-primary rounded-pill px-3 py-2 mb-3 fw-bold">Tentang Kami</span>
                <h1 class="display-4 fw-bold font-playfair mb-4">Informasi Terpercaya untuk <span style="color: var(--primary-indigo);">Generasi Cerdas</span></h1>
                <p class="lead text-slate-500 mb-5">Info Portal hadir sebagai sumber berita digital yang mengutamakan akurasi, kecepatan, dan keterbacaan. Kami percaya setiap orang berhak mendapatkan informasi yang jelas dan dapat dipercaya.</p>
            </div>
        </div>

        <!-- Stats -->
        <div class="row g-4 mb-5">
            <div class="col-md-3 col-6">
                <div class="p-4 bg-slate-50 rounded-4 text-center border border-slate-100">
                    <div class="display-5 fw-black font-playfair text-primary mb-1">100+</div>
                    <div class="text-slate-500 small fw-semibold">Artikel Diterbitkan</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="p-4 bg-slate-50 rounded-4 text-center border border-slate-100">
                    <div class="display-5 fw-black font-playfair text-primary mb-1">7</div>
                    <div class="text-slate-500 small fw-semibold">Kategori Berita</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="p-4 bg-slate-50 rounded-4 text-center border border-slate-100">
                    <div class="display-5 fw-black font-playfair text-primary mb-1">24/7</div>
                    <div class="text-slate-500 small fw-semibold">Pembaruan Berita</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="p-4 bg-slate-50 rounded-4 text-center border border-slate-100">
                    <div class="display-5 fw-black font-playfair text-primary mb-1">🇮🇩</div>
                    <div class="text-slate-500 small fw-semibold">Untuk Indonesia</div>
                </div>
            </div>
        </div>

        <div class="row g-5 align-items-center mb-5 py-4">
            <div class="col-lg-6">
                <h2 class="fw-bold font-playfair h3 mb-4">Misi Kami</h2>
                <p class="text-slate-600 mb-4" style="line-height: 1.85;">Info Portal lahir dari keyakinan bahwa <strong>informasi yang baik dapat mengubah keputusan</strong>. Di era digital yang penuh dengan hoaks dan berita sensasional, kami hadir untuk memberikan perspektif yang jernih, terverifikasi, dan bermanfaat.</p>
                <div class="d-flex flex-column gap-3">
                    <div class="d-flex align-items-start gap-3">
                        <div class="mt-1 rounded-circle bg-indigo-soft d-flex align-items-center justify-content-center flex-shrink-0" style="width: 36px; height: 36px;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="text-primary"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <div>
                            <div class="fw-bold text-slate-800">Akurasi di Atas Segalanya</div>
                            <div class="text-slate-500 small">Setiap berita kami verifikasi dari sumber terpercaya sebelum dipublikasikan.</div>
                        </div>
                    </div>
                    <div class="d-flex align-items-start gap-3">
                        <div class="mt-1 rounded-circle bg-indigo-soft d-flex align-items-center justify-content-center flex-shrink-0" style="width: 36px; height: 36px;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="text-primary"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <div>
                            <div class="fw-bold text-slate-800">Kecepatan & Relevansi</div>
                            <div class="text-slate-500 small">Berita terkini disajikan dengan cepat tanpa mengorbankan kualitas.</div>
                        </div>
                    </div>
                    <div class="d-flex align-items-start gap-3">
                        <div class="mt-1 rounded-circle bg-indigo-soft d-flex align-items-center justify-content-center flex-shrink-0" style="width: 36px; height: 36px;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="text-primary"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <div>
                            <div class="fw-bold text-slate-800">Teknologi Modern</div>
                            <div class="text-slate-500 small">Didukung AI untuk ringkasan berita dan rekomendasi konten yang personal.</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="p-5 rounded-5 text-white shadow-xl" style="background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);">
                    <h3 class="fw-bold font-playfair mb-4">Komitmen Kami</h3>
                    <p class="opacity-90 mb-4" style="line-height: 1.8;">Kami berkomitmen untuk selalu menyajikan berita yang <strong>independen</strong>, <strong>berimbang</strong>, dan <strong>bebas dari kepentingan politik maupun komersial</strong>.</p>
                    <p class="opacity-90 mb-0" style="line-height: 1.8;">Info Portal mematuhi <strong>Kode Etik Jurnalistik</strong> dan standar penulisan berita digital Indonesia.</p>
                </div>
            </div>
        </div>

        <!-- Ad Notice -->
        <div class="p-4 bg-amber-50 rounded-4 border border-amber-100 mb-5">
            <div class="d-flex align-items-start gap-3">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#d97706" stroke-width="2" class="flex-shrink-0 mt-1"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <div>
                    <div class="fw-bold text-amber-800 mb-1">Transparansi Iklan</div>
                    <p class="text-amber-700 small mb-0">Info Portal didukung oleh iklan dari Google AdSense. Iklan ini membantu kami menjaga layanan tetap gratis untuk semua pembaca. Kami tidak memiliki kendali atas iklan spesifik yang ditampilkan.</p>
                </div>
            </div>
        </div>

        <!-- Contact -->
        <div class="row justify-content-center">
            <div class="col-lg-7 text-center">
                <h2 class="fw-bold font-playfair h3 mb-3">Hubungi Redaksi</h2>
                <p class="text-slate-500 mb-4">Punya berita, koreksi, atau kerjasama? Kami terbuka untuk berdiskusi.</p>
                <a href="mailto:redaksi@infoportal.id" class="btn btn-modern px-5 py-3 rounded-pill">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="me-2"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    Kirim Email
                </a>
            </div>
        </div>

    </div>
</div>
@endsection
