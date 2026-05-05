@extends('layouts.dashboard')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">
    
    <!-- Header Halaman -->
    <div>
        <h1 class="text-2xl font-bold text-slate-800">Profil Pengguna</h1>
        <p class="text-sm text-slate-500">Kelola informasi pribadi dan pengaturan keamanan akun Anda.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Kartu Identitas (Kiri) -->
        <div class="bg-white p-6 rounded-2xl border border-green-100 shadow-sm flex flex-col items-center text-center h-fit">
            <div class="w-24 h-24 rounded-full bg-green-100 border-4 border-white shadow-md flex items-center justify-center text-green-700 font-bold text-4xl mb-4">
                {{ strtoupper(substr(Auth::user()->username, 0, 1)) }}
            </div>
            <h2 class="text-xl font-bold text-slate-800">{{ Auth::user()->username }}</h2>
            <p class="text-[10px] font-bold text-green-600 uppercase tracking-[0.2em] mt-1">{{ Auth::user()->role }}</p>
            <p class="text-sm text-slate-500 mt-2">{{ Auth::user()->email ?? 'Belum ada email' }}</p>
            
            <div class="w-full mt-6 pt-6 border-t border-slate-50">
                <div class="flex justify-between text-sm mb-3">
                    <span class="text-slate-500">Status Akun</span>
                    <span class="font-bold text-green-600 bg-green-50 px-2 py-0.5 rounded">Aktif</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-slate-500">Terdaftar</span>
                    <span class="font-medium text-slate-700">{{ Auth::user()->created_at ? Auth::user()->created_at->format('d M Y') : '-' }}</span>
                </div>
            </div>
        </div>

        <!-- Form Edit Profil (Kanan) -->
        <div class="lg:col-span-2 bg-white p-6 md:p-8 rounded-2xl border border-green-100 shadow-sm">
            <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                
                <!-- Grup Informasi Dasar -->
                <div>
                    <h3 class="text-sm font-bold text-slate-800 mb-4 flex items-center">
                        <svg class="w-4 h-4 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        Informasi Dasar
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">Username</label>
                            <input type="text" name="username" value="{{ Auth::user()->username }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-green-500 focus:ring-2 focus:ring-green-100 outline-none transition-all text-sm font-medium text-slate-800">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">Alamat Email</label>
                            <input type="email" name="email" value="{{ Auth::user()->email }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-green-500 focus:ring-2 focus:ring-green-100 outline-none transition-all text-sm font-medium text-slate-800">
                        </div>
                    </div>
                </div>

                <!-- Divider -->
                <hr class="border-slate-50">

                <!-- Grup Keamanan -->
                <div>
                    <h3 class="text-sm font-bold text-slate-800 mb-4 flex items-center">
                        <svg class="w-4 h-4 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        Keamanan
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">Password Baru</label>
                            <input type="password" name="password" placeholder="Kosongkan jika tidak diubah" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-green-500 focus:ring-2 focus:ring-green-100 outline-none transition-all text-sm placeholder:text-slate-300">
                            <!-- Penampil Error Password -->
                            @error('password')
                                <p class="text-xs text-red-500 mt-2 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">Konfirmasi Password</label>
                            <!-- Pastikan name atributnya adalah "password_confirmation" -->
                            <input type="password" name="password_confirmation" placeholder="Ulangi password baru" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-green-500 focus:ring-2 focus:ring-green-100 outline-none transition-all text-sm placeholder:text-slate-300">
                        </div>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="flex justify-end gap-3 pt-2">
                    <button type="reset" class="px-5 py-2.5 rounded-xl text-sm font-bold text-slate-500 hover:bg-slate-100 transition-colors">Batal</button>
                    <button type="submit" class="px-5 py-2.5 rounded-xl text-sm font-bold bg-green-600 text-white hover:bg-green-700 shadow-md shadow-green-100 transition-all">Simpan Perubahan</button>
                </div>
            </form>

            @if(session('success'))
                <div class="mb-6 px-4 py-3 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm font-medium flex items-center">
                    <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    {{ session('success') }}
                </div>
            @endif
        </div>

    </div>
</div>
@endsection