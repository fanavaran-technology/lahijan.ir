@extends('app.layouts.app', ['title' => 'شهرداری لاهیجان | فرم ثبت شکایات'])

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
        {{--Modal--}}
        <div dir="rtl"
            class="modal opacity-0 pointer-events-none z-50 fixed w-full h-full top-0 left-0 flex items-center justify-center">
            <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

            <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">

                <div
                    class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
                    <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                         viewBox="0 0 18 18">
                        <path
                            d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                    </svg>
                    <span class="text-sm">(Esc)</span>
                </div>

                <!-- Add margin if you want to see some of the overlay behind the modal-->
                <div class="modal-content py-4 text-left px-6">
                    <!--Title-->
                    <div class="flex justify-between items-center pb-3">
                        <p class="text-2xl font-bold mr-32">پیگیری شکایت !</p>
                        <div class="modal-close cursor-pointer z-50">
                            <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18"
                                 height="18" viewBox="0 0 18 18">
                                <path
                                    d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                            </svg>
                        </div>
                    </div>

                    <!--Body-->
                    <div>
                        <label for="first_name" class="block mb-2 text-right text-sm font-medium text-gray-900">کد پیگیری خود را وارد نمایید</label>
                        <input type="text" id="first_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="کد پیگیری" required>
                    </div>


                    <!--Footer-->
                    <div class="flex justify-end pt-2">
                        <button
                            class="px-4 bg-green-300 hover:bg-green-500 p-3 rounded-lg text-black  mr-2">
                            نمایش
                        </button>
                    </div>

                </div>
            </div>
        </div>
        {{--End Modal--}}

        <form action="{{ route('complaints.store') }}" method="post" id="complaint_form">
            @csrf

            <section class="min-h-screen">
                <section class="text-center mt-14 mb-7">
                    <h1
                        class="mb-4 text-xl font-extrabold leading-none tracking-tight text-gray-700 md:text-2xl lg:text-3xl">
                        فرم ثبت <span class="underline underline-offset-3 decoration-4 decoration-blue-400">شکایات</span>
                    </h1>
                    <div class="text-xs my-3 sm:text-sm text-gray-600">شما می توانید انتقادات پیشنهادات ، شکایات و
                        درخواست
                        هایتان را ثبت بفرمایید
                    </div>
                </section>
                <div class=" flex justify-end items-center mx-auto w-8/12 ">
                    <a class="modal-open flex justify-center w-40 cursor-pointer bg-green-300 hover:bg-green-400 text-green-800 font-bold py-2 px-4 rounded-lg">پیگیری شکایت</a>
                </div>
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

                    <section class="my-6 flex items-center space-x-2 space-x-reverse text-blue-500">
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
                                    peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-md group-focus-within:!top-px group-focus-within:!text-sm group-focus-within:!text-blue-500">نام
                                    *
                                </label>

                                <fieldset
                                    class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] invisible peer-placeholder-shown:visible
                                    group-focus-within:!border-blue-500 group-focus-within:border-2 group-hover:border-gray-700">
                                    <legend
                                        class="mr-2 px-0 text-sm transition-all duration-300 invisible max-w-[0.01px] group-focus-within:max-w-full group-focus-within:px-1 whitespace-nowrap">
                                        نام *
                                    </legend>
                                </fieldset>

                                <fieldset
                                    class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] visible peer-placeholder-shown:invisible
                                    group-focus-within:border-2 group-focus-within:!border-blue-500 group-hover:border-gray-700">
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
                                    peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-md group-focus-within:!top-px group-focus-within:!text-sm group-focus-within:!text-blue-500">
                                    نام خانوادگی *
                                </label>

                                <fieldset
                                    class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] invisible peer-placeholder-shown:visible
                                    group-focus-within:!border-blue-500 group-focus-within:border-2 group-hover:border-gray-700">
                                    <legend
                                        class="mr-2 px-0 text-sm transition-all duration-300 invisible max-w-[0.01px] group-focus-within:max-w-full group-focus-within:px-1 whitespace-nowrap">
                                        نام خانوادگی *
                                    </legend>
                                </fieldset>

                                <fieldset
                                    class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] visible peer-placeholder-shown:invisible
                                    group-focus-within:border-2 group-focus-within:!border-blue-500 group-hover:border-gray-700">
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
                                    peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-md group-focus-within:!top-px group-focus-within:!text-sm group-focus-within:!text-blue-500">کد
                                    ملی *</label>

                                <fieldset
                                    class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] invisible peer-placeholder-shown:visible
                                    group-focus-within:!border-blue-500 group-focus-within:border-2 group-hover:border-gray-700">
                                    <legend
                                        class="mr-2 px-0 text-sm transition-all duration-300 invisible max-w-[0.01px] group-focus-within:max-w-full group-focus-within:px-1 whitespace-nowrap">
                                        کد ملی *
                                    </legend>
                                </fieldset>

                                <fieldset
                                    class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] visible peer-placeholder-shown:invisible
                                    group-focus-within:border-2 group-focus-within:!border-blue-500 group-hover:border-gray-700">
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
                                    peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-md group-focus-within:!top-px group-focus-within:!text-sm group-focus-within:!text-blue-500">شماره
                                    تلفن *</label>
                                <fieldset
                                    class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] invisible peer-placeholder-shown:visible
                                    group-focus-within:!border-blue-500 group-focus-within:border-2 group-hover:border-gray-700">
                                    <legend
                                        class="mr-2 px-0 text-sm transition-all duration-300 invisible max-w-[0.01px] group-focus-within:max-w-full group-focus-within:px-1 whitespace-nowrap">
                                        شماره تلفن *
                                    </legend>
                                </fieldset>

                                <fieldset
                                    class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] visible peer-placeholder-shown:invisible
                                    group-focus-within:border-2 group-focus-within:!border-blue-500 group-hover:border-gray-700">
                                    <legend class="mr-2 text-sm invisible px-1 max-w-full whitespace-nowrap">شماره تلفن
                                        *
                                    </legend>
                                </fieldset>
                            </div>
                            <span class="text-red-500 font-bold text-xs er-phone_number"></span>
                        </section>
                    </section>
                    <section class="my-4 flex items-center space-x-2 space-x-reverse text-blue-500">
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
                                    peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-md group-focus-within:!top-px group-focus-within:!text-sm group-focus-within:!text-blue-500">خیابان
                                    اصلی *</label>

                                <fieldset
                                    class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] invisible peer-placeholder-shown:visible
                                    group-focus-within:!border-blue-500 group-focus-within:border-2 group-hover:border-gray-700">
                                    <legend
                                        class="mr-2 px-0 text-sm transition-all duration-300 invisible max-w-[0.01px] group-focus-within:max-w-full group-focus-within:px-1 whitespace-nowrap">
                                        خیابان اصلی *
                                    </legend>
                                </fieldset>

                                <fieldset
                                    class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] visible peer-placeholder-shown:invisible
                                    group-focus-within:border-2 group-focus-within:!border-blue-500 group-hover:border-gray-700">
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
                                    peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-md group-focus-within:!top-px group-focus-within:!text-sm group-focus-within:!text-blue-500">خیابان
                                    فرعی</label>

                                <fieldset
                                    class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] invisible peer-placeholder-shown:visible
                                    group-focus-within:!border-blue-500 group-focus-within:border-2 group-hover:border-gray-700">
                                    <legend
                                        class="mr-2 px-0 text-sm transition-all duration-300 invisible max-w-[0.01px] group-focus-within:max-w-full group-focus-within:px-1 whitespace-nowrap">
                                        خیابان فرعی
                                    </legend>
                                </fieldset>

                                <fieldset
                                    class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] visible peer-placeholder-shown:invisible
                                    group-focus-within:border-2 group-focus-within:!border-blue-500 group-hover:border-gray-700">
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
                                    peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-md group-focus-within:!top-px group-focus-within:!text-sm group-focus-within:!text-blue-500">کوچه</label>

                                <fieldset
                                    class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] invisible peer-placeholder-shown:visible
                                    group-focus-within:!border-blue-500 group-focus-within:border-2 group-hover:border-gray-700">
                                    <legend
                                        class="mr-2 px-0 text-sm transition-all duration-300 invisible max-w-[0.01px] group-focus-within:max-w-full group-focus-within:px-1 whitespace-nowrap">
                                        کوچه
                                    </legend>
                                </fieldset>

                                <fieldset
                                    class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] visible peer-placeholder-shown:invisible
                                    group-focus-within:border-2 group-focus-within:!border-blue-500 group-hover:border-gray-700">
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
                                    peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-md group-focus-within:!top-px group-focus-within:!text-sm group-focus-within:!text-blue-500">بن
                                    بست</label>

                                <fieldset
                                    class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] invisible peer-placeholder-shown:visible
                                    group-focus-within:!border-blue-500 group-focus-within:border-2 group-hover:border-gray-700">
                                    <legend
                                        class="mr-2 px-0 text-sm transition-all duration-300 invisible max-w-[0.01px] group-focus-within:max-w-full group-focus-within:px-1 whitespace-nowrap">
                                        بن بست
                                    </legend>
                                </fieldset>

                                <fieldset
                                    class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] visible peer-placeholder-shown:invisible
                                    group-focus-within:border-2 group-focus-within:!border-blue-500 group-hover:border-gray-700">
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
                                    peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-md group-focus-within:!top-px group-focus-within:!text-sm group-focus-within:!text-blue-500">نام
                                    مجتمع</label>

                                <fieldset
                                    class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] invisible peer-placeholder-shown:visible
                                    group-focus-within:!border-blue-500 group-focus-within:border-2 group-hover:border-gray-700">
                                    <legend
                                        class="mr-2 px-0 text-sm transition-all duration-300 invisible max-w-[0.01px] group-focus-within:max-w-full group-focus-within:px-1 whitespace-nowrap">
                                        نام مجتمع
                                    </legend>
                                </fieldset>

                                <fieldset
                                    class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] visible peer-placeholder-shown:invisible
                                    group-focus-within:border-2 group-focus-within:!border-blue-500 group-hover:border-gray-700">
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
                                    peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-md group-focus-within:!top-px group-focus-within:!text-sm group-focus-within:!text-blue-500">کد
                                    پستی
                                </label>

                                <fieldset
                                    class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] invisible peer-placeholder-shown:visible
                                    group-focus-within:!border-blue-500 group-focus-within:border-2 group-hover:border-gray-700">
                                    <legend
                                        class="mr-2 px-0 text-sm transition-all duration-300 invisible max-w-[0.01px] group-focus-within:max-w-full group-focus-within:px-1 whitespace-nowrap">
                                        کد پستی
                                    </legend>
                                </fieldset>

                                <fieldset
                                    class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] visible peer-placeholder-shown:invisible
                                    group-focus-within:border-2 group-focus-within:!border-blue-500 group-hover:border-red-700">
                                    <legend class="mr-2 text-sm invisible px-1 max-w-full whitespace-nowrap"> کد پستی
                                    </legend>
                                </fieldset>
                            </div>
                            <span class="text-red-500 font-bold text-xs er-postal_code"></span>
                        </section>
                    </section>

                    <section class="grid grid-cols-12 gap-2.5">
                        <section class="col-span-full">
                            <section class="my-6 flex items-center space-x-2 space-x-reverse text-blue-500">
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
                                        peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-md group-focus-within:!top-px group-focus-within:!text-sm group-focus-within:!text-blue-500">موضوع
                                        شکایت
                                        *
                                    </label>

                                    <fieldset
                                        class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] invisible peer-placeholder-shown:visible
                                        group-focus-within:!border-blue-500 group-focus-within:border-2 group-hover:border-gray-700">
                                        <legend
                                            class="mr-2 px-0 text-sm transition-all duration-300 invisible max-w-[0.01px] group-focus-within:max-w-full group-focus-within:px-1 whitespace-nowrap">
                                            موضوع شکایت *
                                        </legend>
                                    </fieldset>

                                    <fieldset
                                        class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] visible peer-placeholder-shown:invisible
                                        group-focus-within:border-2 group-focus-within:!border-blue-500 group-hover:border-gray-700">
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
                                        peer-placeholder-shown:top-8 peer-placeholder-shown:text-md group-focus-within:!top-px group-focus-within:!text-sm group-focus-within:!text-blue-500">شرح
                                        شکایت
                                        *
                                    </label>

                                    <fieldset
                                        class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] invisible peer-placeholder-shown:visible
                                        group-focus-within:!border-blue-500 group-focus-within:border-2 group-hover:border-gray-700">
                                        <legend
                                            class="mr-2 px-0 text-sm transition-all duration-300 invisible max-w-[0.01px] group-focus-within:max-w-full group-focus-within:px-1 whitespace-nowrap">
                                            شرح شکایت * </legend>
                                    </fieldset>

                                    <fieldset
                                        class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] visible peer-placeholder-shown:invisible
                                        group-focus-within:border-2 group-focus-within:!border-blue-500 group-hover:border-gray-700">
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
                            <section class="my-6 flex items-center space-x-2 space-x-reverse text-blue-500">
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
                            class="text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-7 py-3 text-center mb-2">ثبت</button>
                    </section>
                </section>
        </form>

    </section>
@endsection

@section('script')
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

    <script>
        const complaintForm = document.querySelector('#complaint_form');

        let errors = {};
        complaintForm.addEventListener('submit', (e) => {
            const formData = new FormData(complaintForm);
            e.preventDefault();

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
                    if (data.success) {
                        grecaptcha.reset();
                        myDropzone.removeAllFiles(true);
                        document.querySelector('.suc-alert').classList.remove('hidden');;
                        document.querySelector('.suc-mes-title').textContent = data.title;
                        document.querySelector('.suc-mes-desc').textContent = data.message;
                        document.querySelector('.wrapper').scrollIntoView({behavior : 'smooth'});
                        clearFormElements(complaintForm);
                        return ;
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

                if (element.type === 'text' || element.type === 'textarea' || element.type === 'number' || element.type === 'hidden') {
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
        var openmodal = document.querySelectorAll('.modal-open')
        for (var i = 0; i < openmodal.length; i++) {
            openmodal[i].addEventListener('click', function (event) {
                event.preventDefault()
                toggleModal()
            })
        }

        const overlay = document.querySelector('.modal-overlay')
        overlay.addEventListener('click', toggleModal)

        var closemodal = document.querySelectorAll('.modal-close')
        for (var i = 0; i < closemodal.length; i++) {
            closemodal[i].addEventListener('click', toggleModal)
        }

        document.onkeydown = function (evt) {
            evt = evt || window.event
            var isEscape = false
            if ("key" in evt) {
                isEscape = (evt.key === "Escape" || evt.key === "Esc")
            } else {
                isEscape = (evt.keyCode === 27)
            }
            if (isEscape && document.body.classList.contains('modal-active')) {
                toggleModal()
            }
        };


        function toggleModal() {
            const body = document.querySelector('body')
            const modal = document.querySelector('.modal')
            modal.classList.toggle('opacity-0')
            modal.classList.toggle('pointer-events-none')
            body.classList.toggle('modal-active')
        }


    </script>


    <script>
        var acceptedFiles = ".jpg, .jpeg, .png, .gif";
        var maxFilesize = 1;
        var maxFiles = 3;
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
                "X-CSRF-TOKEN": csrfToken
            },
        });

        document.getElementById("upload-button").addEventListener("click", function () {
            myDropzone.processQueue();
        });

        let items = [];

        myDropzone.on("success", function (file, response) {
            const path = response.path;

            const files = document.getElementById('files');

            items.push(path);

            files.value = items;
        });
    </script>

    {{-- render editor --}}
    <script>
        function renderEditor(key) {
            let editor_config = {
                selector: key,
                relative_urls: false,
                plugins: 'directionality table fullscreen',
                language: 'fa',
                toolbar: [{
                        name: 'styles',
                        items: ['styleselect']
                    },
                    {
                        name: 'formatting',
                        items: ['bold', 'italic', 'underline']
                    },
                    {
                        name: 'alignment',
                        items: ['alignright', 'aligncenter', 'alignleft', 'alignjustify', "format"]
                    },
                    {
                        name: 'indentation',
                        items: ['outdent', 'indent']
                    },
                    {
                        name: 'table',
                        items: ['table']
                    },
                    {
                        name: 'direction',
                        items: ['rtl', 'ltr']
                    },
                    {
                        name: 'history',
                        items: ['undo', 'redo']
                    },
                    {
                        name: 'fullscreen',
                        items: ["fullscreen"]
                    },
                ],
            };

            tinymce.init(editor_config);
        }
    </script>
    
    <script>
        renderEditor('#editor')
    </script>

@endsection
