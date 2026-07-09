<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-8">
        <div
            class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 pb-6 border-b border-gray-200/60 dark:border-zinc-800/80">
            <div>
                <div
                    class="flex items-center gap-2 text-xs uppercase font-bold tracking-wider text-gray-400 dark:text-zinc-500 mb-1.5">
                    <span>Beranda</span>
                    <span>/</span>
                    <span class="text-indigo-600 dark:text-white">Peminjaman</span>
                </div>
                <h2 class="text-2xl font-black text-gray-800 dark:text-zinc-100 tracking-tight">
                    Data Log Peminjaman
                </h2>
            </div>
            <div class="flex flex-wrap gap-2.5">
                <a href="{{ route('borrowings.export.excel') }}"
                    class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-2 px-4 rounded-xl text-sm shadow-sm transition transform active:scale-95 flex items-center gap-2">
                    Excel
                </a>
                <a href="{{ route('borrowings.export.pdf') }}"
                    class="bg-rose-600 hover:bg-rose-700 text-white font-semibold py-2 px-4 rounded-xl text-sm shadow-sm transition transform active:scale-95 flex items-center gap-2">
                    PDF
                </a>
                <a href="{{ route('borrowings.create') }}"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2.5 px-5 rounded-xl text-sm shadow-md transition transform active:scale-95">
                    + Catat Log Pinjam Baru
                </a>
            </div>
        </div>
    </div>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div
                class="bg-white dark:bg-[#1e1f20] rounded-2xl p-5 shadow-sm border border-gray-200/80 dark:border-zinc-800/80">
                <form action="{{ route('borrowings.index') }}" method="GET"
                    class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                    <input type="hidden" name="order" value="{{ request('order', 'desc') }}">
                    <div class="md:col-span-2">
                        <label
                            class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-zinc-400 mb-2">Nama
                            Penanggung Jawab</label>
                        <input type="text" name="search" value="{{ request('search') }}"
                            class="w-full px-4 py-2 text-sm rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-[#131314] text-gray-900 dark:text-zinc-100 focus:border-indigo-500 focus:ring focus:ring-indigo-200/50 transition placeholder-gray-400 dark:placeholder-zinc-600"
                            placeholder="Ketik nama personil..." />
                    </div>
                    <div>
                        <label
                            class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-zinc-400 mb-2">Status
                            Alur</label>
                        <select name="status"
                            class="w-full px-4 py-2 text-sm rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-[#131314] text-gray-900 dark:text-zinc-100 focus:border-indigo-500 focus:ring focus:ring-indigo-200/50 transition">
                            <option value="">Semua Status</option>
                            <option value="Dipinjam" {{ request('status') == 'Dipinjam' ? 'selected' : '' }}>Dipinjam
                            </option>
                            <option value="Dikembalikan" {{ request('status') == 'Dikembalikan' ? 'selected' : '' }}>
                                Dikembalikan</option>
                        </select>
                    </div>
                    <div>
                        <button type="submit"
                            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 rounded-xl text-sm transition transform active:scale-95 shadow-sm">
                            Filter Log
                        </button>
                    </div>
                </form>
            </div>

            <div
                class="bg-white dark:bg-[#1e1f20] rounded-2xl shadow-sm border border-gray-200/80 dark:border-zinc-800/80 overflow-hidden">
                <div class="p-6 text-gray-800 dark:text-zinc-200 overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-600 dark:text-zinc-400 align-middle">
                        <thead
                            class="text-xs text-gray-700 dark:text-zinc-300 uppercase bg-gray-50/70 dark:bg-[#131314]/50 border-b border-gray-200/80 dark:border-zinc-800/80">
                            <tr>
                                <th scope="col" class="px-6 py-4 font-semibold">Nama Penanggung Jawab</th>
                                <th scope="col" class="px-6 py-4 font-semibold">
                                    <a href="{{ route('borrowings.index', array_merge(request()->query(), ['order' => request('order', 'desc') == 'desc' ? 'asc' : 'desc'])) }}"
                                        class="flex items-center gap-1.5 hover:text-indigo-600 dark:hover:text-white transition">
                                        Tgl Ambil
                                        {!! request('order', 'desc') == 'desc' ? '↓' : '↑' !!}
                                    </a>
                                </th>
                                <th scope="col" class="px-6 py-4 font-semibold">Tgl Kembali</th>
                                <th scope="col" class="px-6 py-4 font-semibold">Unit Barang (Kode Unik)</th>
                                <th scope="col" class="px-6 py-4 font-semibold">Status Alur</th>
                                <th scope="col" class="px-6 py-4 font-semibold text-right">Aksi Operasional</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-zinc-800/80">
                            @forelse($borrowings as $borrowing)
                                <tr class="hover:bg-gray-50/50 dark:hover:bg-zinc-800/20 transition">
                                    <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                        {{ $borrowing->user->name }}</td>
                                    <td class="px-6 py-4 text-gray-600 dark:text-zinc-300 font-medium">
                                        {{ \Carbon\Carbon::parse($borrowing->tanggal_pinjam)->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4 text-gray-600 dark:text-zinc-300 font-medium">
                                        {{ $borrowing->tanggal_kembali ? \Carbon\Carbon::parse($borrowing->tanggal_kembali)->format('d/m/Y') : '-' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col gap-1">
                                            @foreach($borrowing->borrowingDetails as $detail)
                                                <span class="text-xs text-gray-800 dark:text-zinc-200 font-medium">
                                                    • {{ $detail->productInstance->product->nama_barang }} <span
                                                        class="font-mono text-indigo-600 dark:text-indigo-400 font-bold">({{ $detail->productInstance->kode_unik }})</span>
                                                </span>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="px-2.5 py-1 rounded-lg text-xs font-semibold {{ $borrowing->status == 'Dikembalikan' ? 'bg-emerald-50 dark:bg-emerald-950/20 text-emerald-700 dark:text-emerald-400' : 'bg-amber-50 dark:bg-amber-950/20 text-amber-700 dark:text-amber-400' }}">
                                            {{ $borrowing->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex justify-end items-center w-full">
                                            @if($borrowing->status == 'Dipinjam')
                                                <a href="{{ route('borrowings.return', $borrowing->id) }}"
                                                    class="inline-flex justify-center items-center bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold px-4 py-2.5 rounded-xl shadow-sm transition whitespace-nowrap">
                                                    Proses Kembali
                                                </a>
                                            @else
                                                <span
                                                    class="text-gray-400 dark:text-zinc-500 font-medium text-xs whitespace-nowrap">Selesai
                                                    / Terarsip</span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-8 text-center text-gray-400 dark:text-zinc-500">Tidak ada
                                        riwayat operasional log yang sesuai kriteria kueri.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4 px-2">
                        {{ $borrowings->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>