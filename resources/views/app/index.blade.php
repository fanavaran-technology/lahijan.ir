@extends('app.layouts.app' , ['title' => 'شهرداری لاهیجان | صفحه اصلی'])

@section('content')
    @include('app.layouts.includes.slider')

    <section class="container mt-5">

        <!-- section title -->
        @include('app.includes.title', ['title' => 'دسترسی سریع'])
        <!-- start useful services -->
        @include('app.includes.useful-services')

        <section class="grid grid-cols-12 mt-24 gap-4 md:gap-8">
            @include('app.includes.latest-news')
            <section class="col-span-12 md:col-span-5 space-y-3">
                @include('app.includes.tab')
                @include('app.includes.public-calls')
                @include('app.includes.virtual-tour')
                @include('app.includes.quick-access')
            </section>
        </section>
    </section>

    @include('app.includes.mayor-speech')



    @include('app.includes.statistics')

    <div class="md:py-10 px-20">
        @include('app.includes.theater')
    </div>

    @include('app.includes.title', ['title' => 'اماکن گردشگری'])
    @include('app.includes.places')
@endsection

@section('script')


    <script>
      $.appear("#ws-counter", {});
      $('#ws-counter').on("appear", function(){
        document.getElementById("counter1").innerHTML = 101073;
        document.getElementById("counter2").innerHTML = 1428;
        document.getElementById("counter3").innerHTML = 181;
      });
    </script>

    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    </script>
@endsection
