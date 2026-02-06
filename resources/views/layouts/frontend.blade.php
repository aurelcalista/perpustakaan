<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Perpustakaan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    @include('layouts.frontend-navbar')

    <main>
        @yield('content')
    </main>

    @include('layouts.frontend-footer')

</body>
</html>
