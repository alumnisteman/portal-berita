@extends('layouts.portal')

@section('title', 'Kebijakan Privasi')
@section('meta_description', 'Kebijakan Privasi Portal Berita - Informasi mengenai bagaimana kami mengumpulkan, menggunakan, dan melindungi data pribadi Anda.')

@section('content')
<div class="py-5 bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb px-3 py-2 bg-slate-50 rounded-pill small fw-bold">
                        <li class="breadcrumb-item"><a href="/" class="text-decoration-none text-slate-400">Home</a></li>
                        <li class="breadcrumb-item active text-primary" aria-current="page">Kebijakan Privasi</li>
                    </ol>
                </nav>

                <h1 class="display-5 fw-bold font-playfair mb-2">Kebijakan Privasi</h1>
                <p class="text-slate-400 small mb-5">Terakhir diperbarui: {{ date('d F Y') }}</p>

                <div class="prose text-slate-700" style="line-height: 1.85; font-size: 1.05rem;">

                    <p>Selamat datang di <strong>Info Portal</strong>. Kami berkomitmen untuk melindungi privasi Anda. Kebijakan Privasi ini menjelaskan bagaimana kami mengumpulkan, menggunakan, dan melindungi informasi Anda saat menggunakan layanan kami.</p>

                    <h2 class="fw-bold font-playfair mt-5 mb-3 h4">1. Informasi yang Kami Kumpulkan</h2>
                    <p>Kami dapat mengumpulkan informasi berikut:</p>
                    <ul>
                        <li>Informasi yang Anda berikan secara langsung (nama, email saat mendaftar)</li>
                        <li>Data penggunaan dan perilaku penelusuran di situs kami</li>
                        <li>Informasi teknis seperti alamat IP, jenis browser, dan sistem operasi</li>
                        <li>Cookie dan data pelacakan serupa</li>
                    </ul>

                    <h2 class="fw-bold font-playfair mt-5 mb-3 h4">2. Penggunaan Informasi</h2>
                    <p>Kami menggunakan informasi yang dikumpulkan untuk:</p>
                    <ul>
                        <li>Menyediakan dan meningkatkan layanan kami</li>
                        <li>Menampilkan iklan yang relevan melalui Google AdSense</li>
                        <li>Menganalisis penggunaan situs melalui Google Analytics</li>
                        <li>Mengirimkan notifikasi jika Anda telah memberikan persetujuan</li>
                        <li>Mematuhi kewajiban hukum yang berlaku</li>
                    </ul>

                    <h2 class="fw-bold font-playfair mt-5 mb-3 h4">3. Google AdSense dan Iklan</h2>
                    <p>Situs ini menggunakan <strong>Google AdSense</strong> untuk menampilkan iklan. Google AdSense menggunakan cookie untuk menampilkan iklan berdasarkan kunjungan Anda sebelumnya ke situs ini dan situs-situs lain. Anda dapat menonaktifkan personalisasi iklan dengan mengunjungi <a href="https://www.google.com/settings/ads" target="_blank" rel="noopener" class="text-primary">Pengaturan Iklan Google</a>.</p>

                    <h2 class="fw-bold font-playfair mt-5 mb-3 h4">4. Cookie</h2>
                    <p>Kami menggunakan cookie untuk meningkatkan pengalaman pengguna. Cookie adalah file teks kecil yang disimpan di perangkat Anda. Anda dapat mengontrol penggunaan cookie melalui pengaturan browser Anda.</p>
                    <p>Jenis cookie yang kami gunakan:</p>
                    <ul>
                        <li><strong>Cookie Esensial:</strong> Diperlukan untuk fungsi dasar situs</li>
                        <li><strong>Cookie Analitik:</strong> Digunakan oleh Google Analytics untuk memahami penggunaan situs</li>
                        <li><strong>Cookie Iklan:</strong> Digunakan oleh Google AdSense untuk menampilkan iklan yang relevan</li>
                    </ul>

                    <h2 class="fw-bold font-playfair mt-5 mb-3 h4">5. Tautan ke Situs Pihak Ketiga</h2>
                    <p>Situs kami dapat memuat tautan ke situs web pihak ketiga. Kami tidak bertanggung jawab atas praktik privasi atau konten situs-situs tersebut. Kami mendorong Anda untuk membaca kebijakan privasi situs yang Anda kunjungi.</p>

                    <h2 class="fw-bold font-playfair mt-5 mb-3 h4">6. Keamanan Data</h2>
                    <p>Kami menerapkan langkah-langkah keamanan yang wajar untuk melindungi informasi Anda dari akses tidak sah, perubahan, pengungkapan, atau penghancuran. Namun, tidak ada metode transmisi melalui internet atau penyimpanan elektronik yang 100% aman.</p>

                    <h2 class="fw-bold font-playfair mt-5 mb-3 h4">7. Hak Anda</h2>
                    <p>Anda memiliki hak untuk:</p>
                    <ul>
                        <li>Mengakses informasi pribadi yang kami miliki tentang Anda</li>
                        <li>Meminta koreksi atas informasi yang tidak akurat</li>
                        <li>Meminta penghapusan data Anda dalam kondisi tertentu</li>
                        <li>Menolak pemrosesan data untuk tujuan pemasaran</li>
                    </ul>

                    <h2 class="fw-bold font-playfair mt-5 mb-3 h4">8. Perubahan Kebijakan Privasi</h2>
                    <p>Kami dapat memperbarui Kebijakan Privasi ini dari waktu ke waktu. Perubahan akan diberitahukan di halaman ini dengan memperbarui tanggal "Terakhir diperbarui". Kami menyarankan Anda untuk meninjau kebijakan ini secara berkala.</p>

                    <h2 class="fw-bold font-playfair mt-5 mb-3 h4">9. Hubungi Kami</h2>
                    <p>Jika Anda memiliki pertanyaan tentang Kebijakan Privasi ini, silakan hubungi kami:</p>
                    <div class="p-4 bg-slate-50 rounded-4 border border-slate-100 mt-3">
                        <p class="mb-1"><strong>Info Portal</strong></p>
                        <p class="mb-1">Email: <a href="mailto:redaksi@infoportal.id" class="text-primary">redaksi@infoportal.id</a></p>
                        <p class="mb-0">Website: <a href="{{ url('/') }}" class="text-primary">{{ url('/') }}</a></p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
