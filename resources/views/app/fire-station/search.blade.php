@extends('app.fire-station.layouts.app', ['title' => "نتایج جستجوی " . request('search') ])

@section('content')
    <section class="min-h-screen container mt-8 sm:mt-10">
        <section class="flex flex-wrap items-center space-x-2 space-x-reverse">
            <span class="text-md md:text-lg font-light mt-10">نتایج جستجو برای : </span>
            <span class="text-lg md:text-xl font-bold mt-10">{{ request('search') }}</span>
        </section>
        <section class="bg-white rounded-lg pb-4">

            <section class="grid grid-cols-12 gap-6 mt-5">
                @foreach ($results as $result)
                    <section
                        class="col-span-12 sm:col-span-6 lg:col-span-4 rounded-lg flex justify-between flex-col p-3 sm:p-4 md:p-6 shadow transition-all hover:shadow-lg mt-4">
                        <a href="{{ $result->publicPath() }}">
                            <img class="rounded-lg w-full h-44 object-cover" src="{{ asset($result->image) }}"
                                alt="{{ $result->title }}" />
                            <h5 class="text-gray-900 text-base md:text-base lg:text-lg font-medium my-4">
                                {{ Str::limit($result->title, 100, '...') }}
                            </h5>
                        </a>
                        <div class="w-full ">
                            <div class="flex justify-center">
                                <a href="{{ $result->firePublicPath() }}" class="mt-4 text-center text-sm w-52 text-white bg-[#FF0035] py-2 rounded-xl shadow-lg">مشاهده بیشتر
                                </a>
                            </div>
                        </div>
                        </div>
                    </section>
                @endforeach
            </section>
            @if($results->isEmpty())
                <h3 class="text-lg font-light text-center mt-5 text-gray-600">
                    متاسفانه هیچ نتیجه ای یافت نشد.
                </h3>
            @endif
            <section class="overflow-x-hidden mt-10 flex justify-center">
                {{ $results->appends($_GET)->render('vendor.pagination.tailwind') }}
            </section>
        </section>
    </section>
@endsection
