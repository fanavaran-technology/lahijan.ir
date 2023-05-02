<!doctype html>
<html dir="rtl">

<head>
    @include('app.layouts.includes.head-tag')
    @yield('head-tag')
    <title>{{ $title ?? '<بدون عنوان>' }}</title>
</head>

<body class="font-vazir bg-gray-50 overflow-x-hidden">


    @include('app.layouts.includes.top-nav')

    @include('app.layouts.includes.navbar')

    @yield('content')

    @include('app.layouts.includes.footer')

    @include('app.layouts.includes.script')

    @yield('script')

</body>

</html>
