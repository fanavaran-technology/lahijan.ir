  <!-- start slider -->
{{--  <div id="carouselDarkVariant" class="carousel slide carousel-fade carousel-dark relative overflow-x-hidden"--}}
{{--    data-bs-ride="carousel">--}}
{{--    <div id="slider-content"--}}
{{--      class="carousel-inner relative w-full md:h-[500px] lg:h-[500px] sm:h-[400px] h-[200px] overflow-hidden">--}}
{{--      @forelse ($sliders as $slider)--}}
{{--      <div class="carousel-item active relative float-left w-full ">--}}
{{--        <img src="{{ asset($slider->image) }}"--}}
{{--          class="block w-full md:h-[500px] lg:h-[500px] sm:h-[400px] h-[200px] object-cover" alt="Motorbike Smoke" />--}}
{{--      </div>--}}
{{--      @empty--}}
{{--        <p>وجود ندارد</p>--}}
{{--      @endforelse--}}
{{--      <!-- Single item -->--}}


{{--      <!-- Single item -->--}}
{{--      <div class="carousel-item relative float-left w-full ">--}}
{{--        <img src="../assets/images/round_pool.jpg"--}}
{{--          class="block w-full  md:h-[500px] lg:h-[500px] sm:h-[400px] h-[200px] object-cover"--}}
{{--          alt="Woman Reading a Book" />--}}

{{--      </div>--}}
{{--    </div>--}}
{{--    <button--}}
{{--      class="carousel-control-prev absolute top-0 bottom-0 flex items-center justify-center p-0 text-center border-0 hover:outline-none hover:no-underline focus:outline-none focus:no-underline left-0"--}}
{{--      type="button" data-bs-target="#carouselDarkVariant" data-bs-slide="prev">--}}
{{--      <span class="carousel-control-prev-icon inline-block bg-no-repeat" aria-hidden="true"></span>--}}
{{--      <span class="visually-hidden">Previous</span>--}}
{{--    </button>--}}
{{--    <button--}}
{{--      class="carousel-control-next absolute top-0 bottom-0 flex items-center justify-center p-0 text-center border-0 hover:outline-none hover:no-underline focus:outline-none focus:no-underline right-0"--}}
{{--      type="button" data-bs-target="#carouselDarkVariant" data-bs-slide="next">--}}
{{--      <span class="carousel-control-next-icon inline-block bg-no-repeat" aria-hidden="true"></span>--}}
{{--      <span class="visually-hidden">Next</span>--}}
{{--    </button>--}}
{{--  </div>--}}
  <!--end start slider -->




<div id="default-carousel" class="relative" data-carousel="static">
    <!-- Carousel wrapper -->
    <div class="relative md:h-[500px] lg:h-[500px] sm:h-[400px] h-[200px] overflow-hidden ">
        <!-- Item 1 -->
        @foreach($sliders as $slider)
        <div class="hidden duration-700 ease-in-out " data-carousel-item>
            <span class="absolute text-2xl font-semibold text-white -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 sm:text-3xl ">First Slide</span>
            <img src="{{ $slider->image }}" class="absolute block  w-full md:h-[500px] lg:h-[500px] sm:h-[400px] h-[200px] object-cover" alt="...">
        </div>
        @endforeach
    </div>

    <div class="">
        <button type="button" class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 group-hover:bg-white/50  group-focus:ring-2 group-focus:ring-white  group-focus:outline-none">
            <svg aria-hidden="true" class="w-5 h-5 text-white sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
        </span>
        </button>
        <button type="button" class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30  group-hover:bg-white/50  group-focus:ring-2 group-focus:ring-white  group-focus:outline-none">
            <svg aria-hidden="true" class="w-5 h-5 text-white sm:w-6 sm:h-6 " fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        </span>
        </button>
    </div>
</div>



