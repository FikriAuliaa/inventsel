<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-8">
        <div
            class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 pb-6 border-b border-gray-200/60 dark:border-zinc-800/80">
            <div>
                <div
                    class="flex items-center gap-2 text-xs uppercase font-bold tracking-wider text-gray-400 dark:text-zinc-500 mb-1.5">
                    <span>Beranda</span>
                    <span>/</span>
                    <span class="text-indigo-600 dark:text-white">Master Barang</span>
                </div>
                <h2 class="text-2xl font-black text-gray-800 dark:text-zinc-100 tracking-tight">
                    Katalog Master Barang
                </h2>
            </div>
            <a href="{{ route('products.create') }}"
                class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2.5 px-5 rounded-xl text-sm shadow-md transition transform active:scale-95 shrink-0">
                + Tambah Barang
            </a>
        </div>
    </div>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div
                class="bg-white dark:bg-[#1e1f20] rounded-2xl p-5 shadow-sm border border-gray-200/80 dark:border-zinc-800/80">
                <form action="{{ route('products.index') }}" method="GET"
                    class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                    <input type="hidden" name="sort" value="{{ request('sort', 'created_at') }}">
                    <input type="hidden" name="order" value="{{ request('order', 'desc') }}">
                    <div class="md:col-span-2">
                        <label
                            class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-zinc-400 mb-2">Pencarian</label>
                        <input type="text" name="search" value="{{ request('search') }}"
                            class="w-full px-4 py-2 text-sm rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-[#131314] text-gray-900 dark:text-zinc-100 focus:border-indigo-500 focus:ring focus:ring-indigo-200/50 transition placeholder-gray-400 dark:placeholder-zinc-600"
                            placeholder="Nama atau kode barang..." />
                    </div>
                    <div>
                        <label
                            class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-zinc-400 mb-2">Filter
                            Kategori</label>
                        <div class="flex gap-2">
                            <select name="category_id"
                                class="w-full px-4 py-2 text-sm rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-[#131314] text-gray-900 dark:text-zinc-100 focus:border-indigo-500 focus:ring focus:ring-indigo-200/50 transition">
                                <option value="">Semua Kategori</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}</option>
                                @endforeach
                            </select>
                            <button type="submit"
                                class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-5 rounded-xl text-sm transition transform active:scale-95 shadow-sm shrink-0">
                                Cari
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div
                class="bg-white dark:bg-[#1e1f20] rounded-2xl shadow-sm border border-gray-200/80 dark:border-zinc-800/80 overflow-hidden">
                <div class="p-6 text-gray-800 dark:text-zinc-200 overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-600 dark:text-zinc-400">
                        <thead
                            class="text-xs text-gray-700 dark:text-zinc-300 uppercase bg-gray-50/70 dark:bg-[#131314]/50 border-b border-gray-200/80 dark:border-zinc-800/80">
                            <tr>
                                <th scope="col" class="px-6 py-4 font-semibold">Gambar</th>
                                <th scope="col" class="px-6 py-4 font-semibold">Kode Katalog</th>
                                <th scope="col" class="px-6 py-4 font-semibold">
                                    <a href="{{ route('products.index', array_merge(request()->query(), ['sort' => 'nama_barang', 'order' => request('sort') == 'nama_barang' && request('order', 'desc') == 'desc' ? 'asc' : 'desc'])) }}"
                                        class="flex items-center gap-1.5 hover:text-indigo-600 dark:hover:text-white transition">
                                        Nama Barang
                                        @if(request('sort', 'created_at') == 'nama_barang')
                                            {!! request('order', 'desc') == 'desc' ? '↓' : '↑' !!}
                                        @else
                                            <span class="text-gray-300 dark:text-zinc-600">↕</span>
                                        @endif
                                    </a>
                                </th>
                                <th scope="col" class="px-6 py-4 font-semibold">Kategori</th>
                                <th scope="col" class="px-6 py-4 font-semibold">
                                    <a href="{{ route('products.index', array_merge(request()->query(), ['sort' => 'stok', 'order' => request('sort') == 'stok' && request('order', 'desc') == 'desc' ? 'asc' : 'desc'])) }}"
                                        class="flex items-center gap-1.5 hover:text-indigo-600 dark:hover:text-white transition">
                                        Total Stok
                                        @if(request('sort') == 'stok')
                                            {!! request('order', 'desc') == 'desc' ? '↓' : '↑' !!}
                                        @else
                                            <span class="text-gray-300 dark:text-zinc-600">↕</span>
                                        @endif
                                    </a>
                                </th>
                                <th scope="col" class="px-6 py-4 font-semibold text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-zinc-800/80">
                            @forelse($products as $product)
                                <tr class="hover:bg-gray-50/50 dark:hover:bg-zinc-800/20 transition">
                                    <td class="px-6 py-4">
                                        @if($product->gambar)
                                            <img src="{{ asset('storage/' . $product->gambar) }}" alt="Gambar"
                                                class="w-14 h-14 object-cover rounded-xl shadow-sm border border-gray-100 dark:border-zinc-700">
                                        @else
                                            <div
                                                class="w-14 h-14 bg-gray-100 dark:bg-[#131314] rounded-xl flex items-center justify-center text-[10px] text-gray-400 dark:text-zinc-500 font-medium border dark:border-zinc-800">
                                                No Image</div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 font-mono text-xs text-gray-500 dark:text-zinc-400">
                                        {{ $product->kode_barang }}</td>
                                    <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                        {{ $product->nama_barang }}</td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="bg-gray-100 dark:bg-[#131314] text-gray-700 dark:text-zinc-300 text-xs px-2.5 py-1 rounded-lg font-medium border dark:border-zinc-800">{{ $product->category->name }}</span>
                                    </td>
                                    <td class="px-6 py-4 font-bold text-gray-900 dark:text-white">{{ $product->stok }} <span
                                            class="text-xs text-gray-400 dark:text-zinc-500 font-normal">Unit</span></td>
                                    <td class="px-6 py-4 text-right flex justify-end gap-3 items-center h-20">
                                        <a href="{{ route('products.show', $product->id) }}"
                                            class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-white text-xs font-semibold bg-indigo-50 dark:bg-zinc-800 px-3 py-1.5 rounded-lg transition border dark:border-zinc-700">Detail</a>
                                        <a href="{{ route('products.edit', $product->id) }}"
                                            class="text-amber-600 dark:text-amber-400 hover:text-amber-900 dark:hover:text-white text-xs font-semibold bg-amber-50 dark:bg-zinc-800 px-3 py-1.5 rounded-lg transition border dark:border-zinc-700">Edit</a>
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-white text-xs font-semibold bg-red-50 dark:bg-zinc-800 px-3 py-1.5 rounded-lg transition border dark:border-zinc-700">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-8 text-center text-gray-400 dark:text-zinc-500">Tidak ada
                                        katalog master barang yang sesuai kriteria kueri.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4 px-2">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>