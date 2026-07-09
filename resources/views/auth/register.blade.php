<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>INVENTSEL - Registrasi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-[#f8f9fa] text-gray-800 min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-sm border border-gray-200/80 overflow-hidden">
        <div class="bg-indigo-600/5 p-6 border-b border-gray-100 text-center">
            <h2 class="text-2xl font-black tracking-widest text-indigo-600">INVENTSEL</h2>
            <p class="text-xs text-gray-400 mt-1">Registrasi Akun Personil Baru</p>
        </div>

        <div class="p-8 space-y-4">
            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf
                <div>
                    <label for="name" class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-1.5">Nama
                        Lengkap</label>
                    <input id="name" type="text" name="name" :value="old('name')" required autofocus
                        class="w-full px-3 py-2 text-sm rounded-xl border border-gray-300 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500/30 transition shadow-sm"
                        placeholder="Nama Lengkap" />
                    <x-input-error :messages="$errors->get('name')" class="mt-1" />
                </div>

                <div>
                    <label for="email"
                        class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-1.5">Alamat
                        Email</label>
                    <input id="email" type="email" name="email" :value="old('email')" required
                        class="w-full px-3 py-2 text-sm rounded-xl border border-gray-300 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500/30 transition shadow-sm"
                        placeholder="nama@email.com" />
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>

                <div>
                    <label for="password"
                        class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-1.5">Kata Sandi</label>
                    <input id="password" type="password" name="password" required
                        class="w-full px-3 py-2 text-sm rounded-xl border border-gray-300 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500/30 transition shadow-sm"
                        placeholder="••••••••" />
                    <x-input-error :messages="$errors->get('password')" class="mt-1" />
                </div>

                <div>
                    <label for="password_confirmation"
                        class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-1.5">Konfirmasi Kata
                        Sandi</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                        class="w-full px-3 py-2 text-sm rounded-xl border border-gray-300 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500/30 transition shadow-sm"
                        placeholder="••••••••" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                </div>

                <div class="flex items-center justify-between pt-2">
                    <a href="{{ route('login') }}" class="text-xs font-semibold text-indigo-600 hover:underline">Sudah
                        punya akun?</a>
                    <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-5 rounded-xl text-sm transition transform active:scale-95 shadow-md shadow-indigo-100">
                        Daftar Akun
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>