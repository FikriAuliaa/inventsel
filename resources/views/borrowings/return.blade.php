<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-8">
        <div
            class="flex flex-col md:flex-row justify-between items-start md:items-center gap-2 pb-6 border-b border-gray-200/60 dark:border-zinc-800/80">
            <div>
                <div
                    class="flex items-center gap-2 text-xs uppercase font-bold tracking-wider text-gray-400 dark:text-zinc-500 mb-1.5">
                    <span>Beranda</span>
                    <span>/</span>
                    <span>Peminjaman</span>
                    <span>/</span>
                    <span class="text-indigo-600 dark:text-white">Form Pengembalian</span>
                </div>
                <h2 class="text-2xl font-black text-gray-800 dark:text-zinc-100 tracking-tight">
                    Form Pengembalian Barang
                </h2>
            </div>
        </div>
    </div>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-white dark:bg-[#1e1f20] rounded-2xl shadow-sm border border-gray-200/80 dark:border-zinc-800/80 p-6">
                <div class="p-6 text-gray-900 dark:text-zinc-100">
                    <div class="mb-6 bg-gray-50 dark:bg-[#131314] p-4 rounded-xl border dark:border-zinc-800">
                        <p class="text-sm"><strong>Peminjam:</strong> {{ $borrowing->user->name }}</p>
                        <p class="text-sm mt-1"><strong>Tanggal Pinjam:</strong>
                            {{ \Carbon\Carbon::parse($borrowing->tanggal_pinjam)->format('d-m-Y') }}</p>
                    </div>

                    <form action="{{ route('borrowings.processReturn', $borrowing->id) }}" method="POST"
                        class="space-y-6">
                        @csrf
                        <div>
                            <label for="tanggal_kembali"
                                class="block text-xs font-bold uppercase tracking-wider text-gray-600 dark:text-zinc-400 mb-2">Tanggal
                                Kembali</label>
                            <input id="tanggal_kembali" name="tanggal_kembali" type="date"
                                class="w-full px-4 py-2.5 rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-[#131314] text-gray-900 dark:text-zinc-100 focus:border-indigo-500 focus:ring focus:ring-indigo-200/50 transition text-sm"
                                value="{{ date('Y-m-d') }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('tanggal_kembali')" />
                        </div>

                        <div class="space-y-3">
                            <h3 class="text-base font-bold text-gray-900 dark:text-white">Cek Fisik Barang Saat
                                Dikembalikan</h3>
                            <div class="overflow-hidden border border-gray-200 dark:border-zinc-800 rounded-xl">
                                <table class="w-full text-sm text-left text-gray-500 dark:text-zinc-400 align-middle">
                                    <thead
                                        class="text-xs text-gray-700 dark:text-zinc-300 uppercase bg-gray-50/70 dark:bg-[#131314]/50 border-b border-gray-200 dark:border-zinc-800">
                                        <tr>
                                            <th scope="col" class="px-6 py-4 font-semibold">Unit / Serial Number</th>
                                            <th scope="col" class="px-6 py-4 font-semibold">Barang</th>
                                            <th scope="col" class="px-6 py-4 font-semibold">Kondisi Saat Dipinjam</th>
                                            <th scope="col" class="px-6 py-4 font-semibold">Update Kondisi Sekarang</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100 dark:divide-zinc-800/80">
                                        @foreach($borrowing->borrowingDetails as $detail)
                                            <tr class="hover:bg-gray-50/50 dark:hover:bg-zinc-800/20 transition">
                                                <td class="px-6 py-4 font-bold text-gray-900 dark:text-white">
                                                    {{ $detail->productInstance->kode_unik }}</td>
                                                <td class="px-6 py-4 text-gray-600 dark:text-zinc-300 font-medium">
                                                    {{ $detail->productInstance->product->nama_barang }}</td>
                                                <td class="px-6 py-4 text-gray-500 dark:text-zinc-400 font-medium">
                                                    {{ $detail->productInstance->kondisi_barang }}</td>
                                                <td class="px-6 py-4">
                                                    <select name="kondisi[{{ $detail->productInstance->id }}]"
                                                        class="block w-full border-gray-300 dark:border-zinc-700 dark:bg-[#131314] dark:text-zinc-300 focus:border-indigo-500 rounded-xl shadow-sm text-sm"
                                                        required>
                                                        <option value="Baik" {{ $detail->productInstance->kondisi_barang == 'Baik' ? 'selected' : '' }}>Baik</option>
                                                        <option value="Rusak Ringan" {{ $detail->productInstance->kondisi_barang == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                                                        <option value="Rusak Berat" {{ $detail->productInstance->kondisi_barang == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                                                    </select>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 mt-6 pt-4 border-t border-gray-100 dark:border-zinc-800">
                            <button type="submit"
                                class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2.5 px-5 rounded-xl text-sm shadow-md transition transform active:scale-95">
                                Selesaikan Pengembalian
                            </button>
                            <a href="{{ route('borrowings.index') }}"
                                class="text-gray-600 dark:text-zinc-400 hover:underline text-sm font-medium">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>