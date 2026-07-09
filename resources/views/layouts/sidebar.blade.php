<aside
    class="w-64 h-screen bg-white dark:bg-[#1e1f20] text-gray-600 dark:text-gray-300 fixed top-0 left-0 z-50 flex flex-col border-r border-gray-200/80 dark:border-zinc-800/80 font-sans shadow-sm">
    <div
        class="h-16 flex items-center px-6 bg-gray-50/50 dark:bg-[#1e1f20] border-b border-gray-200/80 dark:border-zinc-800/80 shrink-0">
        <a href="{{ route('dashboard') }}" class="transition hover:opacity-85">
            <span class="font-extrabold text-xl tracking-wider text-gray-900 dark:text-white">
                INVENTSEL
            </span>
        </a>
    </div>

    <nav class="flex-1 py-6 px-4 space-y-1 overflow-y-auto">
        <p class="text-[11px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest px-3 mb-3">Menu Utama
        </p>

        <a href="{{ route('dashboard') }}"
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition group {{ request()->routeIs('dashboard') ? 'bg-indigo-50 dark:bg-zinc-800/60 text-indigo-600 dark:text-white font-semibold border border-indigo-100/50 dark:border-zinc-700/50' : 'hover:bg-gray-50 dark:hover:bg-zinc-800/40 hover:text-gray-900 dark:hover:text-white' }}">
            <svg class="w-5 h-5 {{ request()->routeIs('dashboard') ? 'text-indigo-600 dark:text-white' : 'text-gray-400 dark:text-gray-400 group-hover:text-gray-600 dark:group-hover:text-gray-200' }}"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12h18M3 6h18M3 18h18">
                </path>
            </svg>
            Dashboard
        </a>

        @if(Auth::user()->role?->name === 'Admin' || Auth::user()->role?->name === 'Staff')
            <p class="text-[11px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest px-3 pt-4 mb-3">
                Logistik</p>

            <a href="{{ route('categories.index') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition group {{ request()->routeIs('categories.*') ? 'bg-indigo-50 dark:bg-zinc-800/60 text-indigo-600 dark:text-white font-semibold border border-indigo-100/50 dark:border-zinc-700/50' : 'hover:bg-gray-50 dark:hover:bg-zinc-800/40 hover:text-gray-900 dark:hover:text-white' }}">
                <svg class="w-5 h-5 {{ request()->routeIs('categories.*') ? 'text-indigo-600 dark:text-white' : 'text-gray-400 dark:text-gray-400 group-hover:text-gray-600 dark:group-hover:text-gray-200' }}"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2z"></path>
                </svg>
                Kategori
            </a>

            <a href="{{ route('products.index') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition group {{ request()->routeIs('products.*') ? 'bg-indigo-50 dark:bg-zinc-800/60 text-indigo-600 dark:text-white font-semibold border border-indigo-100/50 dark:border-zinc-700/50' : 'hover:bg-gray-50 dark:hover:bg-zinc-800/40 hover:text-gray-900 dark:hover:text-white' }}">
                <svg class="w-5 h-5 {{ request()->routeIs('products.*') ? 'text-indigo-600 dark:text-white' : 'text-gray-400 dark:text-gray-400 group-hover:text-gray-600 dark:group-hover:text-gray-200' }}"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg>
                Master Barang
            </a>

            <a href="{{ route('borrowings.index') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition group {{ request()->routeIs('borrowings.*') ? 'bg-indigo-50 dark:bg-zinc-800/60 text-indigo-600 dark:text-white font-semibold border border-indigo-100/50 dark:border-zinc-700/50' : 'hover:bg-gray-50 dark:hover:bg-zinc-800/40 hover:text-gray-900 dark:hover:text-white' }}">
                <svg class="w-5 h-5 {{ request()->routeIs('borrowings.*') ? 'text-indigo-600 dark:text-white' : 'text-gray-400 dark:text-gray-400 group-hover:text-gray-600 dark:group-hover:text-gray-200' }}"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Peminjaman
            </a>
        @endif

        @if(Auth::user()->role?->name === 'Admin')
            <p class="text-[11px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest px-3 pt-4 mb-3">
                Pengaturan</p>

            <a href="{{ route('users.index') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition group {{ request()->routeIs('users.*') ? 'bg-indigo-50 dark:bg-zinc-800/60 text-indigo-600 dark:text-white font-semibold border border-indigo-100/50 dark:border-zinc-700/50' : 'hover:bg-gray-50 dark:hover:bg-zinc-800/40 hover:text-gray-900 dark:hover:text-white' }}">
                <svg class="w-5 h-5 {{ request()->routeIs('users.*') ? 'text-indigo-600 dark:text-white' : 'text-gray-400 dark:text-gray-400 group-hover:text-gray-600 dark:group-hover:text-gray-200' }}"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                    </path>
                </svg>
                Manajemen User
            </a>
        @endif
    </nav>
</aside>