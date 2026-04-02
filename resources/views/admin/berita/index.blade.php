<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h2 class="font-bold text-2xl text-slate-800 leading-tight">
                    {{ __('Kelola Berita') }}
                </h2>
                <p class="text-sm text-slate-500 mt-1">Atur dan publikasikan berita terbaru Anda di sini.</p>
            </div>
            <a href="{{ route('admin.berita.create') }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-xl font-bold text-sm text-white transition-all hover:bg-indigo-700 hover:shadow-lg focus:outline-none active:scale-95">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                {{ __('Buat Berita Baru') }}
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm border border-slate-100 rounded-3xl">
                <div class="p-8 bg-white">
                    @if (session('success'))
                        <div class="bg-emerald-50 border border-emerald-100 text-emerald-700 px-6 py-4 rounded-2xl relative mb-6 flex items-center" role="alert">
                            <svg class="w-5 h-5 mr-3 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            <span class="block sm:inline font-semibold">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="overflow-x-auto rounded-2xl border border-slate-50">
                        <table class="min-w-full divide-y divide-slate-100">
                            <thead class="bg-slate-50/50">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-widest">Visual</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-widest">Informasi Berita</th>
                                    <th class="px-6 py-4 text-center text-xs font-bold text-slate-400 uppercase tracking-widest">Status</th>
                                    <th class="px-6 py-4 text-center text-xs font-bold text-slate-400 uppercase tracking-widest">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-slate-50">
                                @forelse ($beritas as $berita)
                                    <tr class="hover:bg-slate-50/30 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($berita->image)
                                                <div class="h-14 w-20 flex-shrink-0">
                                                    <img src="{{ Storage::url($berita->image) }}" class="h-full w-full object-cover rounded-xl shadow-sm border border-slate-100" alt="">
                                                </div>
                                            @else
                                                <div class="h-14 w-20 flex-shrink-0 bg-slate-100 rounded-xl flex items-center justify-center text-[10px] text-slate-400 font-bold uppercase">No Image</div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-bold text-slate-800">{{ $berita->title }}</div>
                                            <div class="text-xs text-slate-400 mt-0.5 flex items-center">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                                {{ $berita->user->name }} • {{ $berita->created_at->format('d M Y') }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <span class="px-3 py-1 inline-flex text-[11px] leading-5 font-bold rounded-full {{ $berita->status === 'published' ? 'bg-indigo-50 text-indigo-700 border border-indigo-100' : 'bg-slate-50 text-slate-600 border border-slate-100' }}">
                                                {{ strtoupper($berita->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex justify-center items-center space-x-3">
                                                <a href="{{ route('admin.berita.edit', $berita) }}" class="p-2 text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors" title="Edit">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                                </a>
                                                <form action="{{ route('admin.berita.destroy', $berita) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="p-2 text-rose-600 hover:bg-rose-50 rounded-lg transition-colors" title="Hapus">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center">
                                                <div class="bg-slate-50 p-4 rounded-full mb-3">
                                                    <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2zM9 7h6m-6 4h6m-6 4h10"/></svg>
                                                </div>
                                                <p class="text-slate-500 font-semibold">Belum ada berita yang ditemukan.</p>
                                                <a href="{{ route('admin.berita.create') }}" class="mt-2 text-indigo-600 font-bold hover:underline">Mulai menulis sekarang</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-8">
                        {{ $beritas->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
