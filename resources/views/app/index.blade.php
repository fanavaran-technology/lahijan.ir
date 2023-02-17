@extends('app.layouts.app' , ['title' => 'شهرداری لاهیجان | صفحه اصلی'])

@section('content')
    @include('app.layouts.includes.slider')

    <section class="container mt-5">

        <!-- section title -->
        @include('app.includes.title', ['title' => 'خدمات پر کاربرد'])
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

    @include('app.includes.statistics')

    @include('app.includes.title', ['title' => 'اماکن گردشگری'])
    @include('app.includes.places')
@endsection

@section('script')
    <script>
        let subsOdometr = document.querySelector(".subs-odometrs");

        var odometer = new Odometer({
            el: subsOdometr,

        })

        subsOdometr.innerHTML = 141;
    </script>

    <script>
        var subsOdometr1 = document.querySelector(".subs-odometrs1");

        var odometer = new Odometer({
            el: subsOdometr1,

        })

        subsOdometr1.innerHTML = 88;
    </script>

    <script>
        var subsOdometr2 = document.querySelector(".subs-odometrs2");

        var odometer = new Odometer({
            el: subsOdometr2,

        })

        subsOdometr2.innerHTML = 1131;
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
