<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — {{ $settings['site_name'] ?? 'Krousar Thmey' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#1d4e7a] flex items-center justify-center p-4 font-sans text-white">

    <div class="w-full max-w-5xl rounded-[2.5rem] shadow-2xl overflow-hidden border border-white/10 flex flex-col md:flex-row relative bg-white/5 backdrop-blur-sm">
        
        {{-- Left Side: Branding --}}
        <div class="relative w-full md:w-[55%] p-10 lg:p-16 flex flex-col items-center justify-center text-center overflow-hidden min-h-[450px]">
            @php
            $logoPath = $settings['site_logo'] ?? 'images/logo.png';
            $logoUrl = str_starts_with($logoPath, 'http') ? $logoPath : (str_starts_with($logoPath, 'logos/') ? asset('storage/' . $logoPath) : asset($logoPath));
            $siteName = $settings['site_name'] ?? 'Krousar Thmey';
            $siteTagline = $settings['site_tagline'] ?? 'គ្រួសារថ្មី · New Family';
            
            // Background Image
            $bgImage = asset('images/login-imag.png');
            @endphp
            
            {{-- Photographic Background --}}
            <div class="absolute inset-0 z-0">
                <img src="{{ $bgImage }}" class="w-full h-full object-cover" alt="Background">
            </div>
        </div>

        {{-- Right Side: Form --}}
        <div class="w-full md:w-[45%] p-4 lg:p-6 relative flex items-center">
            <div class="w-full h-full bg-gradient-to-br from-[#0c4033] via-[#1a2c4c] to-[#252f5a] rounded-[2rem] p-8 lg:p-10 flex flex-col justify-center shadow-lg relative overflow-hidden">
                
                <div class="relative z-10">
                    <div class="text-center mb-8 flex flex-col items-center">
                        <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center shadow-xl mb-6 p-2 ring-4 ring-white/10 backdrop-blur-sm">
                            <img src="{{ $logoUrl }}" alt="{{ $siteName }}" class="w-full h-full object-contain">
                        </div>
                        <h2 class="text-3xl font-extrabold text-white mb-2 tracking-tight">Login</h2>
                        <p class="text-[#4ade80] text-[10px] font-bold tracking-[0.2em] uppercase">Access Admin Panel</p>
                    </div>

                    @if($errors->any())
                    <div class="bg-red-500/10 border border-red-500/50 text-red-200 text-sm px-4 py-3 rounded-xl mb-6 text-center shadow-inner">
                        {{ $errors->first() }}
                    </div>
                    @endif

                    @if(session('success'))
                    <div class="bg-green-500/10 border border-green-500/50 text-green-200 text-sm px-4 py-3 rounded-xl mb-6 text-center shadow-inner">
                        {{ session('success') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('admin.login.post') }}" class="space-y-5">
                        @csrf

                        <div>
                            <label for="email" class="block text-xs font-bold text-white mb-2">Email</label>
                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                placeholder="Enter your email"
                                class="w-full rounded-xl border border-transparent bg-[#080b09]/60 px-4 py-3.5 text-sm text-white placeholder:text-white/30 transition-all duration-200 focus:border-[#4ade80] focus:bg-[#080b09]/80 focus:ring-1 focus:ring-[#4ade80] focus:outline-none">
                        </div>

                        <div>
                            <label for="password" class="block text-xs font-bold text-white mb-2">Password</label>
                            <div class="relative">
                                <input
                                    id="password"
                                    name="password"
                                    type="password"
                                    required
                                    autocomplete="current-password"
                                    placeholder="Enter your password"
                                    class="w-full rounded-xl border border-transparent bg-[#080b09]/60 px-4 py-3.5 text-sm text-white placeholder:text-white/30 transition-all duration-200 focus:border-[#4ade80] focus:bg-[#080b09]/80 focus:ring-1 focus:ring-[#4ade80] focus:outline-none pr-10">
                                <button type="button" id="togglePassword" class="absolute right-4 top-1/2 -translate-y-1/2 text-white/30 hover:text-white/60 focus:outline-none transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path id="eyeIcon" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="flex items-center pt-1">
                            <label class="flex items-center gap-2 text-xs text-white/70 cursor-pointer select-none">
                                <input
                                    type="checkbox"
                                    name="remember"
                                    class="h-4 w-4 rounded border-white/10 bg-[#080b09]/60 text-[#4ade80] focus:ring-[#4ade80] focus:ring-offset-0 focus:ring-offset-transparent">
                                Remember Me
                            </label>
                        </div>

                        <button type="submit"
                            class="w-full bg-gradient-to-r from-[#4ade80] to-[#fde68a] hover:from-[#22c55e] hover:to-[#fcd34d] text-[#0a2e1d] font-extrabold py-3.5 rounded-xl transition-all shadow-[0_0_20px_rgba(74,222,128,0.2)] hover:shadow-[0_0_25px_rgba(74,222,128,0.4)] text-sm mt-4">
                            Login
                        </button>
                    </form>
                    
                    <p class="text-center mt-8">
                        <a href="{{ route('home') }}" class="text-xs text-white/30 hover:text-white/60 transition-colors">← Back to website</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const password = document.getElementById('password');
            const icon = document.getElementById('eyeIcon');
            if (password.type === 'password') {
                password.type = 'text';
                icon.setAttribute('d', 'M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21');
            } else {
                password.type = 'password';
                icon.setAttribute('d', 'M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z');
            }
        });
    </script>
</body>

</html>