<x-app-layout>
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 pt-8">
        <div
            class="flex flex-col md:flex-row justify-between items-start md:items-center gap-2 pb-6 border-b border-gray-200/60 dark:border-zinc-800/80">
            <div>
                <div
                    class="flex items-center gap-2 text-xs uppercase font-bold tracking-wider text-gray-400 dark:text-zinc-500 mb-1.5">
                    <span>Beranda</span>
                    <span>/</span>
                    <span>Master Barang</span>
                    <span>/</span>
                    <span class="text-indigo-600 dark:text-white">Edit</span>
                </div>
                <h2 class="text-2xl font-black text-gray-800 dark:text-zinc-100 tracking-tight">
                    Edit Master Barang
                </h2>
            </div>
            <a href="{{ route('products.index') }}"
                class="inline-flex items-center gap-2 bg-white dark:bg-[#1e1f20] hover:bg-gray-50 dark:hover:bg-zinc-800 text-gray-700 dark:text-zinc-300 font-bold py-2 px-4 rounded-xl text-sm border border-gray-200 dark:border-zinc-700 shadow-sm transition transform active:scale-95 shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali
            </a>
        </div>
    </div>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-white dark:bg-[#1e1f20] rounded-2xl shadow-sm border border-gray-200/80 dark:border-zinc-800/80 p-8">
                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data"
                    class="space-y-6">
                    @csrf
                    @method('PUT')
                    <div>
                        <label for="nama_barang"
                            class="block text-xs font-bold uppercase tracking-wider text-gray-600 dark:text-zinc-400 mb-2">Nama
                            Lengkap Barang</label>
                        <input id="nama_barang" name="nama_barang" type="text" required
                            value="{{ old('nama_barang', $product->nama_barang) }}"
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-[#131314] text-gray-900 dark:text-zinc-100 focus:border-indigo-500 focus:ring focus:ring-indigo-200/50 transition text-sm" />
                        <x-input-error :messages="$errors->get('nama_barang')" class="mt-1" />
                    </div>
                    <div>
                        <label for="kode_barang"
                            class="block text-xs font-bold uppercase tracking-wider text-gray-600 dark:text-zinc-400 mb-2">Kode
                            Katalog Utama</label>
                        <input id="kode_barang" name="kode_barang" type="text" required
                            value="{{ old('kode_barang', $product->kode_barang) }}"
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-[#131314] text-gray-900 dark:text-zinc-100 focus:border-indigo-500 focus:ring focus:ring-indigo-200/50 transition text-sm font-mono" />
                        <x-input-error :messages="$errors->get('kode_barang')" class="mt-1" />
                    </div>
                    <div>
                        <label for="category_id"
                            class="block text-xs font-bold uppercase tracking-wider text-gray-600 dark:text-zinc-400 mb-2">Kelompok
                            Kategori</label>
                        <select id="category_id" name="category_id" required
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-[#131314] text-gray-900 dark:text-zinc-100 focus:border-indigo-500 focus:ring focus:ring-indigo-200/50 transition text-sm">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('category_id')" class="mt-1" />
                    </div>
                    <div>
                        <label for="lokasi_penyimpanan"
                            class="block text-xs font-bold uppercase tracking-wider text-gray-600 dark:text-zinc-400 mb-2">Lokasi
                            Penempatan Penyimpanan</label>
                        <input id="lokasi_penyimpanan" name="lokasi_penyimpanan" type="text" required
                            value="{{ old('lokasi_penyimpanan', $product->lokasi_penyimpanan) }}"
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-[#131314] text-gray-900 dark:text-zinc-100 focus:border-indigo-500 focus:ring focus:ring-indigo-200/50 transition text-sm" />
                        <x-input-error :messages="$errors->get('lokasi_penyimpanan')" class="mt-1" />
                    </div>
                    <div>
                        <label for="stok"
                            class="block text-xs font-bold uppercase tracking-wider text-gray-600 dark:text-zinc-400 mb-2">Kuantitas
                            Stok</label>
                        <input id="stok" name="stok" type="number" min="0" required
                            value="{{ old('stok', $product->stok) }}"
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-[#131314] text-gray-900 dark:text-zinc-100 focus:border-indigo-500 focus:ring focus:ring-indigo-200/50 transition text-sm" />
                        <x-input-error :messages="$errors->get('stok')" class="mt-1" />
                    </div>
                    <div>
                        <label
                            class="block text-xs font-bold uppercase tracking-wider text-gray-600 dark:text-zinc-400 mb-2">Gambar
                            Dokumentasi Unit</label>
                        @if($product->gambar)
                            <div class="mb-3">
                                <img src="{{ asset('storage/' . $product->gambar) }}"
                                    class="w-32 h-32 object-cover rounded-xl border border-gray-200 dark:border-zinc-700 shadow-sm"
                                    alt="Current image">
                            </div>
                        @endif
                        <input type="file" name="gambar"
                            class="w-full text-sm text-gray-500 dark:text-zinc-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-gray-100 dark:file:bg-[#131314] file:text-gray-700 dark:file:text-zinc-300 hover:file:bg-gray-200 dark:hover:file:bg-zinc-800" />
                        <x-input-error :messages="$errors->get('gambar')" class="mt-1" />
                    </div>
                    <div class="pt-4">
                        <button type="submit"
                            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 px-4 rounded-xl text-sm transition transform active:scale-95 shadow-md shadow-indigo-100 dark:shadow-none">
                            Perbarui Data Katalog Master Barang
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>