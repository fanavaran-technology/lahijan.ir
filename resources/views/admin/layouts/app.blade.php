<!doctype html>
<html lang="en">

@include('admin.layouts.includes.head-tag')

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

</body>

</html>
