{{--@extends('app.layouts.app', ['title' => 'شهرداری لاهیجان | فرم ثبت شکایات'])--}}

@section('head-tag')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <style>
        .dropzone {
            border: 2px dashed #ccc;
            border-radius: .5rem;
        }

        input[type=number] {
            direction: ltr !important;
        }

        .modal {
            transition: opacity 0.25s ease;
        }
    </style>
@endsection

@section('content')
    <section class="min-h-screen wrapper">
        <form action="{{ route('complaints.store') }}" method="post" id="complaint_form">
            @csrf

            <section class="min-h-screen">
                <section class="text-center md:w-8/12 mx-3 md:mx-auto mt-14 flex flex-wrap justify-between items-center">
                        <h1tracking
                            class="text-xl font-shabnam font-extrabold leading-none tracking-tight text-gray-700 md:text-2xl lg:text-3xl">
                            فرم ثبت شکایات
                        </h1tracking>
                    </div>
                    <a href="{{ route('complaints..index') }}" class="focus:outline-none text-white bg-rose-700 hover:bg-rose-800 focus:ring-4 focus:ring-rose-300 font-medium rounded-lg text-xs px-5 py-2.5">پیگیری شکایت</a>
                </section>
                <section class="md:w-8/12 bg-white shadow-sm p-3 my-3 md:my-8 mx-1.5 sm:mx-3 md:mx-auto rounded-3xl">
                    <div id="alert-success"
                        class="p-4 mb-4 text-green-800 border border-green-300 rounded-lg bg-green-50 hidden suc-alert"
                        role="alert">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6 ml-2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>

                            <h3 class="text-lg font-medium suc-mes-title"></h3>
                        </div>
                        <div class="mt-2 mb-4 text-sm suc-mes-desc">

                        </div>
                    </div>

                    <section class="my-6 flex items-center space-x-2 space-x-reverse text-rose-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z" />
                        </svg>
                        <span>اطلاعات هویتی</span>
                    </section>

                    <section class="grid grid-cols-12 gap-2.5 mt-4">
                        {{-- first name --}}
                        <section class="col-span-full md:col-span-6 lg:col-span-3">
                            <div class="relative w-full group">
                                <input type="text" name="first_name" value="{{ old('first_name') }}" autofocus
                                    class="border-none w-full focus:border-none focus:ring-0 outline-none px-3 py-3 peer"
                                    placeholder=" " />

                                <label
                                    class="absolute right-[9px] top-px text-sm text-gray-500 transition-all duration-300 px-1 transform -translate-y-1/2 pointer-events-none
                                    peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-md group-focus-within:!top-px group-focus-within:!text-sm group-focus-within:!text-rose-500">نام
                                    *
                                </label>

                                <fieldset
                                    class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] invisible peer-placeholder-shown:visible
                                    group-focus-within:!border-rose-500 group-focus-within:border-2 group-hover:border-gray-700">
                                    <legend
                                        class="mr-2 px-0 text-sm transition-all duration-300 invisible max-w-[0.01px] group-focus-within:max-w-full group-focus-within:px-1 whitespace-nowrap">
                                        نام *
                                    </legend>
                                </fieldset>

                                <fieldset
                                    class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] visible peer-placeholder-shown:invisible
                                    group-focus-within:border-2 group-focus-within:!border-rose-500 group-hover:border-gray-700">
                                    <legend class="mr-2 text-sm invisible px-1 max-w-full whitespace-nowrap">نام *
                                    </legend>
                                </fieldset>
                            </div>
                            <span class="text-red-500 font-bold text-xs er-first_name"></span>
                        </section>

                        {{-- last name --}}
                        <section class="col-span-full md:col-span-6 lg:col-span-3">
                            <div class="relative w-full group">
                                <input type="text" name="last_name" value="{{ old('last_name') }}"
                                    class="border-none w-full focus:border-none focus:ring-0 outline-none px-3 py-3 peer"
                                    placeholder=" " />

                                <label
                                    class="absolute right-[9px] top-px text-sm text-gray-500 transition-all duration-300 px-1 transform -translate-y-1/2 pointer-events-none
                                    peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-md group-focus-within:!top-px group-focus-within:!text-sm group-focus-within:!text-rose-500">
                                    نام خانوادگی *
                                </label>

                                <fieldset
                                    class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] invisible peer-placeholder-shown:visible
                                    group-focus-within:!border-rose-500 group-focus-within:border-2 group-hover:border-gray-700">
                                    <legend
                                        class="mr-2 px-0 text-sm transition-all duration-300 invisible max-w-[0.01px] group-focus-within:max-w-full group-focus-within:px-1 whitespace-nowrap">
                                        نام خانوادگی *
                                    </legend>
                                </fieldset>

                                <fieldset
                                    class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] visible peer-placeholder-shown:invisible
                                    group-focus-within:border-2 group-focus-within:!border-rose-500 group-hover:border-gray-700">
                                    <legend class="mr-2 text-sm invisible px-1 max-w-full whitespace-nowrap">نام
                                        خانوادگی *
                                    </legend>
                                </fieldset>
                            </div>
                            <span class="text-red-500 font-bold text-xs er-last_name"></span>
                        </section>

                        {{-- national code --}}
                        <section class="col-span-full md:col-span-6 lg:col-span-3">
                            <div class="relative w-full group">
                                <input type="number" name="national_code" value="{{ old('national_code') }}"
                                    class="border-none w-full focus:border-none focus:ring-0 outline-none px-3 py-3 peer"
                                    placeholder=" " />

                                <label
                                    class="absolute right-[9px] top-px text-sm text-gray-500 transition-all duration-300 px-1 transform -translate-y-1/2 pointer-events-none
                                    peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-md group-focus-within:!top-px group-focus-within:!text-sm group-focus-within:!text-rose-500">کد
                                    ملی *</label>

                                <fieldset
                                    class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] invisible peer-placeholder-shown:visible
                                    group-focus-within:!border-rose-500 group-focus-within:border-2 group-hover:border-gray-700">
                                    <legend
                                        class="mr-2 px-0 text-sm transition-all duration-300 invisible max-w-[0.01px] group-focus-within:max-w-full group-focus-within:px-1 whitespace-nowrap">
                                        کد ملی *
                                    </legend>
                                </fieldset>

                                <fieldset
                                    class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] visible peer-placeholder-shown:invisible
                                    group-focus-within:border-2 group-focus-within:!border-rose-500 group-hover:border-gray-700">
                                    <legend class="mr-2 text-sm invisible px-1 max-w-full whitespace-nowrap">کد ملی *
                                    </legend>
                                </fieldset>
                            </div>
                            <span class="text-red-500 font-bold text-xs er-national_code"></span>
                        </section>

                        {{-- phone number --}}
                        <section class="col-span-full md:col-span-6 lg:col-span-3">
                            <div class="relative w-full group">
                                <input type="number" name="phone_number" value="{{ old('phone_number') }}"
                                    class="border-none w-full focus:border-none focus:ring-0 outline-none px-3 py-3 peer"
                                    placeholder=" " />

                                <label
                                    class="absolute right-[9px] top-px text-sm text-gray-500 transition-all duration-300 px-1 transform -translate-y-1/2 pointer-events-none
                                    peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-md group-focus-within:!top-px group-focus-within:!text-sm group-focus-within:!text-rose-500">شماره
                                    تلفن *</label>
                                <fieldset
                                    class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] invisible peer-placeholder-shown:visible
                                    group-focus-within:!border-rose-500 group-focus-within:border-2 group-hover:border-gray-700">
                                    <legend
                                        class="mr-2 px-0 text-sm transition-all duration-300 invisible max-w-[0.01px] group-focus-within:max-w-full group-focus-within:px-1 whitespace-nowrap">
                                        شماره تلفن *
                                    </legend>
                                </fieldset>

                                <fieldset
                                    class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] visible peer-placeholder-shown:invisible
                                    group-focus-within:border-2 group-focus-within:!border-rose-500 group-hover:border-gray-700">
                                    <legend class="mr-2 text-sm invisible px-1 max-w-full whitespace-nowrap">شماره تلفن
                                        *
                                    </legend>
                                </fieldset>
                            </div>
                            <span class="text-red-500 font-bold text-xs er-phone_number"></span>
                        </section>
                    </section>
                    <section class="my-4 flex items-center space-x-2 space-x-reverse text-rose-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                        </svg>
                        <span>آدرس</span>
                    </section>

                    <section class="grid grid-cols-12 gap-2.5">
                        {{-- main st --}}
                        <section class="col-span-full md:col-span-6">
                            <div class="relative w-full group">
                                <input type="text" name="main_st" value="{{ old('main_st') }}"
                                    class="border-none w-full focus:border-none focus:ring-0 outline-none px-3 py-3 peer"
                                    placeholder=" " />

                                <label
                                    class="absolute right-[9px] top-px text-sm text-gray-500 transition-all duration-300 px-1 transform -translate-y-1/2 pointer-events-none
                                    peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-md group-focus-within:!top-px group-focus-within:!text-sm group-focus-within:!text-rose-500">خیابان
                                    اصلی *</label>

                                <fieldset
                                    class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] invisible peer-placeholder-shown:visible
                                    group-focus-within:!border-rose-500 group-focus-within:border-2 group-hover:border-gray-700">
                                    <legend
                                        class="mr-2 px-0 text-sm transition-all duration-300 invisible max-w-[0.01px] group-focus-within:max-w-full group-focus-within:px-1 whitespace-nowrap">
                                        خیابان اصلی *
                                    </legend>
                                </fieldset>

                                <fieldset
                                    class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] visible peer-placeholder-shown:invisible
                                    group-focus-within:border-2 group-focus-within:!border-rose-500 group-hover:border-gray-700">
                                    <legend class="mr-2 text-sm invisible px-1 max-w-full whitespace-nowrap">خیابان اصلی
                                        *
                                    </legend>
                                </fieldset>
                            </div>
                            <span class="text-red-500 font-bold text-xs er-main_st"></span>
                        </section>

                        {{-- aux.. st --}}
                        <section class="col-span-full md:col-span-6">
                            <div class="relative w-1/ group">
                                <input type="text" name="auxiliary_st" value="{{ old('auxiliary_st') }}"
                                    class="border-none w-full focus:border-none focus:ring-0 outline-none px-3 py-3 peer"
                                    placeholder=" " />

                                <label
                                    class="absolute right-[9px] top-px text-sm text-gray-500 transition-all duration-300 px-1 transform -translate-y-1/2 pointer-events-none
                                    peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-md group-focus-within:!top-px group-focus-within:!text-sm group-focus-within:!text-rose-500">خیابان
                                    فرعی</label>

                                <fieldset
                                    class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] invisible peer-placeholder-shown:visible
                                    group-focus-within:!border-rose-500 group-focus-within:border-2 group-hover:border-gray-700">
                                    <legend
                                        class="mr-2 px-0 text-sm transition-all duration-300 invisible max-w-[0.01px] group-focus-within:max-w-full group-focus-within:px-1 whitespace-nowrap">
                                        خیابان فرعی
                                    </legend>
                                </fieldset>

                                <fieldset
                                    class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] visible peer-placeholder-shown:invisible
                                    group-focus-within:border-2 group-focus-within:!border-rose-500 group-hover:border-gray-700">
                                    <legend class="mr-2 text-sm invisible px-1 max-w-full whitespace-nowrap">خیابان فرعی
                                    </legend>
                                </fieldset>
                            </div>
                            <span class="text-red-500 font-bold text-xs er-auxiliary_st"></span>
                        </section>

                        {{-- alley --}}
                        <section class="col-span-full md:col-span-6 lg:col-span-3">
                            <div class="relative w-full group">
                                <input type="text" name="alley" value="{{ old('alley') }}"
                                    class="border-none w-full focus:border-none focus:ring-0 outline-none px-3 py-3 peer"
                                    placeholder=" " />

                                <label
                                    class="absolute right-[9px] top-px text-sm text-gray-500 transition-all duration-300 px-1 transform -translate-y-1/2 pointer-events-none
                                    peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-md group-focus-within:!top-px group-focus-within:!text-sm group-focus-within:!text-rose-500">کوچه</label>

                                <fieldset
                                    class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] invisible peer-placeholder-shown:visible
                                    group-focus-within:!border-rose-500 group-focus-within:border-2 group-hover:border-gray-700">
                                    <legend
                                        class="mr-2 px-0 text-sm transition-all duration-300 invisible max-w-[0.01px] group-focus-within:max-w-full group-focus-within:px-1 whitespace-nowrap">
                                        کوچه
                                    </legend>
                                </fieldset>

                                <fieldset
                                    class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] visible peer-placeholder-shown:invisible
                                    group-focus-within:border-2 group-focus-within:!border-rose-500 group-hover:border-gray-700">
                                    <legend class="mr-2 text-sm invisible px-1 max-w-full whitespace-nowrap">کوچه
                                    </legend>
                                </fieldset>
                            </div>
                            <span class="text-red-500 font-bold text-xs er-alley"></span>
                        </section>

                        {{-- deadend --}}
                        <section class="col-span-full md:col-span-6 lg:col-span-3">
                            <div class="relative w-1/ group">
                                <input type="text" name="deadend" value="{{ old('deadend') }}"
                                    class="border-none w-full focus:border-none focus:ring-0 outline-none px-3 py-3 peer"
                                    placeholder=" " />

                                <label
                                    class="absolute right-[9px] top-px text-sm text-gray-500 transition-all duration-300 px-1 transform -translate-y-1/2 pointer-events-none
                                    peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-md group-focus-within:!top-px group-focus-within:!text-sm group-focus-within:!text-rose-500">بن
                                    بست</label>

                                <fieldset
                                    class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] invisible peer-placeholder-shown:visible
                                    group-focus-within:!border-rose-500 group-focus-within:border-2 group-hover:border-gray-700">
                                    <legend
                                        class="mr-2 px-0 text-sm transition-all duration-300 invisible max-w-[0.01px] group-focus-within:max-w-full group-focus-within:px-1 whitespace-nowrap">
                                        بن بست
                                    </legend>
                                </fieldset>

                                <fieldset
                                    class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] visible peer-placeholder-shown:invisible
                                    group-focus-within:border-2 group-focus-within:!border-rose-500 group-hover:border-gray-700">
                                    <legend class="mr-2 text-sm invisible px-1 max-w-full whitespace-nowrap">بن بست
                                    </legend>
                                </fieldset>
                            </div>
                            <span class="text-red-500 font-bold text-xs er-deadend"></span>
                        </section>

                        {{-- corporate name --}}
                        <section class="col-span-full md:col-span-6 lg:col-span-3">
                            <div class="relative w-full group">
                                <input type="text" name="builing_name" value="{{ old('builing_name') }}"
                                    class="border-none w-full focus:border-none focus:ring-0 outline-none px-3 py-3 peer"
                                    placeholder=" " />

                                <label
                                    class="absolute right-[9px] top-px text-sm text-gray-500 transition-all duration-300 px-1 transform -translate-y-1/2 pointer-events-none
                                    peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-md group-focus-within:!top-px group-focus-within:!text-sm group-focus-within:!text-rose-500">نام
                                    مجتمع</label>

                                <fieldset
                                    class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] invisible peer-placeholder-shown:visible
                                    group-focus-within:!border-rose-500 group-focus-within:border-2 group-hover:border-gray-700">
                                    <legend
                                        class="mr-2 px-0 text-sm transition-all duration-300 invisible max-w-[0.01px] group-focus-within:max-w-full group-focus-within:px-1 whitespace-nowrap">
                                        نام مجتمع
                                    </legend>
                                </fieldset>

                                <fieldset
                                    class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] visible peer-placeholder-shown:invisible
                                    group-focus-within:border-2 group-focus-within:!border-rose-500 group-hover:border-gray-700">
                                    <legend class="mr-2 text-sm invisible px-1 max-w-full whitespace-nowrap">نام مجتمع
                                    </legend>
                                </fieldset>
                            </div>

                            <span class="text-red-500 font-bold text-xs er-builing_name"></span>
                        </section>

                        <section class="col-span-full md:col-span-6 lg:col-span-3">
                            <div class="relative w-1/ group">
                                <input type="number" name="postal_code" value="{{ old('postal_code') }}"
                                    class="border-none w-full focus:border-none focus:ring-0 outline-none px-3 py-3 peer"
                                    placeholder=" " />

                                <label
                                    class="absolute right-[9px] top-px text-sm text-gray-500 transition-all duration-300 px-1 transform -translate-y-1/2 pointer-events-none
                                    peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-md group-focus-within:!top-px group-focus-within:!text-sm group-focus-within:!text-rose-500">کد
                                    پستی
                                </label>

                                <fieldset
                                    class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] invisible peer-placeholder-shown:visible
                                    group-focus-within:!border-rose-500 group-focus-within:border-2 group-hover:border-gray-700">
                                    <legend
                                        class="mr-2 px-0 text-sm transition-all duration-300 invisible max-w-[0.01px] group-focus-within:max-w-full group-focus-within:px-1 whitespace-nowrap">
                                        کد پستی
                                    </legend>
                                </fieldset>

                                <fieldset
                                    class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] visible peer-placeholder-shown:invisible
                                    group-focus-within:border-2 group-focus-within:!border-rose-500 group-hover:border-red-700">
                                    <legend class="mr-2 text-sm invisible px-1 max-w-full whitespace-nowrap"> کد پستی
                                    </legend>
                                </fieldset>
                            </div>
                            <span class="text-red-500 font-bold text-xs er-postal_code"></span>
                        </section>
                    </section>

                    <section class="grid grid-cols-12 gap-2.5">
                        <section class="col-span-full">
                            <section class="my-6 flex items-center space-x-2 space-x-reverse text-rose-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                </svg>
                                <span>شرح شکایت</span>
                            </section>
                            <section class="col-span-full mb-3">
                                <div class="relative w-full group">
                                    <input type="text" name="subject" value="{{ old('subject') }}" autofocus
                                        class="border-none w-full focus:border-none focus:ring-0 outline-none px-3 py-3 peer"
                                        placeholder=" " />

                                    <label
                                        class="absolute right-[9px] top-px text-sm text-gray-500 transition-all duration-300 px-1 transform -translate-y-1/2 pointer-events-none
                                        peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-md group-focus-within:!top-px group-focus-within:!text-sm group-focus-within:!text-rose-500">موضوع
                                        شکایت
                                        *
                                    </label>

                                    <fieldset
                                        class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] invisible peer-placeholder-shown:visible
                                        group-focus-within:!border-rose-500 group-focus-within:border-2 group-hover:border-gray-700">
                                        <legend
                                            class="mr-2 px-0 text-sm transition-all duration-300 invisible max-w-[0.01px] group-focus-within:max-w-full group-focus-within:px-1 whitespace-nowrap">
                                            موضوع شکایت *
                                        </legend>
                                    </fieldset>

                                    <fieldset
                                        class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] visible peer-placeholder-shown:invisible
                                        group-focus-within:border-2 group-focus-within:!border-rose-500 group-hover:border-gray-700">
                                        <legend class="mr-2 text-sm invisible px-1 max-w-full whitespace-nowrap">موضوع
                                            شکایت *
                                        </legend>
                                    </fieldset>
                                </div>
                                <span class="text-red-500 font-bold text-xs er-subject"></span>
                            </section>
                            <section class="col-span-full my-3">
                                <div class="relative w-full group">
                                    <textarea type="text" name="description" rows="7"
                                        class="border-none w-full focus:border-none focus:ring-0 outline-none px-3 py-3 peer" placeholder=" ">{{ old('description') }}</textarea>

                                    <label
                                        class="absolute right-[9px] text-sm text-gray-500 transition-all duration-300 px-1 transform -translate-y-1/2 pointer-events-none
                                        peer-placeholder-shown:top-8 peer-placeholder-shown:text-md group-focus-within:!top-px group-focus-within:!text-sm group-focus-within:!text-rose-500">شرح
                                        شکایت
                                        *
                                    </label>

                                    <fieldset
                                        class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] invisible peer-placeholder-shown:visible
                                        group-focus-within:!border-rose-500 group-focus-within:border-2 group-hover:border-gray-700">
                                        <legend
                                            class="mr-2 px-0 text-sm transition-all duration-300 invisible max-w-[0.01px] group-focus-within:max-w-full group-focus-within:px-1 whitespace-nowrap">
                                            شرح شکایت * </legend>
                                    </fieldset>

                                    <fieldset
                                        class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] visible peer-placeholder-shown:invisible
                                        group-focus-within:border-2 group-focus-within:!border-rose-500 group-hover:border-gray-700">
                                        <legend class="mr-2 text-sm invisible px-1 max-w-full whitespace-nowrap">شرح
                                            شکایت *</legend>
                                    </fieldset>
                                </div>
                                <span class="text-red-500 font-bold text-xs er-description"></span>
                            </section>

                        </section>
                    </section>

                    {{-- file upload --}}
                    <section class="grid grid-cols-12 gap-2.5">
                        <section class="col-span-full">
                            <section class="my-6 flex items-center space-x-2 space-x-reverse text-rose-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M7.5 7.5h-.75A2.25 2.25 0 004.5 9.75v7.5a2.25 2.25 0 002.25 2.25h7.5a2.25 2.25 0 002.25-2.25v-7.5a2.25 2.25 0 00-2.25-2.25h-.75m0-3l-3-3m0 0l-3 3m3-3v11.25m6-2.25h.75a2.25 2.25 0 012.25 2.25v7.5a2.25 2.25 0 01-2.25 2.25h-7.5a2.25 2.25 0 01-2.25-2.25v-.75" />
                                </svg>
                                <span>مستندات (در صورت لزوم)</span>
                            </section>
                            <div class="flex flex-wrap justify-around my-2">
                                <div class="dz-accepted-files text-gray-600 text-xs">
                                    پسوند های مجاز :
                                </div>
                                <div class="dz-max-files text-gray-600 text-xs">
                                    حداکثر تعداد فایل ها:
                                </div>
                                <div class="dz-max-file-size text-gray-600 text-xs">
                                    حداکثر حجم فایل :
                                </div>
                            </div>
                            <input type="hidden" id="files" name="files">
                            <div id="my-dropzone" class="dropzone">

                            </div>
                            <div class="text-red-500 mt-2 text-center font-bold text-xs er-files">
                            </div>
                            <button type="button" id="upload-button"
                                class="bg-green-300 hover:bg-green-400 text-green-800 font-bold py-2 mt-2 px-4 rounded inline-flex items-center space-x-2 space-x-reverse">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                                </svg>
                                <span>آپلود</span>
                            </button>
                        </section>
                    </section>

                    <section class="my-8 w-full flex flex-col items-center">
                        @recaptcha
                        <div class="text-red-500 mt-2 text-center font-bold text-xs er-g-recaptcha-response">
                        </div>
                    </section>
                    <section class="flex justify-center py-4">
                        <button type="submit" id="submit-button"
                            class="text-white bg-rose-500 hover:bg-rose-600 focus:outline-none focus:ring-4 focus:ring-rose-300 font-medium rounded-full text-sm px-7 py-3 text-center mb-2">
                            ثبت
                            <svg aria-hidden="true" role="status"
                                class="inline w-4 h-4 mr-3 text-white animate-spin hidden" viewBox="0 0 100 101"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="#E5E7EB" />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentColor" />
                            </svg>
                        </button>
                    </section>
                </section>
            </section>
        </form>

    </section>
@endsection

@section('script')
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

    <script>
        const complaintForm = document.querySelector('#complaint_form');
        const submitBtn = document.querySelector('#submit-button');

        let errors = {};
        complaintForm.addEventListener('submit', (e) => {
            const formData = new FormData(complaintForm);
            e.preventDefault();
            submitBtn.disabled = true;
            submitBtn.childNodes[1].classList.remove('hidden');

            if (Object.keys(errors) !== 0) {
                for (error in errors) {
                    document.querySelector(`.er-${error}`).textContent = '';
                }
                errors = {};
            }
            fetch(complaintForm.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content'),
                    },
                })
                .then(response => response.json())
                .then(data => {
                    submitBtn.disabled = false;
                    submitBtn.childNodes[1].classList.add('hidden');
                    if (data.success) {
                        grecaptcha.reset();
                        myDropzone.removeAllFiles(true);
                        document.querySelector('.suc-alert').classList.remove('hidden');;
                        document.querySelector('.suc-mes-title').textContent = data.title;
                        document.querySelector('.suc-mes-desc').textContent = data.message;
                        document.querySelector('.wrapper').scrollIntoView({
                            behavior: 'smooth'
                        });
                        clearFormElements(complaintForm);
                        return;
                    }
                    grecaptcha.reset();
                    errors = data.errors;
                    let firstKey = Object.keys(errors)[0];
                    complaintForm[firstKey].focus();
                    for (index in errors) {
                        const errorInput = document.querySelector(`.er-${index}`);
                        errorInput.textContent = errors[index].join(',');
                    }

                });
        });

        function clearFormElements(form) {
            const elements = form.elements;

            for (let i = 0; i < elements.length; i++) {
                const element = elements[i];

                if (element.type === 'text' || element.type === 'textarea' || element.type === 'number' || element.type ===
                    'hidden') {
                    element.value = '';
                } else if (element.type === 'checkbox' || element.type === 'radio') {
                    element.checked = false;
                } else if (element.tagName === 'SELECT') {
                    element.selectedIndex = 0;
                }
            }
        }
    </script>

    <script>
        var acceptedFiles = "{{ complaintConfig('allowed-extensions') }}";
        var maxFilesize = "{{ complaintConfig('max-file-size') }}";
        var maxFiles = "{{ complaintConfig('max-files') }}";
        document.querySelector('.dz-accepted-files').textContent += acceptedFiles;
        document.querySelector('.dz-max-file-size').textContent += maxFilesize + " مگابایت";
        document.querySelector('.dz-max-files').textContent += maxFiles;
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        var myDropzone = new Dropzone("#my-dropzone", {
            url: "{{ route('complaints.upload') }}",
            paramName: "file",
            maxFilesize: maxFilesize,
            acceptedFiles: acceptedFiles,
            maxFiles: maxFiles,
            autoProcessQueue: false,
            addRemoveLinks: true,
            dictDefaultMessage: "فایل‌های خود را اینجا رها کنید یا کلیک کنید تا بارگذاری شوند",
            dictFallbackMessage: "مرورگر شما از آپلود فایل‌ها با کشیدن و رها کردن پشتیبانی نمی‌کند.",
            dictFallbackText: "لطفاً از فرم زیر برای آپلود فایل‌هایتان استفاده کنید.",
            dictFileTooBig: `فایل بسیار بزرگ است . حداکثر اندازه مجاز: 1 مگابایت.`,
            dictInvalidFileType: "نوع فایل انتخابی مجاز نیست.",
            dictResponseError: "سرور با خطا پاسخ داد.",
            dictCancelUpload: "لغو آپلود",
            dictCancelUploadConfirmation: "آیا مطمئن هستید که می‌خواهید این آپلود را لغو کنید؟",
            dictRemoveFile: "حذف فایل",
            dictRemoveFileConfirmation: null,
            dictMaxFilesExceeded: "شما نمی‌توانید فایل‌های بیشتری را آپلود کنید.",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
        });

        document.getElementById("upload-button").addEventListener("click", function() {
            myDropzone.processQueue();
        });

        let items = [];

        myDropzone.on("success", function(file, response) {
            const path = response.path;

            const files = document.getElementById('files');

            items.push(path);

            files.value = items;
        });
    </script>
@endsection
