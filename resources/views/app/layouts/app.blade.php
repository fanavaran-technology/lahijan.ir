<!doctype html>
<html dir="rtl">

<head>
    @include('app.layouts.includes.head-tag')
    @yield('head-tag')
</head>

<body class="font-vazir">


    @include('app.layouts.includes.top-nav')

    @include('app.layouts.includes.navbar')

    @yield('content')

    @include('app.layouts.includes.footer')

    @include('app.layouts.includes.script')

    @yield('script')

</body>

</html>
