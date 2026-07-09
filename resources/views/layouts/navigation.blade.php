<nav
    class="bg-white dark:bg-[#1e1f20] border-b border-gray-200/80 dark:border-zinc-800/80 h-16 flex items-center justify-end px-6 md:px-8 shrink-0 sticky top-0 z-40 shadow-sm transition-colors duration-200">
    <div class="flex items-center gap-5">

        @php
            $navStokMenipis = \App\Models\Product::where('stok', '<=', 3)->get();
        @endphp

        <x-dropdown align="right" width="64">
            <x-slot name="trigger">
                <button type="button"
                    class="text-gray-500 dark:text-zinc-400 hover:text-gray-700 dark:hover:text-zinc-200 p-1.5 rounded-lg hover:bg-gray-50 dark:hover:bg-zinc-800/40 transition relative"
                    title="Notifikasi Stok">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                        </path>
                    </svg>
                    @if($navStokMenipis->count() > 0)
                        <span
                            class="absolute top-1.5 right-1.5 block h-2 w-2 rounded-full bg-rose-500 ring-2 ring-white dark:ring-[#1e1f20]"></span>
                    @endif
                </button>
            </x-slot>

            <x-slot name="content">
                <div class="px-4 py-2 border-b border-gray-100 dark:border-zinc-800 bg-gray-50/50 dark:bg-[#131314]/50">
                    <p class="text-xs font-bold text-gray-700 dark:text-zinc-300 uppercase tracking-wider">Notifikasi
                        Logistik</p>
                </div>
                <div class="max-h-60 overflow-y-auto divide-y divide-gray-100 dark:divide-zinc-800">
                    @forelse($navStokMenipis as $notifItem)
                        <div class="px-4 py-3 hover:bg-gray-50 dark:hover:bg-zinc-800/40 transition flex flex-col gap-0.5">
                            <span class="text-xs font-bold text-amber-600 dark:text-amber-400">Stok Menipis!</span>
                            <span
                                class="text-xs font-medium text-gray-800 dark:text-zinc-200">{{ $notifItem->nama_barang }}</span>
                            <span class="text-[10px] text-gray-400 dark:text-zinc-500">Tersisa {{ $notifItem->stok }} unit
                                di {{ $notifItem->lokasi_penyimpanan }}</span>
                        </div>
                    @empty
                        <div class="px-4 py-4 text-center text-xs text-gray-400 dark:text-zinc-500">
                            Semua kuantitas stok aman terjamin.
                        </div>
                    @endforelse
                </div>
            </x-slot>
        </x-dropdown>

        <button type="button" id="themeSwitcher"
            class="text-gray-500 dark:text-zinc-400 hover:text-gray-700 dark:hover:text-zinc-200 p-1.5 rounded-lg hover:bg-gray-50 dark:hover:bg-zinc-800/40 transition"
            title="Ubah Tema Warna">
            <svg id="themeIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg"></svg>
        </button>

        <div class="h-6 w-px bg-gray-200 dark:bg-zinc-800"></div>

        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button
                    class="inline-flex items-center gap-3 border border-transparent text-sm font-semibold rounded-xl text-gray-600 dark:text-zinc-300 hover:text-gray-900 dark:hover:text-white focus:outline-none transition duration-150 ease-in-out">
                    <div class="hidden md:block text-right">
                        <p class="text-sm font-semibold text-gray-700 dark:text-zinc-200 leading-none">
                            {{ Auth::user()->name }}
                        </p>
                        <p class="text-xs text-indigo-600 dark:text-indigo-400 font-medium mt-1 leading-none">
                            {{ Auth::user()->role?->name ?? 'User' }}
                        </p>
                    </div>
                    <div class="relative">
                        <div
                            class="w-9 h-9 bg-gradient-to-tr from-indigo-500 to-blue-500 text-white rounded-full flex items-center justify-center text-sm font-bold uppercase shadow-sm border border-white dark:border-[#1e1f20]">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <span
                            class="absolute bottom-0 right-0 block h-2.5 w-2.5 rounded-full bg-emerald-400 ring-2 ring-white dark:ring-[#1e1f20]"></span>
                    </div>
                </button>
            </x-slot>

            <x-slot name="content">
                <x-dropdown-link :href="route('profile.edit')">
                    {{ __('My Profile') }}
                </x-dropdown-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();"
                        class="text-red-600 hover:bg-red-50 dark:hover:bg-red-950/30 font-medium">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const themeBtn = document.getElementById('themeSwitcher');
        const themeIcon = document.getElementById('themeIcon');
        const htmlEl = document.documentElement;

        const sunSvg = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 11H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.343l-.707-.707M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>`;
        const moonSvg = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>`;

        if (htmlEl.classList.contains('dark')) {
            themeIcon.innerHTML = moonSvg;
        } else {
            themeIcon.innerHTML = sunSvg;
        }

        themeBtn.addEventListener('click', function () {
            if (htmlEl.classList.contains('dark')) {
                htmlEl.classList.remove('dark');
                themeIcon.innerHTML = sunSvg;
                localStorage.setItem('skote-theme', 'light');
            } else {
                htmlEl.classList.add('dark');
                themeIcon.innerHTML = moonSvg;
                localStorage.setItem('skote-theme', 'dark');
            }
        });
    });
</script>