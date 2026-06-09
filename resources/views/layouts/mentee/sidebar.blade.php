@extends('layouts.mentee.navbar')

@section('content')
<div class="flex flex-col lg:flex-row min-h-screen bg-[#F8FAFC] dark:bg-gray-950 transition-colors duration-300">

    {{-- SIDEBAR DESKTOP --}}
    <aside class="hidden lg:block w-80 bg-white dark:bg-gray-900 border-r border-slate-200 dark:border-gray-800 p-8 space-y-10 sticky top-20 h-[calc(100vh-80px)]">
        <div class="text-center">
            <div class="relative inline-block group">
                <div class="w-24 h-24 mx-auto rounded-[2rem] overflow-hidden shadow-2xl shadow-purple-100 dark:shadow-black/40 transition-transform duration-500 group-hover:rotate-3 border-4 border-white dark:border-gray-800">
                    @if(auth()->user()->photo)
                        <img src="{{ asset('storage/' . auth()->user()->photo) }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gradient-to-tr from-brand-purple to-purple-400 flex items-center justify-center text-3xl font-bold text-white uppercase">
                            {{ strtoupper(substr(auth()->user()->username, 0, 2)) }}
                        </div>
                    @endif
                </div>
                <div class="absolute -bottom-1 -right-1 w-8 h-8 bg-green-500 border-4 border-white dark:border-gray-800 rounded-full shadow-sm"></div>
            </div>
            <div class="mt-5">
                <h6 class="font-extrabold text-slate-800 dark:text-white text-lg leading-tight">{{ auth()->user()->username }}</h6>
                <p class="text-slate-400 dark:text-gray-500 text-xs font-semibold mt-1 uppercase tracking-widest">Mentee</p>
            </div>
        </div>

        <nav class="space-y-2">
            <p class="text-[10px] font-bold text-slate-400 dark:text-gray-500 uppercase tracking-[0.2em] px-4 mb-4">Utama</p>
            <a href="{{ route('mentee.dashboard') }}" 
               class="flex items-center gap-4 px-5 py-4 rounded-2xl transition-all duration-300 {{ request()->routeIs('mentee.dashboard') || request()->routeIs('mentee.course.saya') ? 'bg-brand-purple text-white shadow-purple-gradient font-bold' : 'text-slate-500 dark:text-gray-400 hover:bg-slate-50 dark:hover:bg-gray-800 hover:text-brand-purple' }}">
                <i class="ri-dashboard-line text-lg"></i>
                <span class="text-[15px]">Dashboard</span>
            </a>
            <a href="{{ route('mentee.pembayaran.riwayat') }}" 
               class="flex items-center gap-4 px-5 py-4 rounded-2xl transition-all duration-300 {{ request()->routeIs('mentee.pembayaran.riwayat') ? 'bg-brand-purple text-white shadow-purple-gradient font-bold' : 'text-slate-500 dark:text-gray-400 hover:bg-slate-50 dark:hover:bg-gray-800 hover:text-brand-purple' }}">
                <i class="ri-history-line text-lg"></i>
                <span class="text-[15px]">Riwayat Transaksi</span>
            </a>
            <a href="{{ route('mentee.sertifikat.index') }}" 
               class="flex items-center gap-4 px-5 py-4 rounded-2xl transition-all duration-300 {{ request()->routeIs('mentee.sertifikat.index') ? 'bg-brand-purple text-white shadow-purple-gradient font-bold' : 'text-slate-500 dark:text-gray-400 hover:bg-slate-50 dark:hover:bg-gray-800 hover:text-brand-purple' }}">
                <i class="ri-medal-line text-lg"></i>
                <span class="text-[15px]">Sertifikat Saya</span>
            </a>
            <a href="{{ route('mentee.notifikasi.index') }}" 
               class="flex items-center gap-4 px-5 py-4 rounded-2xl transition-all duration-300 {{ request()->routeIs('mentee.notifikasi.index') ? 'bg-brand-purple text-white shadow-purple-gradient font-bold' : 'text-slate-500 dark:text-gray-400 hover:bg-slate-50 dark:hover:bg-gray-800 hover:text-brand-purple' }}">
                <i class="ri-notification-3-line text-lg"></i>
                <span class="text-[15px]">Notifikasi</span>
            </a>
            <a href="{{ route('mentee.profile.index') }}" 
               class="flex items-center gap-4 px-5 py-4 rounded-2xl transition-all duration-300 {{ request()->routeIs('mentee.profile.index') ? 'bg-brand-purple text-white shadow-purple-gradient font-bold' : 'text-slate-500 dark:text-gray-400 hover:bg-slate-50 dark:hover:bg-gray-800 hover:text-brand-purple' }}">
                <i class="ri-user-settings-line text-lg"></i>
                <span class="text-[15px]">Profil Saya</span>
            </a>
        </nav>
    </aside>

    {{-- MAIN CONTENT AREA --}}
    <main class="flex-1 p-6 md:p-10 lg:p-12 overflow-x-hidden">
        @yield('main-content')
    </main>
</div>

<style>
    /* Custom Purple Gradient Shadow */
    .shadow-purple-gradient {
        box-shadow: 0 10px 25px -3px rgba(159, 102, 175, 0.3), 0 4px 12px -2px rgba(159, 102, 175, 0.2);
    }
    
    .dark .shadow-purple-gradient {
        box-shadow: 0 10px 25px -3px rgba(0, 0, 0, 0.5), 0 4px 12px -2px rgba(159, 102, 175, 0.15);
    }

    @keyframes slide-in {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-slide-in { animation: slide-in 0.3s ease-out forwards; }
</style>
@endsection
