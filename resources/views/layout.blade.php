<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}"> {{-- Bootstrap CSS --}}
    <title>@yield('title')</title> {{-- Dynamic Title --}}
</head>
<body>
    <div class="container p-5">
        @yield('content') {{-- Dynamic Content --}}
    </div>
    <script src="{{ asset('js/bootstrap.bundle.js') }}"></script> {{-- Bootstrap JS --}}
</body>
</html>