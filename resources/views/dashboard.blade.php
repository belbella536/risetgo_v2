@extends('layouts.dashboard')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">
    
    <!-- Welcome Card -->
    <div class="bg-gradient-to-r from-green-600 to-green-500 rounded-2xl p-8 text-white shadow-lg shadow-green-100">
        <h1 class="text-2xl font-bold">Halo, {{ Auth::user()->username }}! 👋</h1>
        <p class="text-green-50 mt-1">Sistem informasi pelayanan mahasiswa FTIK siap digunakan hari ini.</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 lg:gap-6">
        @php
            $stats = [
                ['label' => 'Total Pengajuan', 'val' => '42', 'color' => 'blue'],
                ['label' => 'Perlu Review', 'val' => '12', 'color' => 'amber'],
                ['label' => 'Selesai', 'val' => '28', 'color' => 'green'],
                ['label' => 'Ditolak', 'val' => '2', 'color' => 'rose'],
            ];
        @endphp

        @foreach($stats as $stat)
        <div class="bg-white p-4 lg:p-6 rounded-2xl border border-green-50 shadow-sm">
            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-tight">{{ $stat['label'] }}</span>
            <div class="text-2xl lg:text-3xl font-black text-slate-800 mt-1">{{ $stat['val'] }}</div>
        </div>
        @endforeach
    </div>

    <!-- Table Section -->
    <div class="bg-white rounded-2xl border border-green-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-green-50 flex justify-between items-center bg-white sticky top-0">
            <h2 class="font-bold text-slate-800">Antrean Terkini</h2>
            <button class="text-xs font-bold bg-green-600 text-white px-4 py-2 rounded-xl hover:bg-green-700 transition shadow-md shadow-green-100">Buat Baru</button>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50 text-[10px] uppercase tracking-widest text-slate-400 font-bold">
                    <tr>
                        <th class="px-6 py-3">Mahasiswa</th>
                        <th class="px-6 py-3">Layanan</th>
                        <th class="px-6 py-3">Status</th>
                    </tr>
                </thead>
                <tbody class="text-sm divide-y divide-slate-50">
                    <tr class="hover:bg-green-50/50 transition-colors">
                        <td class="px-6 py-4 font-semibold text-slate-700">Aditya Taufik Ismail</td>
                        <td class="px-6 py-4 text-slate-500 italic">Digitalisasi Administrasi</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-[10px] font-bold uppercase">Proses</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection