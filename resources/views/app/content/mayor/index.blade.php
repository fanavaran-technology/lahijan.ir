@extends('app.layouts.app', ['title' => 'شهرداری لاهیجان | شهردارن پیشین'])


@section('content')
    <section class="container mt-5 min-h-screen">
        <div class="container my-7">
            <p class="text-gray-800 text-xl text-center underline font-bold">شهرداران پیشین لاهیجان</p>
        </div>

        <div class="grid grid-cols-12 justify-items-center gap-4">
            @foreach($mayors as $mayor)
                <div style="font-family: iransans" class="w-full group bg-gray-200 rounded-md  transition duration-500 ease-in-out transform hover:-translate-y-1 hover:shadow-lg lg:col-span-4 md:col-span-6 col-span-12 max-w-sm bg-white border border-gray-200 rounded-lg shadow d">
                    <div class="flex justify-end px-4 pt-4">
                    </div>
                    <div class="flex flex-col items-center pb-">
                        <img class="w-24 h-24 mb-3 object-cover rounded-full shadow-lg" src="{{ asset($mayor->image) }}" alt="Bonnie image"/>
                        <h5 class="mb-1 text-xl mb-5 font-medium text-gray-900">{{ $mayor->full_name }}</h5>
                    </div>
                    <div class="flex justify-between mb-5">
                        <span class="text-sm mr-3 text-gray-500" >تاریخ تولد : {{ jalaliDate($mayor->birthdate) }}</span>
                        <span class="text-sm ml-3 text-gray-500 ">تاریخ انتصاب : {{ jalaliDate($mayor->recruitment) }}</span>
                    </div>
                    <div class="flex justify-between mb-5">
                        <span class="text-sm mr-3 text-gray-500">محل تولد : {{ $mayor->place_birth }}</span>
                        <span class="text-sm ml-3 text-gray-500">مدت مسئولیت : {{ $mayor->term_responsibility }}</span>
                    </div>
                </div>
            @endforeach
        </div>

    </section>
@endsection

