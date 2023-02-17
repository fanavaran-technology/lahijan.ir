<!DOCTYPE html>
<html dir="rtl" lang="fa-IR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/app/css/fonts.css') }}">
    <link href="{{ asset('assets/app/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/app/css/login.css') }}" rel="stylesheet">
    
    <script src="{{ asset('assets/app/js/app.js') }}" defer></script>
    <title>{{ $title ?? '<بدون عنوان>' }}</title>
</head>

<body class="font-vazir">

    @yield('content')

    @yield('script')
</body>

</html>