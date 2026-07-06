<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — Krousar Thmey</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#1d4e7a] flex items-center justify-center p-4">

<div class="w-full max-w-sm">
    {{-- Logo --}}
    <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center bg-white rounded-2xl p-4 shadow-xl mb-5">
            <img src="{{ asset('images/logo.png') }}" alt="Krousar Thmey" class="h-16 w-auto"
                 onerror="this.parentElement.innerHTML='<span class=\'text-[#2d6fa3] font-black text-2xl\'>KT</span>'">
        </div>
        <h1 class="text-white font-bold text-2xl">Krousar Thmey</h1>
        <p class="text-white/50 text-sm mt-1">Admin Panel</p>
    </div>

    {{-- Card --}}
    <div class="bg-white rounded-3xl shadow-2xl p-8">
        <h2 class="text-xl font-bold text-gray-800 mb-6">Sign in</h2>

        @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3 rounded-xl mb-5">
            {{ $errors->first() }}
        </div>
        @endif

        @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 text-sm px-4 py-3 rounded-xl mb-5">
            {{ session('success') }}
        </div>
        @endif

        <form method="POST" action="{{ route('admin.login.post') }}" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1.5">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] transition-colors @error('email') border-red-300 @enderror"
                       placeholder="admin@krousar-thmey.org">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1.5">Password</label>
                <input id="password" type="password" name="password" required
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] transition-colors"
                       placeholder="••••••••">
            </div>

            <div class="flex items-center gap-2">
                <input id="remember" type="checkbox" name="remember" class="rounded border-gray-300 text-[#2d6fa3]">
                <label for="remember" class="text-sm text-gray-500">Remember me</label>
            </div>

            <button type="submit"
                    class="w-full bg-[#2d6fa3] hover:bg-[#1d4e7a] text-white font-semibold py-3 rounded-xl transition-colors text-sm">
                Sign In
            </button>
        </form>
    </div>

    <p class="text-center text-white/30 text-xs mt-6">
        <a href="{{ route('home') }}" class="hover:text-white/60 transition-colors">← Back to website</a>
    </p>
</div>

</body>
</html>
