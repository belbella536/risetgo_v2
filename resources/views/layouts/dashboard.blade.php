<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riset Go - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-[#F8FAFC] text-slate-900 overflow-hidden" x-data="{ sidebarOpen: true, mobileOpen: false }">

    <div class="flex h-screen w-full overflow-hidden">
        
        <!-- SIDEBAR OVERLAY (Hanya muncul di Mobile saat sidebar terbuka) -->
        <div 
            x-show="sidebarOpen" 
            @click="sidebarOpen = false" 
            class="fixed inset-0 z-30 bg-slate-900/50 backdrop-blur-sm lg:hidden transition-opacity"
            x-transition:enter="transition opacity-0 ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition opacity-100 ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0">
        </div>

        <!-- SIDEBAR -->
        <aside 
            :class="{
                'translate-x-0 w-64': mobileOpen, 
                '-translate-x-full lg:translate-x-0': !mobileOpen,
                'lg:w-64': sidebarOpen,
                'lg:w-20': !sidebarOpen
            }" 
            class="fixed inset-y-0 left-0 z-[50] flex flex-col bg-white border-r border-green-100 transition-all duration-300 ease-in-out lg:static shrink-0 shadow-xl lg:shadow-none">
    
            <!-- Logo Area -->
            <div class="h-16 flex items-center px-6 border-b border-green-50 shrink-0 justify-between">
                <div class="flex items-center overflow-hidden">
                    <!-- Area Logo Gambar -->
                    <div class="w-10 h-10 flex-shrink-0 flex items-center justify-center">
                        <img src="{{ asset('images/logo/uin.png') }}" 
                            alt="Logo" 
                            class="w-full h-full object-contain">
                    </div>
                    <!-- Paksa teks muncul di mobile tanpa peduli sidebarOpen -->
                    <span 
                        x-show="sidebarOpen || (window.innerWidth < 1024 && mobileOpen)" 
                        class="ml-3 font-bold text-lg tracking-tight text-slate-800 whitespace-nowrap">
                        Riset<span class="text-green-600"> GO</span>
                    </span>
                </div>
                <!-- Close Button Mobile -->
                <button @click="mobileOpen = false" class="lg:hidden text-slate-400 p-1 hover:bg-slate-50 rounded">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <!-- Menu Navigasi -->
            <nav class="flex-1 overflow-y-auto no-scrollbar p-4 space-y-2">
                <!-- Label Menu -->
                <div x-show="sidebarOpen || (window.innerWidth < 1024 && mobileOpen)" class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] px-3 mb-2 whitespace-nowrap">
                    Menu Utama
                </div>
                
                <!-- Dashboard -->
                <a href="#" class="flex items-center p-3 rounded-xl bg-green-50 text-green-700 group transition-all">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    <span x-show="sidebarOpen || (window.innerWidth < 1024 && mobileOpen)" class="ml-3 font-medium whitespace-nowrap">Dashboard</span>
                </a>
                
                <!-- Profile -->
                <a href="{{ route('profile') }}" class="flex items-center p-3 rounded-xl text-slate-500 hover:bg-green-50 hover:text-green-600 group transition-all">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    <span x-show="sidebarOpen || (window.innerWidth < 1024 && mobileOpen)" class="ml-3 font-medium whitespace-nowrap">Profile</span>
                </a>
            </nav>

            <!-- Logout -->
            <div class="p-4 border-t border-green-50">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="flex items-center w-full p-3 rounded-xl text-rose-500 hover:bg-rose-50 transition-colors font-medium">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        <span x-show="sidebarOpen || (window.innerWidth < 1024 && mobileOpen)" class="ml-3 whitespace-nowrap text-sm font-semibold">Logout Akun</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- MAIN CONTENT -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
            <!-- Header -->
            <header class="h-16 bg-white border-b border-green-100 flex items-center justify-between px-4 lg:px-8 shrink-0">
                <div class="flex items-center gap-4">
                    <button @click="mobileOpen = !mobileOpen" class="p-2 rounded-lg bg-slate-50 hover:bg-green-50 text-slate-600 hover:text-green-600 lg:hidden">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                    <button @click="sidebarOpen = !sidebarOpen" class="hidden lg:block p-2 rounded-lg bg-slate-50 hover:bg-green-50 text-slate-600 hover:text-green-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                    <h2 class="font-bold text-slate-800">FTIK UIN Sunan Kudus</h2>
                </div>
                
                <div class="flex items-center gap-3">
                    <div class="text-right hidden xs:block">
                        <p class="text-[10px] font-bold text-green-600 uppercase tracking-widest leading-none">{{ Auth::user()->role }}</p>
                    </div>
                    <div class="w-9 h-9 rounded-full bg-green-100 border-2 border-white shadow-sm flex items-center justify-center text-green-700 font-bold text-sm">
                        {{ strtoupper(substr(Auth::user()->username, 0, 1)) }}
                    </div>
                </div>
            </header>

            <!-- Main Scrollable Area -->
            <main class="flex-1 overflow-y-auto p-4 lg:p-8 no-scrollbar bg-[#F8FAFC]">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>