<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.berita.index') }}" class="p-2 bg-white border border-slate-200 rounded-xl text-slate-400 hover:text-indigo-600 hover:border-indigo-100 transition-all shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </a>
            <div>
                <h2 class="font-bold text-2xl text-slate-800 leading-tight flex items-center gap-2">
                    <span>✨</span> Generator Artikel AI
                </h2>
                <p class="text-sm text-slate-500 mt-1">Buat artikel berkualitas tinggi dengan bantuan Gemini AI.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if($errors->any())
                <div class="bg-rose-50 border border-rose-200 text-rose-700 px-5 py-4 rounded-2xl text-sm font-semibold">
                    {{ $errors->first() }}
                </div>
            @endif

            {{-- GENERATOR FORM --}}
            <div class="bg-white overflow-hidden shadow-sm border border-slate-100 rounded-3xl">
                <div class="p-8">
                    <form action="{{ route('admin.ai-article.generate') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-slate-700 ml-1">Topik / Judul Kasar</label>
                            <input type="text" name="topic" 
                                   class="block w-full px-5 py-4 bg-slate-50/50 border border-slate-200 rounded-2xl text-slate-800 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all"
                                   placeholder="Contoh: Cara Install Docker di Ubuntu 24.04"
                                   value="{{ old('topic', session('_old_input.topic')) }}" required>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="space-y-2">
                                <label class="block text-sm font-bold text-slate-700 ml-1">Gaya Penulisan</label>
                                <select name="style" class="block w-full px-5 py-4 bg-slate-50/50 border border-slate-200 rounded-2xl text-slate-700 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all">
                                    <option value="berita" {{ old('style') == 'berita' ? 'selected' : '' }}>📰 Berita / Artikel</option>
                                    <option value="how-to" {{ old('style') == 'how-to' ? 'selected' : '' }}>📋 How-To / Panduan</option>
                                    <option value="review" {{ old('style') == 'review' ? 'selected' : '' }}>⭐ Review / Ulasan</option>
                                    <option value="listicle" {{ old('style') == 'listicle' ? 'selected' : '' }}>🔢 Listicle / Daftar</option>
                                </select>
                            </div>
                            <div class="space-y-2">
                                <label class="block text-sm font-bold text-slate-700 ml-1">Panjang Artikel</label>
                                <select name="length" class="block w-full px-5 py-4 bg-slate-50/50 border border-slate-200 rounded-2xl text-slate-700 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all">
                                    <option value="short">Pendek (~400 kata)</option>
                                    <option value="medium" selected>Sedang (~800 kata)</option>
                                    <option value="long">Panjang (~1200 kata)</option>
                                </select>
                            </div>
                            <div class="space-y-2">
                                <label class="block text-sm font-bold text-slate-700 ml-1">Kategori</label>
                                <select name="category_id" class="block w-full px-5 py-4 bg-slate-50/50 border border-slate-200 rounded-2xl text-slate-700 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all">
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-slate-700 ml-1">Keywords Target SEO <span class="font-normal text-slate-400">(opsional, pisahkan koma)</span></label>
                            <input type="text" name="keywords"
                                   class="block w-full px-5 py-4 bg-slate-50/50 border border-slate-200 rounded-2xl text-slate-700 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all"
                                   placeholder="Contoh: install docker, docker ubuntu, container linux"
                                   value="{{ old('keywords') }}">
                        </div>

                        <button type="submit" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-indigo-600 to-violet-600 border border-transparent rounded-2xl font-bold text-sm text-white transition-all hover:shadow-xl hover:scale-105 active:scale-95">
                            <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="none"><path d="M9.81 12L11 12M13 12L14.19 12M12 9.81V11M12 13V14.19" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2"/></svg>
                            Generate dengan AI ✨
                        </button>
                    </form>
                </div>
            </div>

            {{-- GENERATED RESULT --}}
            @if(session('generated_title') || session('generated_content'))
            <div class="bg-white overflow-hidden shadow-sm border border-indigo-100 rounded-3xl">
                <div class="p-6 bg-gradient-to-r from-indigo-50 to-violet-50 border-b border-indigo-100">
                    <p class="text-indigo-700 font-bold text-sm flex items-center gap-2">
                        <span>✅</span> Artikel berhasil digenerate! Review dan simpan di bawah ini.
                    </p>
                </div>
                <div class="p-8">
                    <form action="{{ route('admin.ai-article.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-slate-700 ml-1">Judul Artikel</label>
                            <input type="text" name="title"
                                   class="block w-full px-5 py-4 bg-slate-50/50 border border-slate-200 rounded-2xl text-slate-800 font-bold text-lg focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all"
                                   value="{{ session('generated_title') }}" required>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-slate-700 ml-1">Konten Artikel</label>
                            <textarea name="content" rows="20"
                                      class="block w-full px-5 py-4 bg-slate-50/50 border border-slate-200 rounded-2xl text-slate-700 leading-relaxed focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all"
                                      required>{{ session('generated_content') }}</textarea>
                        </div>
                        <input type="hidden" name="category_id" value="{{ session('category_id') }}">
                        <div class="flex items-center gap-4 pt-4 border-t border-slate-100">
                            <label class="text-sm font-bold text-slate-700">Status:</label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="status" value="draft" class="text-indigo-600"> Draft
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="status" value="published" checked class="text-indigo-600"> Publish Sekarang
                            </label>
                            <button type="submit" class="ms-auto inline-flex items-center px-8 py-3 bg-indigo-600 rounded-2xl font-bold text-sm text-white hover:bg-indigo-700 transition-all hover:shadow-lg active:scale-95">
                                💾 Simpan Artikel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            @endif

        </div>
    </div>
</x-app-layout>
