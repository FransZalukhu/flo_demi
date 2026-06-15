<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>{{ $pageTitle ?? 'Admin Dashboard' }} — Flodemi</title>
<meta name="description" content="Dashboard Superadmin Flodemi">
<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="icon" type="image/png" href="{{ asset('images/f.png') }}">

{{-- Google Fonts: Manrope --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

{{-- Remix Icon --}}
<link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">

{{-- FontAwesome --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

@vite(['resources/css/app.css', 'resources/js/push-notification.js'])

{{-- Theme script to prevent flickering --}}
<script>
    (function() {
        const storedTheme = localStorage.getItem('flodemi-theme');
        if (storedTheme === 'dark' || (!storedTheme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.setAttribute('data-theme', 'dark');
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.removeAttribute('data-theme');
            document.documentElement.classList.remove('dark');
        }
    })();
</script>