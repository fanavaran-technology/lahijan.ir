@extends('app.clarification.layouts.app', ['title' => 'سامانه شفاف سازی - پروژه های سرمایه گذاری'])

@section('content')
    <div class="container mt-14">
        <p class="mb-2 text-lg md:text-xl lg:text-3xl text-center font-bold tracking-tight text-gray-900 underline">پروژه های سرمایه گذاری </p>
    </div>
    <div class="flex justify-center mt-6">
        <a href="{{ route('investments.index') }}" class="bg-gray-100 text-gray-800 text-xs font-medium mr-2 px-3 py-1 rounded border border-gray-500 {{ is_null(request('category')) ? 'bg-green-100 text-green-800' : '' }}">همه</a>
        @foreach($categories as $category)
            <a href="?category={{$category->title}}" class="bg-gray-100 text-gray-800 text-xs font-medium mr-2 px-3 py-1 rounded border border-gray-500 {{ request('category') == $category->title ? 'bg-green-100 text-green-800' : '' }}">{{ $category->title }}</a>
        @endforeach
    </div>

    <section class="min-h-screen">
        <section class="container grid grid-cols-12 gap-2 md:gap-4 lg:gap-6 my-16">
            @forelse ($investments as $investment)
                <div class="col-span-full sm:col-span-6 md:col-span-4 bg-white border border-gray-200 rounded-lg shadow">
                    <a href="#">
                        <img class="rounded-t-lg" src="{{ asset($investment->image) }}" alt="" />
                    </a>
                    <div class="p-5">
                        <a href="#">
                            <h5 class="mb-2 text-lg md:text-xl lg:text-2xl font-bold tracking-tight text-gray-900">{{ $investment->title }}</h5>
                        </a>
                        <div class="my-3 font-normal text-gray-700 space-y-2">
                            <div class="flex justify-between">
                                <div class="flex items-center mb-3 text-xs">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                    </svg>
                                    <span class="text-gray-500 font-sans">{{ $investment->position }}</span>
                                </div>
                                <span
                                    class="bg-green-100 text-green-800 text-xs font-medium h-5 mr-2 px-2.5 py-0.5 rounded whitespace-nowrap">{{ $investment->category->title }}</span>
                            </div>
                            <div class="flex justify-between">
                                <div>
                                    <span>تاریخ شروع:</span>
                                    <span class="text-gray-500 font-sans">{{ jalaliDate($investment->start_date) }}</span>
                                </div>
                                <div>
                                    <span>تاریخ پایان:</span>
                                    <span class="text-gray-500 font-sans">{{ jalaliDate($investment->end_date) }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-end mt-2">
                            <a href="{{ $investment->publicPath() }}"
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-indigo-500 rounded-lg hover:bg-indigo-600 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                 جزئیات بیشتر
                                <svg aria-hidden="true" class="w-4 h-4 mr-2 -ml-1 rotate-180" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="col-span-full text-center text-base text-gray-500">هیچ اطلاعاتی موجود نمی باشد.</p>
            @endforelse

            <section class="col-span-full overflow-x-hidden mt-10 flex justify-center">
                {{ $investments->appends($_GET)->render('vendor.pagination.tailwind') }}
            </section>
        </section>
    </section>
@endsection
