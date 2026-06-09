<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Flodemi')</title>

  <link rel="icon" type="image/png" href="{{ asset('images/f.png') }}">
  
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  
  <!-- Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
  
  @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/push-notification.js'])

  <script>
    // On page load or when changing themes, best to add inline in `head` to avoid FOUC
    if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
      document.documentElement.classList.add('dark');
    } else {
      document.documentElement.classList.remove('dark');
    }
  </script>

  @hasSection('custom_css')
    <link rel="stylesheet" href="@yield('custom_css')">
  @endif
</head>

<body class="bg-gray-50 dark:bg-gray-950 font-manrope text-gray-900 dark:text-white antialiased">

@php $user = Auth::user(); @endphp

<nav class="sticky top-0 z-[1050] w-full border-b border-gray-100 dark:border-gray-800 bg-white/80 dark:bg-gray-900/80 backdrop-blur-md py-3 md:py-4 shadow-sm transition-all duration-300">
  <div class="container mx-auto px-4 lg:px-8">
    <div class="flex items-center justify-between">
      
      <div class="flex items-center gap-4">
        {{-- TOGGLER (Mobile) --}}
        <button class="flex items-center justify-center p-2 text-gray-600 dark:text-gray-400 transition-colors hover:text-brand-purple lg:hidden" 
                type="button"
                onclick="toggleSidebar()">
          <i class="ri-menu-2-line text-2xl"></i>
        </button>

        {{-- BRAND --}}
        <a class="transition-transform hover:scale-105" href="{{ route('home') }}">
          <img src="{{ asset('assets/logo1.png') }}" alt="Flodemi" class="h-8 w-auto md:h-9 lg:h-10 dark:brightness-0 dark:invert">
        </a>
      </div>

      {{-- MENU DESKTOP --}}
      <div class="hidden lg:flex items-center justify-center flex-1 ml-8">
        <ul class="flex items-center gap-8">
          <li>
            <a class="relative py-2 text-[14px] font-bold transition-colors {{ request()->routeIs('home') ? 'text-brand-purple' : 'text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white' }}"
               href="{{ route('home') }}">
              Home
              @if(request()->routeIs('home'))
                <span class="absolute bottom-[-6px] left-0 h-[2px] w-full bg-brand-purple rounded-t-full"></span>
              @endif
            </a>
          </li>

          <li>
            <a class="relative py-2 text-[14px] font-bold transition-colors {{ request()->routeIs('katalog') || Str::contains(url()->current(), '#course-section') ? 'text-brand-purple' : 'text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white' }}"
               href="{{ route('home') }}#course-section">
              Pilih Course
              @if(request()->routeIs('katalog') || Str::contains(url()->current(), '#course-section'))
                <span class="absolute bottom-[-6px] left-0 h-[2px] w-full bg-brand-purple rounded-t-full"></span>
              @endif
            </a>
          </li>

          @auth
          <li>
            <a class="relative py-2 text-[14px] font-bold transition-colors {{ request()->routeIs('mentee.course.saya') || request()->routeIs('mentee.dashboard') ? 'text-brand-purple' : 'text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white' }}"
               href="{{ route('mentee.course.saya') }}">
              Course Saya
              @if(request()->routeIs('mentee.course.saya') || request()->routeIs('mentee.dashboard'))
                <span class="absolute bottom-[-6px] left-0 h-[2px] w-full bg-brand-purple rounded-t-full"></span>
              @endif
            </a>
          </li>
          @endauth
        </ul>
      </div>

      {{-- RIGHT SIDE --}}
      <div class="flex items-center gap-1 md:gap-4">

        {{-- THEME TOGGLE --}}
        <button class="theme-toggle-btn group relative h-10 w-10 flex items-center justify-center overflow-hidden rounded-full transition-all duration-300 hover:bg-gray-100 dark:hover:bg-gray-800">
          <div class="relative h-6 w-6 flex items-center justify-center">
            <i class="ri-sun-line text-[20px] text-amber-500 transition-all duration-500 transform rotate-0 scale-100 opacity-100 dark:-rotate-90 dark:scale-0 dark:opacity-0"></i>
            <i class="ri-moon-line text-[20px] text-brand-purple absolute transition-all duration-500 transform rotate-90 scale-0 opacity-0 dark:rotate-0 dark:scale-100 dark:opacity-100"></i>
          </div>
        </button>

        @auth
          {{-- NOTIFICATION --}}
          <div class="relative group" id="notificationDropdown">
            <button class="relative flex h-10 w-10 items-center justify-center transition-transform hover:scale-110 text-gray-500 dark:text-gray-400 hover:text-brand-purple"
                    onclick="toggleDropdown('notifMenu')">
              <i class="ri-notification-3-line text-[20px]"></i>
              <span id="notifBadge" class="absolute right-2 top-2 h-2 w-2 rounded-full border-2 border-white dark:border-gray-900 bg-red-500 {{ isset($global_unread_count) && $global_unread_count > 0 ? 'block' : 'hidden' }}"></span>
            </button>

            {{-- NOTIF DROPDOWN MENU --}}
            <div id="notifMenu" class="hidden fixed sm:absolute left-4 right-4 sm:left-auto sm:right-0 top-20 sm:top-auto mt-2 sm:mt-4 w-auto sm:w-[380px] overflow-hidden rounded-[2rem] border border-gray-100 dark:border-gray-800 bg-white dark:bg-gray-900 shadow-2xl dark:shadow-black/60 transition-all z-[1100]">
              
              {{-- Header with Push Toggle --}}
              <div class="px-4 py-4 sm:px-6 sm:py-5 border-b border-gray-50 dark:border-gray-800">
                <div class="flex items-center justify-between mb-4">
                  <h6 class="text-base font-black text-gray-900 dark:text-white">Notifikasi</h6>
                  <button class="text-[11px] font-bold text-brand-purple hover:underline" id="menteeMarkAllReadBtn">
                    Tandai dibaca
                  </button>
                </div>
                
                {{-- Push toggle area --}}
                <div class="flex items-center justify-between p-3 rounded-2xl bg-slate-50 dark:bg-gray-800/50 border border-slate-100 dark:border-gray-800">
                  <div class="flex items-center gap-3">
                    <div class="flex h-8 w-8 items-center justify-center rounded-xl bg-brand-purple/10 text-brand-purple">
                      <i class="ri-notification-badge-line text-lg"></i>
                    </div>
                    <div class="flex flex-col">
                      <span class="text-[11px] font-bold text-gray-900 dark:text-white leading-tight">Push Notification</span>
                      <span class="text-[9px] text-gray-500 font-medium">Aktifkan notifikasi untuk mendapatkan info terbaru</span>
                    </div>
                  </div>
                  <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" id="pushToggle" class="sr-only peer">
                    <div class="w-8 h-4.5 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-3.5 after:w-3.5 after:transition-all dark:border-gray-600 peer-checked:bg-brand-purple"></div>
                  </label>
                </div>
              </div>
              
              <div id="notifList" class="max-h-[380px] overflow-y-auto custom-scrollbar">
                {{-- List generated by JS --}}
                <div class="py-12 text-center">
                  <i class="ri-notification-3-line text-4xl text-gray-200 dark:text-gray-800 mb-3 block"></i>
                  <p class="text-[13px] font-medium text-gray-400">Memuat...</p>
                </div>
              </div>
              
              <div class="p-4 border-t border-gray-50 dark:border-gray-800">
                <a href="{{ route('mentee.notifikasi.index') }}" class="flex items-center justify-center w-full py-3 rounded-xl bg-slate-50 dark:bg-gray-800 text-[11px] font-black text-gray-500 hover:text-brand-purple transition-all uppercase tracking-widest">
                  Lihat Semua
                </a>
              </div>
            </div>
          </div>

          <div class="h-6 w-px bg-gray-200 dark:bg-gray-800 mx-1 hidden md:block"></div>

          {{-- AVATAR DROPDOWN --}}
          <div class="relative group" id="profileDropdown">
            <button class="flex items-center gap-3 outline-none transition-transform hover:scale-[1.02]"
                    onclick="toggleDropdown('profileMenu')">
              
              <div class="relative h-10 w-10 shrink-0 overflow-hidden rounded-full border border-gray-100 dark:border-gray-800 shadow-sm">
                @if($user->photo)
                  <img src="{{ asset('storage/' . $user->photo) }}" class="h-full w-full object-cover">
                @else
                  <div class="flex h-full w-full items-center justify-center bg-brand-purple text-[14px] font-bold text-white uppercase">
                    {{ substr($user->username, 0, 2) }}
                  </div>
                @endif
              </div>
              
              <div class="hidden md:flex flex-col items-start text-left">
                 <span class="text-[14px] font-bold text-gray-900 dark:text-white leading-tight">{{ $user->username }}</span>
                 <span class="text-[11px] font-bold text-brand-purple leading-tight">Mentee</span>
              </div>
              
              <i class="ri-arrow-down-s-line text-gray-400 text-xs ml-1 hidden md:block"></i>
            </button>

            {{-- PROFILE DROPDOWN MENU --}}
            <div id="profileMenu" class="hidden absolute right-0 mt-4 w-64 overflow-hidden rounded-2xl border border-gray-100 dark:border-gray-800 bg-white dark:bg-gray-900 shadow-xl dark:shadow-black/50">
              <div class="p-5 border-b border-gray-50 dark:border-gray-800">
                <div class="flex items-center gap-3">
                  <div class="h-12 w-12 shrink-0 overflow-hidden rounded-full border border-gray-100 dark:border-gray-800 shadow-sm">
                    @if($user->photo)
                      <img src="{{ asset('storage/' . $user->photo) }}" class="h-full w-full object-cover">
                    @else
                      <div class="flex h-full w-full items-center justify-center bg-brand-purple text-[16px] font-bold text-white uppercase">
                        {{ substr($user->username, 0, 2) }}
                      </div>
                    @endif
                  </div>
                  <div class="min-w-0 flex-1">
                    <div class="truncate text-[15px] font-bold text-gray-900 dark:text-white">{{ $user->username }}</div>
                    <div class="truncate text-[12px] font-medium text-gray-500 dark:text-gray-400">{{ $user->email }}</div>
                  </div>
                </div>
              </div>

              <div class="py-2">
                <a href="{{ route('mentee.profile.index') }}" class="flex items-center gap-3 px-5 py-2.5 text-[13px] font-bold text-gray-600 dark:text-gray-400 transition-colors hover:bg-gray-50 dark:hover:bg-gray-800/50 hover:text-brand-purple dark:hover:text-brand-purple">
                  <i class="ri-user-line text-lg"></i>
                  Profil Saya
                </a>
              </div>

              <div class="border-t border-gray-50 dark:border-gray-800"></div>

              <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="flex w-full items-center gap-3 px-5 py-3 text-[13px] font-bold text-red-500 transition-colors hover:bg-red-50 dark:hover:bg-red-950/30">
                  <i class="ri-logout-box-r-line text-lg"></i>
                  Keluar
                </button>
              </form>
            </div>
          </div>
        @endauth

        @guest
          <div class="hidden lg:flex items-center gap-4 ml-4">
            <a href="{{ route('login') }}" class="text-[14px] font-bold text-gray-600 dark:text-gray-400 hover:text-brand-purple transition-colors">Masuk</a>
            <a href="{{ route('register') }}" class="rounded-full bg-brand-purple px-6 py-2 text-[14px] font-bold text-white transition-all hover:bg-brand-purple-dark shadow-md shadow-purple-200 dark:shadow-none hover:scale-105 active:scale-95">Daftar</a>
          </div>
        @endguest

      </div>

    </div>
  </div>
</nav>

{{-- SIDEBAR MOBILE--}}
<div id="mobileSidebar" class="fixed inset-0 z-[2000] hidden">
  {{-- Overlay with blur --}}
  <div class="absolute inset-0 bg-gray-900/40 dark:bg-black/60 backdrop-blur-md transition-opacity duration-300" onclick="toggleSidebar()"></div>
  
  {{-- Panel --}}
  <div class="absolute inset-y-0 left-0 w-[300px] bg-white dark:bg-gray-950 shadow-2xl transition-transform duration-300 -translate-x-full flex flex-col border-r border-transparent dark:border-gray-800" id="sidebarPanel">
    
    {{-- Sidebar Header --}}
    <div class="flex items-center justify-between px-6 py-6 border-b border-gray-50 dark:border-gray-800">
      <a href="{{ route('home') }}" class="transition-transform active:scale-95">
        <img src="{{ asset('assets/logo1.png') }}" alt="Flodemi" class="h-8 w-auto dark:brightness-0 dark:invert">
      </a>
      <div class="flex items-center gap-2">
        <button class="theme-toggle-btn group relative h-10 w-10 flex items-center justify-center overflow-hidden rounded-full transition-all duration-300 hover:bg-gray-100 dark:hover:bg-gray-800">
          <div class="relative h-6 w-6 flex items-center justify-center">
            <i class="ri-sun-line text-lg text-amber-500 transition-all duration-500 transform rotate-0 scale-100 opacity-100 dark:-rotate-90 dark:scale-0 dark:opacity-0"></i>
            <i class="ri-moon-line text-lg text-brand-purple absolute transition-all duration-500 transform rotate-90 scale-0 opacity-0 dark:rotate-0 dark:scale-100 dark:opacity-100"></i>
          </div>
        </button>
        <button onclick="toggleSidebar()" class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-50 dark:bg-gray-800 text-gray-400 hover:text-brand-purple transition-all">
          <i class="ri-close-line text-lg"></i>
        </button>
      </div>
    </div>

    {{-- Sidebar Content --}}
    <div class="flex-1 overflow-y-auto py-6 custom-scrollbar">
      
      @auth
      {{-- User Profile Section for Mobile --}}
      <div class="px-6 pb-6 mb-6 border-b border-gray-50 dark:border-gray-800 flex items-center gap-4">
        <div class="relative h-12 w-12 shrink-0 overflow-hidden rounded-full border border-gray-100 dark:border-gray-800 shadow-sm">
          @if($user->photo)
            <img src="{{ asset('storage/' . $user->photo) }}" class="h-full w-full object-cover">
          @else
            <div class="flex h-full w-full items-center justify-center bg-brand-purple text-[15px] font-bold text-white uppercase">
              {{ substr($user->username, 0, 2) }}
            </div>
          @endif
        </div>
        <div class="min-w-0 flex-1">
          <div class="truncate text-[15px] font-black text-gray-900 dark:text-white leading-tight">{{ $user->username }}</div>
          <div class="truncate text-[11px] font-bold text-brand-purple uppercase tracking-widest mt-0.5">Mentee</div>
        </div>
      </div>
      @endauth

      {{-- Menu Section --}}
      <div class="px-4 space-y-6">
        <div>
          <p class="px-4 text-[10px] font-black text-gray-400 dark:text-gray-500 uppercase tracking-[0.2em] mb-3">Navigasi Utama</p>
          <ul class="space-y-1">
            <li>
              <a href="{{ route('home') }}" 
                 class="flex items-center gap-3.5 px-4 py-3 rounded-xl font-bold transition-all {{ request()->routeIs('home') ? 'bg-brand-purple text-white shadow-lg shadow-purple-100 dark:shadow-none' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800/50 hover:text-brand-purple' }}">
                <i class="ri-home-4-line text-lg"></i>
                <span class="text-[14px]">Home</span>
              </a>
            </li>
            <li>
              <a href="{{ route('home') }}#course-section" 
                 class="flex items-center gap-3.5 px-4 py-3 rounded-xl font-bold transition-all {{ request()->routeIs('katalog') || Str::contains(url()->current(), '#course-section') ? 'bg-brand-purple text-white shadow-lg shadow-purple-100 dark:shadow-none' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800/50 hover:text-brand-purple' }}">
                <i class="ri-compass-3-line text-lg"></i>
                <span class="text-[14px]">Pilih Course</span>
              </a>
            </li>
          </ul>
        </div>

        @auth
        <div>
          <p class="px-4 text-[10px] font-black text-gray-400 dark:text-gray-500 uppercase tracking-[0.2em] mb-3">Dashboard Mentee</p>
          <ul class="space-y-1">
            <li>
              <a href="{{ route('mentee.dashboard') }}" 
                 class="flex items-center gap-3.5 px-4 py-3 rounded-xl font-bold transition-all {{ request()->routeIs('mentee.dashboard') || request()->routeIs('mentee.course.saya') ? 'bg-brand-purple text-white shadow-lg shadow-purple-100 dark:shadow-none' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800/50 hover:text-brand-purple' }}">
                <i class="ri-dashboard-line text-lg"></i>
                <span class="text-[14px]">Dashboard</span>
              </a>
            </li>
            <li>
              <a href="{{ route('mentee.pembayaran.riwayat') }}" 
                 class="flex items-center gap-3.5 px-4 py-3 rounded-xl font-bold transition-all {{ request()->routeIs('mentee.pembayaran.riwayat') ? 'bg-brand-purple text-white shadow-lg shadow-purple-100 dark:shadow-none' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800/50 hover:text-brand-purple' }}">
                <i class="ri-history-line text-lg"></i>
                <span class="text-[14px]">Riwayat Transaksi</span>
              </a>
            </li>
            <li>
              <a href="{{ route('mentee.sertifikat.index') }}" 
                 class="flex items-center gap-3.5 px-4 py-3 rounded-xl font-bold transition-all {{ request()->routeIs('mentee.sertifikat.index') ? 'bg-brand-purple text-white shadow-lg shadow-purple-100 dark:shadow-none' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800/50 hover:text-brand-purple' }}">
                <i class="ri-medal-line text-lg"></i>
                <span class="text-[14px]">Sertifikat Saya</span>
              </a>
            </li>
            <li>
              <a href="{{ route('mentee.notifikasi.index') }}" 
                 class="flex items-center gap-3.5 px-4 py-3 rounded-xl font-bold transition-all {{ request()->routeIs('mentee.notifikasi.index') ? 'bg-brand-purple text-white shadow-lg shadow-purple-100 dark:shadow-none' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800/50 hover:text-brand-purple' }}">
                <i class="ri-notification-3-line text-lg"></i>
                <span class="text-[14px]">Notifikasi</span>
              </a>
            </li>
            <li>
              <a href="{{ route('mentee.profile.index') }}" 
                 class="flex items-center gap-3.5 px-4 py-3 rounded-xl font-bold transition-all {{ request()->routeIs('mentee.profile.index') ? 'bg-brand-purple text-white shadow-lg shadow-purple-100 dark:shadow-none' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800/50 hover:text-brand-purple' }}">
                <i class="ri-user-settings-line text-lg"></i>
                <span class="text-[14px]">Profil Saya</span>
              </a>
            </li>
          </ul>
        </div>
        @endauth
      </div>
    </div>

    {{-- Sidebar Footer --}}
    <div class="p-6 border-t border-gray-50 dark:border-gray-800">
      @auth
      <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="w-full flex items-center justify-center gap-3 py-4 rounded-xl bg-red-50 dark:bg-red-950 text-red-500 font-bold text-[14px] hover:bg-red-500 hover:text-white transition-all">
          <i class="ri-logout-box-r-line text-lg"></i>
          Keluar
        </button>
      </form>
      @endauth

      @guest
      <div class="grid grid-cols-2 gap-3">
        <a href="{{ route('login') }}" class="flex items-center justify-center py-3 rounded-xl border border-gray-200 dark:border-gray-800 text-gray-700 dark:text-gray-300 font-bold text-[13px] hover:bg-gray-50 dark:hover:bg-gray-800 transition-all">Masuk</a>
        <a href="{{ route('register') }}" class="flex items-center justify-center py-3 rounded-xl bg-brand-purple text-white font-bold text-[13px] hover:bg-brand-purple-dark transition-all shadow-md shadow-purple-100">Daftar</a>
      </div>
      @endguest
    </div>
  </div>
</div>

<main>
    @yield('content')
</main>

<script>
  // Theme Toggle Logic
  const themeToggleBtns = document.querySelectorAll('.theme-toggle-btn');

  themeToggleBtns.forEach(btn => {
    btn.addEventListener('click', function() {
      // Toggle dark class on <html>
      document.documentElement.classList.toggle('dark');
      
      // Save preference
      const isDark = document.documentElement.classList.contains('dark');
      localStorage.setItem('theme', isDark ? 'dark' : 'light');
    });
  });

  // Mobile Sidebar Toggle
  function toggleSidebar() {
    const sidebar = document.getElementById('mobileSidebar');
    const panel = document.getElementById('sidebarPanel');
    if (sidebar.classList.contains('hidden')) {
      sidebar.classList.remove('hidden');
      setTimeout(() => panel.classList.remove('-translate-x-full'), 10);
    } else {
      panel.classList.add('-translate-x-full');
      setTimeout(() => sidebar.classList.add('hidden'), 300);
    }
  }

  // Dropdown Toggle
  function toggleDropdown(menuId) {
    const menu = document.getElementById(menuId);
    const allMenus = ['notifMenu', 'profileMenu'];
    
    allMenus.forEach(id => {
      const otherMenu = document.getElementById(id);
      if (id !== menuId && otherMenu) otherMenu.classList.add('hidden');
    });

    if (menu) menu.classList.toggle('hidden');
  }

  // Close dropdowns when clicking outside
  window.addEventListener('click', function(e) {
    if (!e.target.closest('#notificationDropdown') && !e.target.closest('#profileDropdown')) {
      document.getElementById('notifMenu')?.classList.add('hidden');
      document.getElementById('profileMenu')?.classList.add('hidden');
    }
  });
</script>

@auth
  {{-- Toast Container --}}
  <div id="toastContainer" class="fixed bottom-5 right-5 z-[9999] flex flex-col gap-3 pointer-events-none"></div>

  <script>
  document.addEventListener('DOMContentLoaded', function () {
      const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
      const notifBadge = document.getElementById('notifBadge');
      const notifList = document.getElementById('notifList');
      const toastContainer = document.getElementById('toastContainer');
      const pushToggle = document.getElementById('pushToggle');

      let currentNotifVersion = 0;
      let toastedIds = new Set(JSON.parse(sessionStorage.getItem('toasted_ids') || '[]'));
      let isInitialLoad = true;

      // Check push subscription status
      if ('serviceWorker' in navigator && pushToggle) {
          navigator.serviceWorker.ready.then(reg => {
              reg.pushManager.getSubscription().then(sub => {
                  pushToggle.checked = !!sub;
              });
          });

          pushToggle.addEventListener('change', async function() {
              const vapidKey = "{{ config('webpush.vapid.public_key') }}";
              if (!vapidKey) return;
              
              const push = new PushNotification(vapidKey);
              await push.init();
              
              try {
                  if (this.checked) {
                      await push.subscribeUser();
                      push.toast('Berhasil!', 'Notifikasi berhasil diaktifkan.');
                  } else {
                      await push.unsubscribeUser();
                      push.toast('Info', 'Notifikasi telah dimatikan.', 'info');
                  }
              } catch (e) {
                  this.checked = !this.checked;
                  push.toast('Gagal', 'Gagal mengubah pengaturan notifikasi.', 'error');
              }
          });
      }

      function showToast(notif) {
          const toast = document.createElement('div');
          toast.className = 'pointer-events-auto flex items-center gap-4 bg-white/80 dark:bg-gray-900/80 backdrop-blur-xl border border-white/20 dark:border-white/5 p-4 pr-6 rounded-2xl shadow-[0_20px_50px_rgba(0,0,0,0.1)] dark:shadow-[0_20px_50px_rgba(0,0,0,0.3)] animate-slide-in group cursor-pointer';
          
          let iconClass = 'ri-information-line';
          let iconBg = 'bg-brand-purple/10 text-brand-purple';

          if (notif.tipe === 'pembayaran') {
              iconClass = 'ri-check-line';
              iconBg = 'bg-emerald-500/10 text-emerald-500';
          } else if (notif.tipe === 'pengumuman') {
              iconClass = 'ri-notification-line';
              iconBg = 'bg-blue-500/10 text-blue-500';
          }

          toast.innerHTML = `
              <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl ${iconBg} text-xl transition-transform group-hover:scale-110">
                  <i class="${iconClass}"></i>
              </div>
              <div class="flex-1 min-w-0">
                  <p class="text-[13px] font-bold text-gray-900 dark:text-white leading-tight">${notif.judul}</p>
                  <p class="text-[11px] text-gray-500 dark:text-gray-400 mt-1 line-clamp-1">${notif.pesan}</p>
              </div>
          `;

          toast.onclick = () => window.location.href = `{{ url('/notifikasi') }}/${notif.id}/read`;
          toastContainer.appendChild(toast);
          setTimeout(() => {
              toast.classList.replace('animate-slide-in', 'animate-slide-out');
              setTimeout(() => toast.remove(), 500);
          }, 5000);
      }

      function updateNotificationsUI() {
          if (!csrfToken) return;

          fetch(`{{ route("notifikasi.latest") }}?v=${currentNotifVersion}`, {
              headers: { 'Accept': 'application/json' }
          })
          .then(res => res.json())
          .then(data => {
              if (data.success) {
                  if (data.v) currentNotifVersion = data.v;

                  if (data.notifications?.length > 0) {
                      data.notifications.forEach(notif => {
                          if (!notif.sudah_dibaca && !toastedIds.has(notif.id)) {
                              if (!isInitialLoad) showToast(notif);
                              toastedIds.add(notif.id);
                          }
                      });
                      sessionStorage.setItem('toasted_ids', JSON.stringify(Array.from(toastedIds)));
                  }
                  
                  isInitialLoad = false;
                  if (data.no_change) return;

                  notifBadge.classList.toggle('hidden', data.unreadCount <= 0);

                  if (data.notifications?.length > 0) {
                      let listHtml = '';
                      data.notifications.forEach(notif => {
                          let iconClass = 'ri-information-line';
                          let iconBg = 'bg-slate-100 text-slate-500';
                          if (notif.tipe === 'pembayaran') {
                              iconClass = 'ri-bank-card-line';
                              iconBg = 'bg-amber-100 text-amber-600';
                          } else if (notif.tipe === 'pengumuman') {
                              iconClass = 'ri-megaphone-line';
                              iconBg = 'bg-blue-100 text-blue-600';
                          }
                          
                          const unreadClass = !notif.sudah_dibaca ? 'bg-brand-purple/5 dark:bg-brand-purple/10' : '';
                          const titleClass = !notif.sudah_dibaca ? 'font-bold' : 'font-semibold';
                          
                          listHtml += `
                               <a href="{{ url('/notifikasi') }}/${notif.id}/read" class="block px-4 py-4 sm:px-6 sm:py-5 transition-all border-b border-slate-50 dark:border-gray-800 last:border-0 hover:bg-slate-50 dark:hover:bg-gray-800/50 ${unreadClass}">
                                   <div class="flex items-start gap-3 sm:gap-4">
                                       <div class="flex h-9 w-9 sm:h-10 sm:w-10 shrink-0 items-center justify-center rounded-xl text-sm sm:text-base ${iconBg}">
                                           <i class="${iconClass}"></i>
                                       </div>
                                       <div class="flex-1 min-w-0">
                                           <div class="flex items-center justify-between gap-2">
                                               <p class="truncate text-[12px] sm:text-[13px] text-slate-900 dark:text-white ${titleClass}">${notif.judul}</p>
                                               ${!notif.sudah_dibaca ? '<span class="h-1.5 w-1.5 shrink-0 rounded-full bg-brand-purple"></span>' : ''}
                                           </div>
                                           <p class="truncate text-[10px] sm:text-[11px] text-slate-500 dark:text-gray-400 mt-0.5 sm:mt-1">${notif.pesan}</p>
                                           <span class="text-[8px] sm:text-[9px] text-slate-400 dark:text-gray-500 font-bold uppercase tracking-wider mt-1.5 sm:mt-2 block">${notif.time_ago}</span>
                                       </div>
                                   </div>
                               </a>`;
                      });
                      notifList.innerHTML = listHtml;
                  } else {
                      notifList.innerHTML = `<div class="py-16 text-center"><i class="ri-notification-3-line text-5xl text-slate-100 dark:text-gray-800 mb-4 block"></i><p class="text-[13px] font-bold text-slate-400">Belum ada notifikasi</p></div>`;
                  }
              }
          });
      }

      const markBtn = document.getElementById('menteeMarkAllReadBtn');
      if (markBtn) {
          markBtn.onclick = () => {
              fetch('{{ route("notifikasi.readAll") }}', {
                  method: 'POST',
                  headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' }
              }).then(() => { currentNotifVersion = 0; updateNotificationsUI(); });
          };
      }

      updateNotificationsUI();
      setInterval(updateNotificationsUI, 5000);
  });
  </script>

  <style>
  @keyframes slide-in {
      from { transform: translateX(100%); opacity: 0; }
      to { transform: translateX(0); opacity: 1; }
  }
  @keyframes slide-out {
      from { transform: translateX(0); opacity: 1; }
      to { transform: translateX(100%); opacity: 0; }
  }
  .animate-slide-in { animation: slide-in 0.5s ease-out forwards; }
  .animate-slide-out { animation: slide-out 0.5s ease-in forwards; }
  </style>
  @endauth
</script>

@hasSection('custom_js')
    @yield('custom_js')
@endif

@auth
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const vapidKey = "{{ config('webpush.vapid.public_key') }}";
            if (vapidKey && window.PushNotification) {
                const push = new PushNotification(vapidKey);
                push.init().then(() => {
                    push.showSoftPrompt();
                });
            }
        });
    </script>
@endauth
</body>
</html>
