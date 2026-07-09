<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-8">
        <div
            class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 pb-6 border-b border-gray-200/60 dark:border-zinc-800/80">
            <div>
                <div
                    class="flex items-center gap-2 text-xs uppercase font-bold tracking-wider text-gray-400 dark:text-zinc-500 mb-1.5">
                    <span>Beranda</span>
                    <span>/</span>
                    <span class="text-indigo-600 dark:text-white">Kategori</span>
                </div>
                <h2 class="text-2xl font-black text-gray-800 dark:text-zinc-100 tracking-tight">
                    Manajemen Kategori Klasifikasi
                </h2>
            </div>
            <a href="{{ route('categories.create') }}"
                class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2.5 px-5 rounded-xl text-sm shadow-md transition transform active:scale-95 shrink-0">
                + Tambah Kategori
            </a>
        </div>
    </div>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-white dark:bg-[#1e1f20] rounded-2xl shadow-sm border border-gray-200/80 dark:border-zinc-800/80 overflow-hidden">
                <div class="p-6 text-gray-800 dark:text-zinc-200 overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-600 dark:text-zinc-400 align-middle">
                        <thead
                            class="text-xs text-gray-700 dark:text-zinc-300 uppercase bg-gray-50/70 dark:bg-[#131314]/50 border-b border-gray-200/80 dark:border-zinc-800/80">
                            <tr>
                                <th scope="col" class="px-6 py-4 font-semibold">Nama Kategori</th>
                                <th scope="col" class="px-6 py-4 font-semibold">Deskripsi Aturan Kategori</th>
                                <th scope="col" class="px-6 py-4 font-semibold">Asosiasi Produk</th>
                                <th scope="col" class="px-6 py-4 font-semibold text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-zinc-800/80">
                            @forelse($categories as $category)
                                <tr class="hover:bg-gray-50/50 dark:hover:bg-zinc-800/20 transition">
                                    <td class="px-6 py-4 font-bold text-gray-900 dark:text-white">{{ $category->name }}</td>
                                    <td class="px-6 py-4 text-gray-500 dark:text-zinc-400 font-medium">
                                        {{ $category->description ?? '-' }}</td>
                                    <td class="px-6 py-4 text-gray-700 dark:text-zinc-300 font-semibold">
                                        {{ $category->products_count }} <span
                                            class="text-xs text-gray-400 dark:text-zinc-500 font-normal">Jenis
                                            Katalog</span>
                                    </td>
                                    <td class="px-6 py-4 text-right flex justify-end gap-3 items-center">
                                        <a href="{{ route('categories.edit', $category->id) }}"
                                            class="text-amber-600 dark:text-amber-400 hover:text-amber-900 dark:hover:text-white text-xs font-semibold bg-amber-50 dark:bg-zinc-800 px-3 py-1.5 rounded-lg transition border dark:border-zinc-700">Edit</a>
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-white text-xs font-semibold bg-red-50 dark:bg-zinc-800 px-3 py-1.5 rounded-lg transition border dark:border-zinc-700">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-8 text-center text-gray-400 dark:text-zinc-500">Belum ada
                                        kelompok klasifikasi kategori di database.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>