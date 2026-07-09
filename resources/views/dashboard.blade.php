<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-8">
        <div
            class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 pb-6 border-b border-gray-200/60 dark:border-zinc-800/80">
            <div>
                <div
                    class="flex items-center gap-2 text-xs uppercase font-bold tracking-wider text-gray-400 dark:text-gray-500 mb-1.5">
                    <span>Beranda</span>
                    <span>/</span>
                    <span class="text-indigo-600 dark:text-indigo-400">Dasbor Utama</span>
                </div>
                <h2 class="text-2xl font-black text-gray-800 dark:text-gray-100 tracking-tight">
                    Ringkasan Dasbor Sistem
                </h2>
            </div>
        </div>
    </div>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @php
                $stokMenipis = \App\Models\Product::where('stok', '<=', 3)->get();
            @endphp

            @if($stokMenipis->count() > 0)
                <div
                    class="bg-amber-50 dark:bg-amber-950/20 border border-amber-200 dark:border-amber-900/30 rounded-2xl p-4 flex items-start gap-3 shadow-sm animate-pulse">
                    <div class="text-amber-500 mt-0.5 shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-amber-800 dark:text-amber-400">Peringatan: Stok Aset Menipis!</h4>
                        <p class="text-xs text-amber-700 dark:text-amber-500/90 mt-0.5">Beberapa katalog logistik di bawah
                            ini memiliki kuantitas kritis dan membutuhkan restok segera:</p>
                        <div class="mt-2 flex flex-wrap gap-2">
                            @foreach($stokMenipis as $item)
                                <span
                                    class="bg-white dark:bg-[#131314] text-amber-800 dark:text-amber-400 border border-amber-200 dark:border-amber-900/30 text-[11px] font-semibold px-2.5 py-1 rounded-lg">
                                    {{ $item->nama_barang }} (Sisa: {{ $item->stok }} Unit)
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                <div
                    class="bg-white dark:bg-[#131314] rounded-xl shadow-sm border border-gray-200/70 dark:border-zinc-800/80 p-5 flex flex-col justify-between h-36 relative overflow-hidden transition-all duration-200 hover:shadow-md">
                    <div>
                        <p class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Total
                            Barang</p>
                        <h3 class="text-3xl font-bold text-gray-800 dark:text-white mt-2 tracking-tight">
                            {{ $totalBarang }}
                        </h3>
                    </div>
                    <div class="mt-2">
                        <a href="{{ route('products.index') }}"
                            class="text-xs font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 hover:underline transition">
                            Lihat semua katalog
                        </a>
                    </div>
                    <div
                        class="absolute bottom-5 right-5 w-11 h-11 bg-indigo-50 dark:bg-zinc-800/50 rounded-xl flex items-center justify-center border border-indigo-100/50 dark:border-zinc-700/50 shadow-inner">
                        <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                </div>

                <div
                    class="bg-white dark:bg-[#131314] rounded-xl shadow-sm border border-gray-200/70 dark:border-zinc-800/80 p-5 flex flex-col justify-between h-36 relative overflow-hidden transition-all duration-200 hover:shadow-md">
                    <div>
                        <p class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Barang
                            Tersedia</p>
                        <h3 class="text-3xl font-bold text-emerald-600 dark:text-emerald-400 mt-2 tracking-tight">
                            {{ $barangTersedia }}
                        </h3>
                    </div>
                    <div class="mt-2">
                        <span class="text-xs font-medium text-gray-400 dark:text-gray-500 cursor-default">
                            Unit siap digunakan
                        </span>
                    </div>
                    <div
                        class="absolute bottom-5 right-5 w-11 h-11 bg-emerald-50 dark:bg-zinc-800/50 rounded-xl flex items-center justify-center border border-emerald-100/50 dark:border-zinc-700/50 shadow-inner">
                        <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>

                <div
                    class="bg-white dark:bg-[#131314] rounded-xl shadow-sm border border-gray-200/70 dark:border-zinc-800/80 p-5 flex flex-col justify-between h-36 relative overflow-hidden transition-all duration-200 hover:shadow-md">
                    <div>
                        <p class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Sedang
                            Dipinjam</p>
                        <h3 class="text-3xl font-bold text-amber-500 dark:text-amber-400 mt-2 tracking-tight">
                            {{ $barangDipinjam }}
                        </h3>
                    </div>
                    <div class="mt-2">
                        <a href="{{ route('borrowings.index') }}"
                            class="text-xs font-medium text-amber-600 dark:text-amber-400 hover:text-amber-800 dark:hover:text-amber-300 hover:underline transition">
                            Pantau log aktif
                        </a>
                    </div>
                    <div
                        class="absolute bottom-5 right-5 w-11 h-11 bg-amber-50 dark:bg-zinc-800/50 rounded-xl flex items-center justify-center border border-amber-100/50 dark:border-zinc-700/50 shadow-inner">
                        <svg class="w-5 h-5 text-amber-500 dark:text-amber-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>

            </div>

            <div
                class="bg-white dark:bg-[#131314] rounded-2xl shadow-sm border border-gray-200/80 dark:border-zinc-800/80 overflow-hidden">
                <div
                    class="p-6 border-b border-gray-100 dark:border-zinc-800 flex justify-between items-center bg-gray-50/40 dark:bg-[#131314]/50">
                    <h3 class="text-base font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
                        <svg class="w-4 h-4 text-indigo-500 dark:text-indigo-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z">
                            </path>
                        </svg>
                        Statistik Transaksi Peminjaman {{ date('Y') }}
                    </h3>
                </div>
                <div class="p-6">
                    <div class="w-full relative" style="height: 380px;">
                        <canvas id="borrowingChart"></canvas>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const ctx = document.getElementById('borrowingChart').getContext('2d');
                const chartData = @json($chartData);
                const isDark = document.documentElement.classList.contains('dark');

                const chart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'],
                        datasets: [{
                            label: 'Total Transaksi',
                            data: chartData,
                            backgroundColor: 'rgba(226, 6, 19, 0.85)',
                            hoverBackgroundColor: 'rgba(184, 4, 14, 1)',
                            borderRadius: 6,
                            barThickness: 24,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false }
                        },
                        scales: {
                            x: {
                                grid: { display: false },
                                ticks: { color: isDark ? '#9ca3af' : '#6b7280', font: { weight: '500', size: 11 } }
                            },
                            y: {
                                beginAtZero: true,
                                ticks: { precision: 0, color: isDark ? '#9ca3af' : '#6b7280', font: { size: 11 } },
                                grid: { color: isDark ? '#2a2b36' : '#f3f4f6' }
                            }
                        }
                    }
                });

                const observer = new MutationObserver(function (mutations) {
                    mutations.forEach(function (mutation) {
                        if (mutation.attributeName === 'class') {
                            const currentDark = document.documentElement.classList.contains('dark');
                            chart.options.scales.x.ticks.color = currentDark ? '#9ca3af' : '#6b7280';
                            chart.options.scales.y.ticks.color = currentDark ? '#9ca3af' : '#6b7280';
                            chart.options.scales.y.grid.color = currentDark ? '#2a2b36' : '#f3f4f6';
                            chart.update();
                        }
                    });
                });
                observer.observe(document.documentElement, { attributes: true });
            });
        </script>
    @endpush
</x-app-layout>