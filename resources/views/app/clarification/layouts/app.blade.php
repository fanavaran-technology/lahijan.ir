<!DOCTYPE html>
<html dir="rtl">

<head>
    @include('app.layouts.includes.head-tag')
    @yield('head-tag')

    <title>{{ $title ?? '<بدون عنوان>' }}</title>

</head>

<body class="font-vazir ">


@include('app.clarification.layouts.includes.top-nav')

@yield('content')


@include('app.clarification.layouts.includes.footer')



</body>

</html>
