<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Login</title>
    <link rel="stylesheet" href="{{asset('css/template-login.css')}}">
    
</head>
<body>
      @yield('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if(session('status'))
    <script>
    Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'success',
        title: "{{ session('status') }}",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true
    });
    </script>
    @endif

    @if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: "{{ session('error') }}",
        });
    </script>
    @endif

</body>
</html>