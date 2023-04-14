@extends('app.auth.layouts.app' , ['title' => 'شهرداری لاهیجان | ورود به حساب'])

@section('content')
<section class="grid grid-cols-12">
    <div class="hidden lg:inline-block lg:col-span-7 h-screen">
        <!-- Swiper -->
        <swiper-container class="mySwiper" pagination="true" pagination-clickable="true" space-between="30"
            centered-slides="true" autoplay-delay="4000" autoplay-disable-on-interaction="false">
            <swiper-slide><img src="{{ asset('images/login/sustan.jpg') }}" alt="سوستان"></swiper-slide>
            <swiper-slide><img src="{{ asset('images/login/tele.jpg') }}" alt="تله کابین لاهیجان"></swiper-slide>

            <div class="autoplay-progress" slot="container-end">
                <svg viewBox="0 0 48 48">
                    <circle cx="24" cy="24" r="20"></circle>
                </svg>
                <span></span>
            </div>
        </swiper-container>
    </div>
    <div class="col-span-full lg:col-span-5 bg-white">
        <section>
            <div class="flex flex-col items-center justify-center px-2 sm:px-6 py-8 mx-auto md:h-screen lg:py-0">
                <section id="loginBox"
                    class="transition-all delay-500 ease-linear bg-white scale-0 w-full  rounded-lg md:mt-0 sm:max-w-md xl:p-0">
                    <div class="p-6 sm:p-8">
                        <div class="flex  justify-between">
                            <section class="flex justify-center items-center"></section>
                            <h2 class="flex flex-col items-center mr-6 justify-center  font-semibold text-xl p-2">
                                <p class="text-green-500">ورود حساب کاربری</p>
                                <div class="w-12 h-1 mt-2 bg-green-500 rounded"></div>
                            </h2>
                            <a href="{{ route('home') }}" class="p-2 items-center text-center transition-all delay-75 rounded">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-center text-gray-500 hover:text-green-600 mt-2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                </svg>  
                            </a>
                        </div>
                        <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div>
                                <label for="username" class="block mb-2 text-sm font-medium text-gray-500">نام
                                    کاربری</label>
                                <div class="w-full bg-gray-100 flex flex-row justify-start h-12 rounded-lg">
                                    <svg class="text-right mt-3 mr-2 flex text-gray-500"
                                        xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                        fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                    </svg>
                                    <input type="username" autofocus name="username" id="username" value="{{ old('username') }}"
                                        class="dir-ltr h-12 bg-gray-100 flrx justify-end outline-none w-full ml-3 text-gray-900 sm:text-sm rounded-lg block p-1.5 sm:p-2.5 placeholder:text-left"
                                        required>
                                </div>
                            </div>
                            <div x-data="{ show: true }">
                                <label for="password" class="block mb-2 text-sm font-medium text-gray-500">کلمه
                                    عبور</label>
                                <div class="relative">
                                    <div class="w-full bg-gray-100 flex flex-row justify-start h-12 rounded-lg">
                                        <input name="password" id="password" :type="show ? 'password' : 'text'"
                                            required class="dir-ltr h-12 bg-gray-100 flrx justify-end outline-none w-full border-none ml-3 focus:ring-0 focus:outline-none text-gray-900 sm:text-sm rounded-lg block p-1.5 sm:p-2.5 placeholder:text-left">
                                        <div
                                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
                                            <svg xmlns="http://www.w3.org/2000/svg" @click="show = !show"
                                                :class="{'block': !show, 'hidden':show }" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="w-6 h-6 text-gray-600">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" @click="show = !show"
                                                :class="{'hidden': !show, 'block':show }" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="w-6 h-6 text-gray-600">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                                            </svg>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            @if($errors->any())
                                <span class="text-red-500 mt-2 text-xs font-bold">{{ implode('', $errors->all(':message')) }}</span>
                            @endif
                            <div class="flex items-center justify-between">
                                <div class="flex items-start space-x-2 space-x-reverse">
                                    <div class="flex items-center h-5">
                                        <input id="remember" aria-describedby="remember" type="checkbox"
                                            class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-indigo-300">
                                    </div>
                                    <div class="ml-3 text-sm">
                                        <label for="remember" name="remember" class="text-gray-500">مرا به خاطر بسپار</label>
                                    </div>
                                </div>
                                @if (Route::has('password.request'))
                                <a href="#"
                                    class="text-xs sm:text-sm font-medium text-gray-500 hover:underline">فراموشی
                                    کلمه عبور</a>
                                @endif
                            </div>
                            <section class="my-3 w-full flex flex-col items-center">
                                @recaptcha
                            </section>
                            <div class="flex justify-center">
                                <button type="submit" class="w-60 mt-3 justify-center items-center text-green-500 hover:text-white  hover:bg-green-500 border-2 rounded-full border-green-500  focus:ring-4 py-2 px-12 text-sm font-semibold
                                 text-center">ورود</button>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </section>
    </div>
</section>
@endsection

@section('script')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let loginBox = document.getElementById('loginBox')
        loginBox.classList.remove('scale-0');
        loginBox.classList.add('scale-100');
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-element-bundle.min.js"></script>

<script>
    const progressCircle = document.querySelector(".autoplay-progress svg");
    const progressContent = document.querySelector(".autoplay-progress span");

    const swiperEl = document.querySelector("swiper-container");
    swiperEl.addEventListener("autoplaytimeleft", (e) => {
        const [swiper, time, progress] = e.detail;
        progressCircle.style.setProperty("--progress", 1 - progress);
        progressContent.textContent = `${Math.ceil(time / 1000)}s`;
    });
</script>
@endsection