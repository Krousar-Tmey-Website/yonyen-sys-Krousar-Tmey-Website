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
                @php
                $logoPath = $settings['site_logo'] ?? 'images/logo.png';
                $logoUrl = str_starts_with($logoPath, 'http') ? $logoPath : (str_starts_with($logoPath, 'logos/') ? asset('storage/' . $logoPath) : asset($logoPath));
                $siteName = $settings['site_name'] ?? 'Krousar Thmey';
                $siteTagline = $settings['site_tagline'] ?? 'គ្រួសារថ្មី · New Family';
                @endphp
                <img src="{{ $logoUrl }}"
                    alt="{{ $siteName }}"
                    class="h-12 lg:h-14 w-auto object-contain"
                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                {{-- Fallback if image not yet placed --}}
                <div class="hidden items-center gap-3">
                    <div class="w-10 h-10 lg:w-12 lg:h-12 rounded-xl bg-[#2d6fa3] flex items-center justify-center">
                        <span class="text-white font-bold text-lg">KT</span>
                    </div>
                    <div>
                        <div class="text-[#2d6fa3] font-bold text-lg leading-tight">{{ $siteName }}</div>
                        <div class="text-[#8da83a] text-xs font-medium">{{ $siteTagline }}</div>
                    </div>
                </div>
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
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        placeholder="admin@krousar-thmey.org"
                        class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3.5 text-sm text-gray-800 placeholder:text-gray-400 shadow-sm transition-all duration-200 focus:border-[#2d6fa3] focus:bg-white focus:ring-4 focus:ring-[#2d6fa3]/10 focus:outline-none @error('email') border-red-400 ring-2 ring-red-100 @enderror">
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1.5">
                        Password
                    </label>

                    <div class="space-y-3">
                        <input
                            id="password"
                            name="password"
                            type="password"
                            required
                            autocomplete="current-password"
                            placeholder="Enter your password"
                            class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3.5 text-sm text-gray-800 placeholder:text-gray-400 shadow-sm transition-all duration-200 focus:border-[#2d6fa3] focus:bg-white focus:ring-4 focus:ring-[#2d6fa3]/10 focus:outline-none">
                        <label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer select-none">
                            <input
                                type="checkbox"
                                id="showPassword"
                                class="h-4 w-4 rounded border-gray-300 text-[#2d6fa3] focus:ring-[#2d6fa3]">
                            Show password
                        </label>
                    </div>

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

    <script>
        document.getElementById('showPassword').addEventListener('change', function() {
            const password = document.getElementById('password');
            password.type = this.checked ? 'text' : 'password';
        });
    </script>
</body>

</html>