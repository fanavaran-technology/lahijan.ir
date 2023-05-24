<!doctype html>
<html dir="rtl">

<head>
    @include('app.layouts.includes.head-tag')
    @yield('head-tag')
    <title>{{ $title ?? '<بدون عنوان>' }}</title>
</head>

<body class="font-vazir bg-gradient-to-tr from-red-50 to-white overflow-x-hidden">


    @include('app.fire-station.layouts.includes.top-nav')

    @include('app.fire-station.layouts.includes.navbar')

    @yield('content')

    @include('app.fire-station.layouts.includes.footer')

    @include('app.fire-station.layouts.includes.script')

    @yield('script')

</body>

</html>
