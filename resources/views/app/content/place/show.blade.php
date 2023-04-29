@extends('app.layouts.app', ['title' => "$place->title"])

@section('head-tag')
    <link rel="stylesheet" href="{{ asset('assets/app/plugins/viewer/css/viewer.min.css') }}">
@endsection

@section('content')
    <section class="mt-5 min-h-screen">
        <section class="grid grid-cols-12">
            <section class="col-span-12 md:col-span-9 md:ml-2">
                <section class="my-4 bg-gray-50 bg-opacity-50 p-4 md:p-8 text-gray-700 shadow-sm rounded">
                    <section class="flex flex-wrap lg:flex-nowrap space-y-4 md:space-y-4 justify-between gap-2 items-center">
                        <section class="space-y-4 w-screen lg:w-4/6">
                            <!-- title -->
                            <section class="text-lg md:text-2xl text-gray-700 font-bold">{{ $place->title }}</section>
                            <!-- utility -->
                            <section class="flex items-center space-x-3 space-x-reverse text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mx-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span class="text-sm">{{ jalaliDate($place->created_at, '%d %B، %Y') }}</span>
                            </section>
                        </section>
                        <img src="{{ asset($place->image) }}" class="w-full lg:w-2/6 h-5/6 object-cover rounded-lg"
                            alt="{{ $place->title }}">
                    </section>
                    <article class="py-6 text-gray-600 text-sm lg:text-base leading-8 lg:leading-10">
                        {!! $place->description !!}
                    </article>
                    <section>
                        @if ($place->gallerizable->isNotEmpty())
                            <section class="my-4 sm:my-8">
                                <ul id="images" class="grid grid-cols-4 gap-2">
                                    @foreach ($place->gallerizable as $gallery)
                                        <li class="col-span-4 sm:col-span-2 lg:col-span-1">
                                            <img class="object-cover w-full h-48 lg:h-32"
                                                src="{{ asset($gallery->image) }}" alt="{{ $gallery->alt }}"
                                                alt="Picture 1">
                                        </li>
                                    @endforeach
                                </ul>
                            </section>
                        @endif
                    </section>
                </section>
            </section>
            <aside class="col-span-12 md:col-span-3 mx-4 md:mx-2 space-y-4">
                <section class="overflow-y-auto px-0 bg-gray-100 shadow-sm bg-opacity-50 rounded">
                    <section class="flex text-gray-700 items-center px-2 py-4 border-b px-2">
                        <span class="font-semibold text-sm">اطلاعات جاذبه گردشگری</span>
                    </section>
                    <span class="font-normal text-sm m-3 flex">
                     <svg  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                    </svg>
                        <p class="mt-2 mr-1">{{ $place->location }}</p>
                    </span>

                </section>
            </aside>
        </section>
    </section>
@endsection

@section('script')
    <script src="{{ asset('assets/app/plugins/viewer/js/viewer.min.js') }}"></script>
    <script>
        new Viewer(document.getElementById('images'));
    </script>
@endsection
