@extends('app.fire-station.layouts.app', ['title' => 'آتش نشانی لاهیجان'])


@section('content')

    @include('app.fire-station.layouts.includes.slider')

    <section class="flex flex-col items-center  mt-16">
        <div class="font-shabnam relative font-bold text-gray-700 text-base md:text-lg">اخبار آتش نشانی</div>
        <div class="w-12 h-1 bg-[#FF0035] absolute mt-[12px] mr-[185px] rounded"></div>
        <div class="w-12 h-1 bg-[#FF0035] absolute mt-[12px] ml-[185px] rounded"></div>
    </section>

    <!-- Create By Joker Banny -->
    <div class="min-h-screen  flex justify-center items-center mt-10">
        <div class="md:px-4 md:grid md:grid-cols-2 lg:grid-cols-3 gap-5 space-y-4 md:space-y-0">
            @foreach($fireStations as $fireStation)
            <div
                class="max-w-sm bg-white px-6 pt-6 pb-2 rounded-xl shadow-lg transform hover:scale-105 transition duration-500">
                <h3 class="mb-3 text-sm font-bold text-indigo-600"></h3>
                <div class="relative">
                    <img class="w-full h-60 object-cover rounded-xl"
                         src="{{ asset($fireStation->image) }}"
                         alt="Colors"/>
                </div>
                <h1 class="mt-4 h-10 text-gray-800 text-lg font-bold cursor-pointer">{{ Str::limit($fireStation->title, 70, '...') }}</h1>
                <div class="my-4 mt-10">

                    <div class="flex space-x-1 items-center">
          <span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mx-2" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
          </span>
                        <p style="font-family: iransans">تاریخ : {{ jalaliDate($fireStation->created_at) }}</p>
                    </div>
                    <div class="w-full ">
                    <div class="flex justify-center">
                        <a href="{{ $fireStation->firePublicPath() }}" class="mt-4 text-center text-sm w-52 text-white bg-[#FF0035] py-2 rounded-xl shadow-lg">مشاهده بیشتر
                        </a>
                    </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>

    <section class="overflow-x-hidden my-10 flex justify-center">
        {{ $fireStations->appends($_GET)->render('vendor.pagination.tailwind') }}
    </section>





@endsection

