<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Superadmin Panel' }}</title>

    @stack('styles')

    @include('layouts.superadmin.partials.head')
</head>

<body>
    <div id="app">
        @yield('content')
    </div>

    @include('layouts.superadmin.partials.scripts')

    @stack('scripts')
</body>

</html>