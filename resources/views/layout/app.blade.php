<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.header')
</head>
<body>
    @include('partials.navbar')
    <main>
        @yield('content')
    </main>
    
    @include('partials.footer')
</body>
</html>