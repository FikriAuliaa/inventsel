<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-8">
        <div
            class="flex flex-col md:flex-row justify-between items-start md:items-center gap-2 pb-6 border-b border-gray-200/60 dark:border-zinc-800/80">
            <div>
                <div
                    class="flex items-center gap-2 text-xs uppercase font-bold tracking-wider text-gray-400 dark:text-zinc-500 mb-1.5">
                    <span>Beranda</span>
                    <span>/</span>
                    <span>Master Barang</span>
                    <span>/</span>
                    <span class="text-indigo-600 dark:text-white">Detail</span>
                </div>
                <h2 class="text-2xl font-black text-gray-800 dark:text-zinc-100 tracking-tight">
                    Detail: {{ $product->nama_barang }}
                </h2>
            </div>
            <a href="{{ route('products.index') }}"
                class="inline-flex items-center gap-2 bg-white dark:bg-[#1e1f20] hover:bg-gray-50 dark:hover:bg-zinc-800 text-gray-700 dark:text-gray-300 font-bold py-2 px-4 rounded-xl text-sm border border-gray-200 dark:border-zinc-700 shadow-sm transition transform active:scale-95 shrink-0">
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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <div
                class="bg-white dark:bg-[#1e1f20] rounded-2xl shadow-sm border border-gray-200/80 dark:border-zinc-800/80 p-6 flex flex-col md:flex-row gap-8 items-center md:items-start">
                <div
                    class="w-full md:w-48 h-48 shrink-0 bg-gray-50 dark:bg-[#131314] rounded-2xl overflow-hidden border border-gray-100 dark:border-zinc-800 flex items-center justify-center">
                    @if($product->gambar)
                        <img src="{{ asset('storage/' . $product->gambar) }}" alt="Gambar"
                            class="w-full h-full object-cover">
                    @else
                        <span class="text-gray-400 dark:text-zinc-500 text-sm font-medium">Tidak ada gambar</span>
                    @endif
                </div>
                <div class="flex-1 w-full grid grid-cols-1 sm:grid-cols-2 gap-y-4 gap-x-6 text-sm">
                    <div class="sm:col-span-2 border-b border-gray-100 dark:border-zinc-800 pb-3">
                        <p class="text-xs uppercase text-gray-400 dark:text-zinc-500 font-bold tracking-wider">Nama
                            Spesifikasi Aset</p>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mt-0.5">{{ $product->nama_barang }}
                        </h3>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 dark:text-zinc-500 font-medium">Kode Katalog Utama</p>
                        <p class="font-mono text-gray-900 dark:text-white font-semibold mt-0.5">
                            {{ $product->kode_barang }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 dark:text-zinc-500 font-medium">Kategori Sistem</p>
                        <p class="text-gray-900 dark:text-white font-semibold mt-0.5">{{ $product->category->name }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 dark:text-zinc-500 font-medium">Lokasi Penempatan Resmi</p>
                        <p class="text-gray-900 dark:text-white font-semibold mt-0.5">{{ $product->lokasi_penyimpanan }}
                        </p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 dark:text-zinc-500 font-medium">Total Akumulasi Stok</p>
                        <p class="text-indigo-600 dark:text-indigo-400 font-extrabold text-lg mt-0.5">
                            {{ $product->stok }} <span class="text-xs text-gray-400 dark:text-zinc-500 font-normal">Unit
                                Fisik</span>
                        </p>
                    </div>
                </div>
            </div>

            <div
                class="bg-white dark:bg-[#1e1f20] rounded-2xl shadow-sm border border-gray-200/80 dark:border-zinc-800/80 p-8">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Registrasi Kode Unik Unit Fisik (Serial
                    Number)</h3>
                <p class="text-xs text-gray-400 dark:text-zinc-500 mb-6">Daftarkan kode pelacakan spesifik untuk setiap
                    unit barang lapangan di bawah ini.</p>

                <form action="{{ route('instances.store', $product->id) }}" method="POST"
                    class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end mb-8 border-b border-gray-100 dark:border-zinc-800 pb-8">
                    @csrf
                    <div>
                        <label for="kode_unik"
                            class="block text-xs font-semibold text-gray-600 dark:text-zinc-400 uppercase mb-2">Kode
                            Unik / Label Aset</label>
                        <input id="kode_unik" name="kode_unik" type="text"
                            class="w-full px-4 py-2 rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-[#131314] text-gray-900 dark:text-zinc-100 focus:border-indigo-500 focus:ring focus:ring-indigo-200/50 transition text-sm placeholder-gray-400 dark:placeholder-zinc-600"
                            placeholder="Contoh: BNPZ101" required />
                    </div>
                    <div>
                        <label for="kondisi_barang"
                            class="block text-xs font-semibold text-gray-600 dark:text-zinc-400 uppercase mb-2">Kondisi
                            Awal Unit</label>
                        <select id="kondisi_barang" name="kondisi_barang"
                            class="w-full px-4 py-2 rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-[#131314] text-gray-900 dark:text-zinc-100 focus:border-indigo-500 focus:ring focus:ring-indigo-200/50 transition text-sm"
                            required>
                            <option value="Baik">Baik (Normal)</option>
                            <option value="Rusak Ringan">Rusak Ringan (Bisa dipakai)</option>
                            <option value="Rusak Berat">Rusak Berat (Mati/Gudang)</option>
                        </select>
                    </div>
                    <div>
                        <button type="submit"
                            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-5 rounded-xl text-sm transition transform active:scale-95 shadow-md shadow-indigo-100 dark:shadow-none">
                            + Daftarkan Unit Fisik
                        </button>
                    </div>
                </form>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-600 dark:text-zinc-400">
                        <thead
                            class="text-xs text-gray-700 dark:text-zinc-300 uppercase bg-gray-50/70 dark:bg-[#131314]/50 border-b border-gray-200/80 dark:border-zinc-800/80">
                            <tr>
                                <th scope="col" class="px-6 py-4 font-semibold">Kode Pelacakan Fisik</th>
                                <th scope="col" class="px-6 py-4 font-semibold">Status Operasional</th>
                                <th scope="col" class="px-6 py-4 font-semibold">Kondisi Fisik Terkini</th>
                                <th scope="col" class="px-6 py-4 font-semibold text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-zinc-800/80">
                            @forelse($product->instances as $instance)
                                <tr class="hover:bg-gray-50/50 dark:hover:bg-zinc-800/20 transition">
                                    <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                        {{ $instance->kode_unik }}</td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="px-2.5 py-1 rounded-lg text-xs font-semibold {{ $instance->status_ketersediaan == 'Tersedia' ? 'bg-emerald-50 dark:bg-emerald-950/20 text-emerald-700 dark:text-emerald-400' : ($instance->status_ketersediaan == 'Dipinjam' ? 'bg-amber-50 dark:bg-amber-950/20 text-amber-700 dark:text-amber-400' : 'bg-red-50 dark:bg-red-950/20 text-red-700 dark:text-red-400') }}">
                                            {{ $instance->status_ketersediaan }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-gray-700 dark:text-gray-300 font-medium">
                                        {{ $instance->kondisi_barang }}</td>
                                    <td class="px-6 py-4 text-right">
                                        <form action="{{ route('instances.destroy', $instance->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-white text-xs font-semibold bg-red-50 dark:bg-zinc-800 px-3 py-1.5 rounded-lg transition border dark:border-zinc-700">Hapus
                                                Unit</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-6 text-center text-gray-400 dark:text-zinc-500">Belum ada
                                        identitas unit fisik terdaftar untuk katalog ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>