<!doctype html>
<html lang="en">

<head>
@include('admin.layouts.includes.head-tag')
{{-- add custom head items --}}
@yield('head-tag')

<title>
    @isset($title)
        {{ 'شهرداری لاهیجان |' . $title }}
    @endisset
</title>

</head>

<body class="vertical light rtl " style="font-family: vazir;">
    <div class=" wrapper">
        @include('admin.layouts.includes.navbar')

        @include('admin.layouts.includes.sidebar')

        <main role="main" class="main-content">
            
            <div class="container-fluid">
                @yield('content')
            </div> 

            @include('admin.layouts.includes.notifications')

        </main> <!-- main -->
    </div> <!-- .wrapper -->

    @include('admin.layouts.includes.script')
    {{-- add custom js --}}
    @yield('script')
</body>

</html>
