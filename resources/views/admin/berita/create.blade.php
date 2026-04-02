<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.berita.index') }}" class="p-2 bg-white border border-slate-200 rounded-xl text-slate-400 hover:text-indigo-600 hover:border-indigo-100 transition-all shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </a>
            <div>
                <h2 class="font-bold text-2xl text-slate-800 leading-tight">
                    {{ __('Tulis Berita Baru') }}
                </h2>
                <p class="text-sm text-slate-500 mt-1">Sampaikan informasi terbaru dengan gaya yang menarik.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm border border-slate-100 rounded-3xl">
                <div class="p-8 bg-white">
                    <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                        @csrf
                        
                        <!-- Title Field -->
                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-slate-700 ml-1">Judul Berita</label>
                            <input type="text" name="title" 
                                   class="block w-full px-5 py-4 bg-slate-50/50 border border-slate-200 rounded-2xl text-slate-800 font-bold text-lg focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all placeholder:text-slate-300 @error('title') border-rose-500 bg-rose-50/10 @enderror" 
                                   placeholder="Masukkan judul berita yang menarik..." 
                                   value="{{ old('title') }}" required>
                            @error('title')
                                <p class="text-rose-500 text-xs mt-1 font-semibold ml-1">Oops! {{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Content Field -->
                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-slate-700 ml-1">Konten Berita</label>
                            <textarea name="content" rows="12" 
                                      class="block w-full px-5 py-4 bg-slate-50/50 border border-slate-200 rounded-2xl text-slate-700 leading-relaxed focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all placeholder:text-slate-300 @error('content') border-rose-500 bg-rose-50/10 @enderror" 
                                      placeholder="Tuliskan isi berita Anda secara detail di sini..." required>{{ old('content') }}</textarea>
                            @error('content')
                                <p class="text-rose-500 text-xs mt-1 font-semibold ml-1">Harap perbaiki konten: {{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Category Selection -->
                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-slate-700 ml-1">Kategori Berita</label>
                            <select name="category_id" 
                                    class="block w-full px-5 py-4 bg-slate-50/50 border border-slate-200 rounded-2xl text-slate-700 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all @error('category_id') border-rose-500 bg-rose-50/10 @enderror">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="text-rose-500 text-xs mt-1 font-semibold ml-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Image Upload -->
                            <div class="space-y-2">
                                <label class="block text-sm font-bold text-slate-700 ml-1">Gambar Cover</label>
                                <div class="relative group">
                                    <input type="file" name="image" id="image" class="hidden" onchange="previewImage(event)">
                                    <label for="image" class="block w-full px-5 py-8 border-2 border-dashed border-slate-200 bg-slate-50/30 rounded-2xl text-center cursor-pointer hover:border-indigo-300 hover:bg-slate-50 transition-all @error('image') border-rose-200 bg-rose-50/20 @enderror">
                                        <div id="preview-placeholder" class="space-y-2">
                                            <svg class="mx-auto h-12 w-12 text-slate-300" stroke="currentColor" fill="none" viewBox="0 0 48 48"><path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                                            <div class="text-sm font-semibold text-slate-600">Klik untuk upload gambar</div>
                                            <p class="text-xs text-slate-400">PNG, JPG, GIF hingga 2MB</p>
                                        </div>
                                        <img id="image-preview" class="hidden w-full h-48 object-cover rounded-xl shadow-sm" alt="Preview">
                                    </label>
                                </div>
                                @error('image')
                                    <p class="text-rose-500 text-xs mt-1 font-semibold ml-1">Format gambar salah: {{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Status Selection -->
                            <div class="space-y-2">
                                <label class="block text-sm font-bold text-slate-700 ml-1">Status Publikasi</label>
                                <div class="grid grid-cols-2 gap-4">
                                    <label class="cursor-pointer">
                                        <input type="radio" name="status" value="draft" class="hidden peer" {{ old('status') !== 'published' ? 'checked' : '' }}>
                                        <div class="p-4 text-center border-2 border-slate-100 rounded-2xl bg-slate-50/30 text-slate-400 font-bold text-sm peer-checked:border-indigo-500 peer-checked:bg-indigo-50 peer-checked:text-indigo-600 transition-all">
                                            SAVE AS DRAFT
                                        </div>
                                    </label>
                                    <label class="cursor-pointer">
                                        <input type="radio" name="status" value="published" class="hidden peer" {{ old('status') === 'published' ? 'checked' : '' }}>
                                        <div class="p-4 text-center border-2 border-slate-100 rounded-2xl bg-slate-50/30 text-slate-400 font-bold text-sm peer-checked:border-indigo-500 peer-checked:bg-indigo-50 peer-checked:text-indigo-600 transition-all">
                                            PUBLISH NOW
                                        </div>
                                    </label>
                                </div>
                                @error('status')
                                    <p class="text-rose-500 text-xs mt-1 font-semibold ml-1">{{ $message }}</p>
                                @enderror
                                <p class="text-[11px] text-slate-400 px-1 mt-3">Draft hanya akan terlihat oleh Anda. Published akan tayang di halaman utama portal.</p>
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="flex items-center justify-end gap-4 pt-8 mt-8 border-t border-slate-100">
                            <a href="{{ route('admin.berita.index') }}" class="px-6 py-3 text-sm font-bold text-slate-400 hover:text-slate-600 transition-colors">
                                Batal
                            </a>
                            <button type="submit" class="inline-flex items-center px-10 py-4 bg-indigo-600 border border-transparent rounded-2xl font-bold text-sm text-white transition-all hover:bg-indigo-700 hover:shadow-xl focus:outline-none active:scale-95">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                {{ __('Kirim Berita') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('image-preview');
                var placeholder = document.getElementById('preview-placeholder');
                output.src = reader.result;
                output.classList.remove('hidden');
                placeholder.classList.add('hidden');
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</x-app-layout>
