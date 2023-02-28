@extends('app.layouts.app', ['title' => 'شهرداری لاهیجان | مکان های گردشگری'])

@section('head-tag')
    <link rel="stylesheet" href="{{ asset('assets/app/plugins/datepicker/datepicker.min.css') }}">
@endsection

@section('content')
    <section class="container mt-5 min-h-screen">
        <section class="text-xl sm:text-2xl md:text-2xl font-bold mt-10 text-gray-700">
            مکان های گردشگری
        </section>
        <section class="grid grid-cols-12 gap-6">
        @foreach($places as $place)
        <div class="rounded overflow-hidden shadow-lg col-span-12 sm:col-span-6 lg:col-span-4 mt-5 flex justify-center justify-between flex-col ">
            <img class="w-full h-48 object-cover" src="{{ $place->image }}" alt="{{ $place->title }}">
            <div class="px-6 py-10">
                <div class="font-bold text-xl mb-2">{{ $place->title }}</div>
                <p class="text-gray-700 text-sm">
                    {!! Str::limit($place->description, 200, '...') !!}
                </p>
            </div>
            <section class="flex justify-between items-center mt-3">
                <div class="flex flex-col sm:flex-row justify-center items-center mt-4 sm:space-x-4">
                    <div class="font-medium ">
                        <div class="text-gray-500 text-xs mb-5 mr-3 mx-2" style="font-family: iransans;">{{ jalaliDate($place->published_at) }}</div>
                    </div>
                </div>
                <a href="{{ $place->publicPath() }}" class="flex items-center ml-3 mb-3 bottom-2">
                        <span
                            class="text-green-600 text-sm sm:text-base transition-all hover:text-green-700 hover:mx-2">بیشتر
                            بخوانید</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke-width="1.5" stroke="currentColor"
                         class="w-6 h-6 mt-1     text-blue-500">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                    </svg>
                </a>
            </section>
        </div>
        @endforeach
        </section>
    </section>
@endsection

@section('script')
    <script src="{{ asset('assets/app/plugins/datepicker/datepicker.min.js') }}"></script>
    <script>
        jalaliDatepicker.startWatch({
            maxDate: 'today',
            selector: ".datepicker",
            time: false
        });
    </script>

@endsection
