@extends('app.clarification.layouts.app', ['title' => 'سامانه شفاف سازی - حقوق و دستمزد کارکنان'])

@section('content')
    <div class="container mt-14">
        <p class="text-gray-800 text-xl text-center underline font-bold">اطلاعات حقوق و مزایای کارمندان شهرداری لاهیجان</p>
        {{-- اطلاعات منتشر شده، شامل نام و نام خانوادگی، سابقه کاری،
            به همراه مبلغ فیش حقوقی، هر کارمند در این بخش میباشد< --}}
    </div>

    <section class="mt-10  flex  flex-col items-center space-y-2">
        <div class="text-center bg-green-600 w-80  text-gray-100  py-2 px-4 rounded-xl ">
            لیست حقوق و مزایا بر اساس سال و ماه
        </div>
    </section>

    <section class="mt-10 container flex  min-h-screen  flex-col space-y-6 ">
        @forelse ($salaries as $salary)
            <a href="{{ $salary->publicPath() }}"
                class="flex flex-wrap items-center bg-white hover:bg-gray-100/50 transition-all duration-100 drop-shadow-md border border-gray-100 w-full justify-between text-gray-100  py-2 px-4 rounded-xl ">
                <p class="mr-4 text-gray-800 font-semibold">{{ $salary->title }}</p>
                <div class=" items-center md:order-2 md:flex hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6 mt-1  text-blue-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                    </svg>
                </div>
            </a>
        @empty
            <p>هیچ اطلاعاتی موجود نمی باشد.</p>
        @endforelse
    </section>
@endsection
