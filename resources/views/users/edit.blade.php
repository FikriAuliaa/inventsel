<x-app-layout>
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 pt-8">
        <div
            class="flex flex-col md:flex-row justify-between items-start md:items-center gap-2 pb-6 border-b border-gray-200/60 dark:border-zinc-800/80">
            <div>
                <div
                    class="flex items-center gap-2 text-xs uppercase font-bold tracking-wider text-gray-400 dark:text-zinc-500 mb-1.5">
                    <span>Beranda</span>
                    <span>/</span>
                    <span>Manajemen User</span>
                    <span>/</span>
                    <span class="text-indigo-600 dark:text-white">Edit</span>
                </div>
                <h2 class="text-2xl font-black text-gray-800 dark:text-zinc-100 tracking-tight">
                    Edit Otoritas Personil
                </h2>
            </div>
            <a href="{{ route('users.index') }}"
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
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-white dark:bg-[#1e1f20] rounded-2xl shadow-sm border border-gray-200/80 dark:border-zinc-800/80 p-8">
                <form action="{{ route('users.update', $user->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')
                    <div>
                        <label for="name"
                            class="block text-xs font-bold uppercase tracking-wider text-gray-600 dark:text-zinc-400 mb-2">Nama
                            Lengkap Resmi</label>
                        <input id="name" name="name" type="text"
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-[#131314] text-gray-900 dark:text-zinc-100 focus:border-indigo-500 focus:ring focus:ring-indigo-200/50 transition text-sm"
                            :value="old('name', $user->name)" required />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <div>
                        <label for="email"
                            class="block text-xs font-bold uppercase tracking-wider text-gray-600 dark:text-zinc-400 mb-2">Alamat
                            Email</label>
                        <input id="email" name="email" type="email"
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-[#131314] text-gray-900 dark:text-zinc-100 focus:border-indigo-500 focus:ring focus:ring-indigo-200/50 transition text-sm"
                            :value="old('email', $user->email)" required />
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />
                    </div>

                    <div>
                        <label for="role_id"
                            class="block text-xs font-bold uppercase tracking-wider text-gray-600 dark:text-zinc-400 mb-2">Hak
                            Otoritas (Role)</label>
                        <select id="role_id" name="role_id"
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-[#131314] text-gray-900 dark:text-zinc-100 focus:border-indigo-500 focus:ring focus:ring-indigo-200/50 transition text-sm"
                            required>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('role_id')" />
                    </div>

                    <div>
                        <label for="password"
                            class="block text-xs font-bold uppercase tracking-wider text-gray-600 dark:text-zinc-400 mb-2">Kata
                            Sandi Baru (Biarkan kosong jika tidak diganti)</label>
                        <input id="password" name="password" type="password"
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-[#131314] text-gray-900 dark:text-zinc-100 focus:border-indigo-500 focus:ring focus:ring-indigo-200/50 transition text-sm placeholder-gray-400 dark:placeholder-zinc-600"
                            placeholder="Isi hanya jika ingin mengubah sandi operasional user" />
                        <x-input-error class="mt-2" :messages="$errors->get('password')" />
                    </div>

                    <div class="pt-4 flex justify-end gap-3 border-t border-gray-100 dark:border-zinc-800">
                        <a href="{{ route('users.index') }}"
                            class="px-5 py-2.5 text-sm font-medium text-gray-600 dark:text-zinc-400 hover:text-gray-800 dark:hover:text-gray-200 transition">Batal</a>
                        <button type="submit"
                            class="px-6 py-2.5 text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 rounded-xl shadow-md transition transform active:scale-95">Perbarui
                            User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>