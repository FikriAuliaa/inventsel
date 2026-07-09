<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>INVENTSEL - Login</title>
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
            <p class="text-xs text-gray-400 mt-1">Sistem Manajemen Inventaris PT Telkomsel</p>
        </div>

        <div class="p-8 space-y-5">
            @if (session('status'))
                <div
                    class="bg-indigo-50 border border-indigo-200 text-indigo-700 px-4 py-2.5 rounded-xl text-xs font-medium">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf
                <div>
                    <label for="email"
                        class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-1.5">Alamat
                        Email</label>
                    <input id="email" type="email" name="email" :value="old('email')" required autofocus
                        class="w-full px-3 py-2 text-sm rounded-xl border border-gray-300 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500/30 transition placeholder-gray-400 shadow-sm"
                        placeholder="nama@email.com" />
                    @if ($errors->get('email'))
                        <p class="text-xs text-red-600 mt-1">{{ $errors->first('email') }}</p>
                    @endif
                </div>

                <div>
                    <div class="flex justify-between items-center mb-1.5">
                        <label for="password"
                            class="block text-xs font-bold uppercase tracking-wider text-gray-500">Kata Sandi</label>
                        @if (Route::has('password.request'))
                            <a class="text-xs font-semibold text-indigo-600 hover:underline"
                                href="{{ route('password.request') }}">Lupa?</a>
                        @endif
                    </div>
                    <input id="password" type="password" name="password" required
                        class="w-full px-3 py-2 text-sm rounded-xl border border-gray-300 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500/30 transition placeholder-gray-400 shadow-sm"
                        placeholder="••••••••" />
                    @if ($errors->get('password'))
                        <p class="text-xs text-red-600 mt-1">{{ $errors->first('password') }}</p>
                    @endif
                </div>

                <div class="flex items-center justify-between pt-1">
                    <div class="flex items-center">
                        <input id="remember_me" type="checkbox" name="remember"
                            class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500 transition">
                        <label for="remember_me" class="ms-2 text-xs font-medium text-gray-600 cursor-pointer">Ingat
                            saya</label>
                    </div>

                    {{-- Mengamankan tombol register dengan validasi rute dinamis --}}
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="text-xs font-semibold text-indigo-600 hover:underline">Daftar Akun</a>
                    @endif
                </div>

                <button type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2.5 px-4 rounded-xl text-sm transition transform active:scale-95 shadow-md shadow-indigo-100 mt-2">
                    Masuk ke Akun
                </button>
            </form>
        </div>
    </div>

</body>

</html>