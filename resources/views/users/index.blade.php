<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-8">
        <div
            class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 pb-6 border-b border-gray-200/60 dark:border-zinc-800/80">
            <div>
                <div
                    class="flex items-center gap-2 text-xs uppercase font-bold tracking-wider text-gray-400 dark:text-zinc-500 mb-1.5">
                    <span>Beranda</span>
                    <span>/</span>
                    <span class="text-indigo-600 dark:text-white">Manajemen User</span>
                </div>
                <h2 class="text-2xl font-black text-gray-800 dark:text-zinc-100 tracking-tight">
                    Manajemen Otoritas Personil
                </h2>
            </div>
            <a href="{{ route('users.create') }}"
                class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2.5 px-5 rounded-xl text-sm shadow-md transition transform active:scale-95 shrink-0">
                + Daftarkan Personil Baru
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
                                <th scope="col" class="px-6 py-4 font-semibold">Nama Resmi</th>
                                <th scope="col" class="px-6 py-4 font-semibold">Alamat Surat Elektronik (Email)</th>
                                <th scope="col" class="px-6 py-4 font-semibold">Hak Otoritas (Role)</th>
                                <th scope="col" class="px-6 py-4 font-semibold text-right">Aksi Manajemen</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-zinc-800/80">
                            @foreach($users as $user)
                                <tr class="hover:bg-gray-50/50 dark:hover:bg-zinc-800/20 transition">
                                    <td class="px-6 py-4 font-bold text-gray-900 dark:text-white">{{ $user->name }}</td>
                                    <td class="px-6 py-4 text-gray-500 dark:text-zinc-400 font-mono text-xs">
                                        {{ $user->email }}</td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="px-2.5 py-1 rounded-lg text-xs font-bold {{ $user->role?->name == 'Admin' ? 'bg-rose-50 dark:bg-rose-950/20 text-rose-700 dark:text-rose-400 border border-rose-100 dark:border-rose-900/30' : ($user->role?->name == 'Manager' ? 'bg-purple-50 dark:bg-purple-950/20 text-purple-700 dark:text-purple-400 border border-purple-100 dark:border-purple-900/30' : 'bg-blue-50 dark:bg-blue-950/20 text-blue-700 dark:text-blue-400 border border-blue-100 dark:border-blue-900/30') }}">
                                            {{ $user->role?->name ?? 'Tanpa Otoritas' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right flex justify-end gap-3 items-center">
                                        <a href="{{ route('users.edit', $user->id) }}"
                                            class="text-amber-600 dark:text-amber-400 hover:text-amber-900 dark:hover:text-white text-xs font-semibold bg-amber-50 dark:bg-zinc-800 px-3 py-1.5 rounded-lg transition border dark:border-zinc-700">Edit</a>
                                        @if($user->id !== auth()->id())
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-white text-xs font-semibold bg-red-50 dark:bg-zinc-800 px-3 py-1.5 rounded-lg transition border dark:border-zinc-700">Hapus</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>