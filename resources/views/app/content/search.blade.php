@extends('app.layouts.app', ['title' => "نتیجه جستجوی {{ request('search') }}"])

@section('content')
    <section class="min-h-screen container mt-8 sm:mt-10">
        <section class="flex items-center space-x-2 space-x-reverse">
            <span class="text-md md:text-lg font-light">نتایج جستجو برای : </span>
            <span class="text-lg md:text-xl font-bold">{{ request('search') }}</span>
        </section>
        <section class="bg-white rounded-lg pb-4">
            <section>
                <ul
                    class="flex flex-wrap p-3 mt-7 items-center bg-slate-50 border rounded-lg text-sm font-medium text-center text-gray-500">
                    <li>
                        <a href="{{ request()->fullUrlWithQuery(['type' => 'news']) }}"
                            class="py-3 px-2 lg:px-4 flex items-center justify-center text-lg font-light space-x-2 space-x-reverse group {{ request('type') == 'news' || empty(request('type')) ? 'active-tab bg-blue-500 hover:bg-blue-500' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
                            </svg>
                            <span>اخبار</span>
                        </a>
                    </li>
                    <li class="mr-2">
                        <a href="{{ request()->fullUrlWithQuery(['type' => 'public_calls']) }}"
                            class="py-3 px-2 lg:px-4 flex items-center justify-center text-lg font-light space-x-2 space-x-reverse group {{ request('type') == 'public_calls' ? 'active-tab bg-blue-500 hover:bg-blue-500' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 110-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.117-1.527-.461a20.845 20.845 0 01-1.44-4.282m3.102.069a18.03 18.03 0 01-.59-4.59c0-1.586.205-3.124.59-4.59m0 9.18a23.848 23.848 0 018.835 2.535M10.34 6.66a23.847 23.847 0 008.835-2.535m0 0A23.74 23.74 0 0018.795 3m.38 1.125a23.91 23.91 0 011.014 5.395m-1.014 8.855c-.118.38-.245.754-.38 1.125m.38-1.125a23.91 23.91 0 001.014-5.395m0-3.46c.495.413.811 1.035.811 1.73 0 .695-.316 1.317-.811 1.73m0-3.46a24.347 24.347 0 010 3.46" />
                            </svg>

                            <span>فراخوان ها</span>
                        </a>
                    </li>
                    <li class="mr-2">
                        <a href="{{ request()->fullUrlWithQuery(['type' => 'places']) }}"
                            class="py-3 px-2 lg:px-4 flex items-center justify-center text-lg font-light space-x-2 space-x-reverse group {{ request('type') == 'places' ? 'active-tab bg-blue-500 hover:bg-blue-500' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M20.893 13.393l-1.135-1.135a2.252 2.252 0 01-.421-.585l-1.08-2.16a.414.414 0 00-.663-.107.827.827 0 01-.812.21l-1.273-.363a.89.89 0 00-.738 1.595l.587.39c.59.395.674 1.23.172 1.732l-.2.2c-.212.212-.33.498-.33.796v.41c0 .409-.11.809-.32 1.158l-1.315 2.191a2.11 2.11 0 01-1.81 1.025 1.055 1.055 0 01-1.055-1.055v-1.172c0-.92-.56-1.747-1.414-2.089l-.655-.261a2.25 2.25 0 01-1.383-2.46l.007-.042a2.25 2.25 0 01.29-.787l.09-.15a2.25 2.25 0 012.37-1.048l1.178.236a1.125 1.125 0 001.302-.795l.208-.73a1.125 1.125 0 00-.578-1.315l-.665-.332-.091.091a2.25 2.25 0 01-1.591.659h-.18c-.249 0-.487.1-.662.274a.931.931 0 01-1.458-1.137l1.411-2.353a2.25 2.25 0 00.286-.76m11.928 9.869A9 9 0 008.965 3.525m11.928 9.868A9 9 0 118.965 3.525" />
                            </svg>
                            <span>مکان های گردشگری</span>
                        </a>
                    </li>
                    <li class="mr-2">
                        <a href="{{ request()->fullUrlWithQuery(['type' => 'pages']) }}"
                            class="py-3 px-2 lg:px-4 flex items-center justify-center text-lg font-light space-x-2 space-x-reverse group {{ request('type') == 'pages' ? 'active-tab bg-blue-500 hover:bg-blue-500' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                            </svg>
                            <span>دیگر صفحات</span>
                        </a>
                    </li>
                </ul>
            </section>

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
                        <section class="flex justify-between items-center">
                            @if ($result->user)
                            <div class="flex flex-col sm:flex-row justify-center items-center sm:space-x-4">
                                <img class="w-10 h-10 rounded-full object-cover"
                                    src="{{ asset($result->user->profile_image) }}" alt="">
                                <div class="font-medium">
                                    <div class="text-xs sm:text-sm text-gray-600 mx-2 text-center">
                                        {{ $result->user->full_name }}
                                    </div>
                                    <div class="text-gray-500 text-xs mx-2">
                                        {{ jalaliDate($result->created_at, '%d %B، %Y') }}
                                    </div>
                                </div>
                            </div>
                            @endif
                            <a href="{{ $result->publicPath() }}" class="flex items-center">
                                <span
                                    class="text-green-600 text-sm sm:text-base transition-all hover:text-green-700 hover:mx-2">بیشتر
                                    بخوانید</span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mt-1     text-blue-500">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                                </svg>
                            </a>
                        </section>
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
