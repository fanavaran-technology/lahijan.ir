<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('assets/app/css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/app/css/fonts.css') }}">
    <script src="{{ asset('assets/app/js/app.js') }}"></script>

    <title>@yield('title')</title>

</head>

<body style="font-family: iransans">

@yield('content')

</body>

</html>
