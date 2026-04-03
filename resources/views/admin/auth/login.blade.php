<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | BPR Asset</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900">

<div class="min-h-screen flex flex-col items-center justify-center p-6">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <div class="flex justify-center mb-4">
                <img src="{{ asset('images/logobpr.png') }}" alt="Logo BPR NTB" class="h-16 w-auto">
            </div>
            <h2 class="text-3xl font-bold tracking-tight text-slate-800">Admin Login BPR</h2>
            <p class="text-slate-500 mt-2">Sistem Pengelolaan Asset</p>
        </div>

        <div class="bg-white p-8 rounded-3xl shadow-xl shadow-slate-200/60 border border-slate-100">
            @if (session('success'))
                <div class="mb-4 rounded-xl bg-emerald-50 border border-emerald-100 text-emerald-700 text-sm px-4 py-3">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-100 text-red-600 text-sm">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login') }}" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5 ml-1">Username</label>
                    <input 
                        type="text" 
                        name="username" 
                        value="{{ old('username') }}" 
                        required 
                        autofocus
                        class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200"
                        placeholder="Masukkan username anda"
                    >
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5 ml-1">Password</label>
                    <div class="relative group">
                        <input 
                            id="password"
                            type="password" 
                            name="password" 
                            required 
                            class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200"
                            placeholder="••••••••"
                        >
                        <button 
                            type="button"
                            onclick="togglePassword()"
                            class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-slate-600 transition-colors"
                        >
                            <i id="eye-icon" data-lucide="eye" class="w-5 h-5"></i>
                        </button>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center cursor-pointer group">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                        <span class="ml-2 text-sm text-slate-600 group-hover:text-slate-800 transition-colors">Ingat saya</span>
                    </label>
                </div>

                <button 
                    type="submit" 
                    class="w-full bg-slate-900 hover:bg-slate-800 text-white font-semibold py-3.5 rounded-xl shadow-lg shadow-slate-200 transition-all duration-200 transform active:scale-[0.98]"
                >
                    Masuk ke Dashboard
                </button>
            </form>
        </div>

        <p class="text-center mt-8 text-sm text-slate-400">
            &copy; {{ date('Y') }} BPR Asset Management. All rights reserved.
        </p>
    </div>
</div>

<script>
    // Inisialisasi Lucide Icons
    lucide.createIcons();

    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eye-icon');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.setAttribute('data-lucide', 'eye-off');
        } else {
            passwordInput.type = 'password';
            eyeIcon.setAttribute('data-lucide', 'eye');
        }
        
        // Render ulang icon setelah atribut berubah
        lucide.createIcons();
    }
</script>

</body>
</html> 
