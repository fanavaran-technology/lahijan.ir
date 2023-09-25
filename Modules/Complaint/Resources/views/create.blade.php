@extends('app.layouts.app', ['title' => 'شهرداری لاهیجان | فرم ثبت شکایات'])

@section('head-tag')
    <script src="{{ asset('assets/admin/plugins/tinymce/js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
@endsection

@section('content')
    <section class="min-h-screen">
        <form action="{{ route('complaints.store') }}" method="post">
            @csrf

            <section class="min-h-screen">
                <section class="text-center my-14">
                    <h1
                        class="mb-4 text-xl font-extrabold leading-none tracking-tight text-gray-700 md:text-2xl lg:text-3xl">
                        فرم ثبت <span
                            class="underline underline-offset-3 decoration-4 decoration-blue-400 dark:decoration-blue-600">شکایات</span>
                    </h1>
                    <div class="text-xs my-3 sm:text-sm text-gray-600">شما می توانید انتقادات پیشنهادات ، شکایات و درخواست
                    هایتان را ثبت بفرمایید</div>
                </section>
                <section class="md:w-8/12 bg-white shadow-sm p-3 my-3 md:my-8 mx-1.5 sm:mx-3 md:mx-auto rounded-3xl">
                    @if ($message = session('toast-success'))
                        <div class="flex p-4 mb-4 text-sm rounded-lg bg-low-dark text-green-400 border border-green-400"
                            role="alert">
                            <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 ml-3" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Info</span>
                            <div>
                                <span class="font-medium">{{ $message }}</span>
                            </div>
                        </div>
                    @endif

                    <section class="my-6 flex items-center space-x-2 space-x-reverse text-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z" />
                        </svg>
                        <span>اطلاعات هویتی</span>
                    </section>

                    <section class="grid grid-cols-12 gap-2.5 mt-4 space-y-3 space-y-reverse">
                        {{-- first name --}}
                        <section class="col-span-full md:col-span-6 lg:col-span-3">
                            <div class="relative w-full group">
                                <input type="text" autofocus name="first_name"
                                    class="border-none w-full focus:border-none focus:ring-0 outline-none px-3 py-3 peer"
                                    placeholder=" " />

                                <label
                                    class="absolute right-[9px] top-px text-sm text-gray-500 transition-all duration-300 px-1 transform -translate-y-1/2 pointer-events-none
                                    peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-md group-focus-within:!top-px group-focus-within:!text-sm group-focus-within:!text-blue-500">نام </label>

                                <fieldset
                                    class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] invisible peer-placeholder-shown:visible
                                    group-focus-within:!border-blue-500 group-focus-within:border-2 group-hover:border-gray-700">
                                    <legend
                                        class="mr-2 px-0 text-sm transition-all duration-300 invisible max-w-[0.01px] group-focus-within:max-w-full group-focus-within:px-1 whitespace-nowrap">
                                        نام </legend>
                                </fieldset>

                                <fieldset
                                    class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] visible peer-placeholder-shown:invisible
                                    group-focus-within:border-2 group-focus-within:!border-blue-500 group-hover:border-gray-700">
                                    <legend class="mr-2 text-sm invisible px-1 max-w-full whitespace-nowrap">نام </legend>
                                </fieldset>
                            </div>
                            @error('first_name')
                                <span class="text-red-500 font-bold text-xs">{{ $message }}</span>
                            @enderror
                        </section>

                        {{-- last name --}}
                        <section class="col-span-full md:col-span-6 lg:col-span-3">
                            {{-- <input type="text" name="full_name" value="{{ old('full_name') }}" id="fullname"
                                class="custom-input @error('full_name') error-input @enderror"> --}}
                            <div class="relative w-full group">
                                <input type="text" name="last_name"
                                    class="border-none w-full focus:border-none focus:ring-0 outline-none px-3 py-3 peer"
                                    placeholder=" " />
                                <label
                                    class="absolute right-[9px] top-px text-sm text-gray-500 transition-all duration-300 px-1 transform -translate-y-1/2 pointer-events-none
                                    peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-md group-focus-within:!top-px group-focus-within:!text-sm group-focus-within:!text-blue-500">نام خانوادگی </label>

                                <fieldset
                                    class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] invisible peer-placeholder-shown:visible
                                    group-focus-within:!border-blue-500 group-focus-within:border-2 group-hover:border-gray-700">
                                    <legend
                                        class="mr-2 px-0 text-sm transition-all duration-300 invisible max-w-[0.01px] group-focus-within:max-w-full group-focus-within:px-1 whitespace-nowrap">
                                        نام خانوادگی </legend>
                                </fieldset>

                                <fieldset
                                    class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] visible peer-placeholder-shown:invisible
                                    group-focus-within:border-2 group-focus-within:!border-blue-500 group-hover:border-gray-700">
                                    <legend class="mr-2 text-sm invisible px-1 max-w-full whitespace-nowrap">نام خانوادگی </legend>
                                </fieldset>
                            </div>
                            @error('last_name')
                                <span class="text-red-500 font-bold text-xs">{{ $message }}</span>
                            @enderror
                        </section>

                        {{-- national code --}}
                        <section class="col-span-full md:col-span-6 lg:col-span-3">
                            <div class="relative w-full group">
                                <input type="number" name="national_code"
                                    class="border-none w-full focus:border-none focus:ring-0 outline-none px-3 py-3 peer"
                                    placeholder=" " />

                                <label
                                    class="absolute right-[9px] top-px text-sm text-gray-500 transition-all duration-300 px-1 transform -translate-y-1/2 pointer-events-none
                                    peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-md group-focus-within:!top-px group-focus-within:!text-sm group-focus-within:!text-blue-500">کد ملی</label>

                                <fieldset
                                    class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] invisible peer-placeholder-shown:visible
                                    group-focus-within:!border-blue-500 group-focus-within:border-2 group-hover:border-gray-700">
                                    <legend
                                        class="mr-2 px-0 text-sm transition-all duration-300 invisible max-w-[0.01px] group-focus-within:max-w-full group-focus-within:px-1 whitespace-nowrap">
                                        کد ملی</legend>
                                </fieldset>

                                <fieldset
                                    class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] visible peer-placeholder-shown:invisible
                                    group-focus-within:border-2 group-focus-within:!border-blue-500 group-hover:border-gray-700">
                                    <legend class="mr-2 text-sm invisible px-1 max-w-full whitespace-nowrap">کد ملی</legend>
                                </fieldset>
                            </div>
                            @error('last_name')
                                <span class="text-red-500 font-bold text-xs">{{ $message }}</span>
                            @enderror
                        </section>

                        {{-- phone number --}}
                        <section class="col-span-full md:col-span-6 lg:col-span-3">
                            <div class="relative w-full group">
                                <input type="number" name="phone_number"
                                    class="border-none w-full focus:border-none focus:ring-0 outline-none px-3 py-3 peer"
                                    placeholder=" " />

                                <label
                                    class="absolute right-[9px] top-px text-sm text-gray-500 transition-all duration-300 px-1 transform -translate-y-1/2 pointer-events-none
                                    peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-md group-focus-within:!top-px group-focus-within:!text-sm group-focus-within:!text-blue-500">شماره تلفن</label>
                                <fieldset
                                    class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] invisible peer-placeholder-shown:visible
                                    group-focus-within:!border-blue-500 group-focus-within:border-2 group-hover:border-gray-700">
                                    <legend
                                        class="mr-2 px-0 text-sm transition-all duration-300 invisible max-w-[0.01px] group-focus-within:max-w-full group-focus-within:px-1 whitespace-nowrap">
                                        شماره تلفن</legend>
                                </fieldset>

                                <fieldset
                                    class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] visible peer-placeholder-shown:invisible
                                    group-focus-within:border-2 group-focus-within:!border-blue-500 group-hover:border-gray-700">
                                    <legend class="mr-2 text-sm invisible px-1 max-w-full whitespace-nowrap">شماره تلفن</legend>
                                </fieldset>
                            </div>
                            @error('last_name')
                                <span class="text-red-500 font-bold text-xs">{{ $message }}</span>
                            @enderror
                        </section>
                    </section>
                    <section class="my-4 flex items-center space-x-2 space-x-reverse text-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                          </svg>
                        <span>آدرس</span>
                    </section>

                    <section class="grid grid-cols-12 gap-2.5 space-y-3 space-y-reverse">
                        {{-- main st --}}
                        <section class="col-span-full md:col-span-6">
                            <div class="relative w-full group">
                                <input type="text" name="main_st"
                                    class="border-none w-full focus:border-none focus:ring-0 outline-none px-3 py-3 peer"
                                    placeholder=" " />

                                <label
                                    class="absolute right-[9px] top-px text-sm text-gray-500 transition-all duration-300 px-1 transform -translate-y-1/2 pointer-events-none
                                    peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-md group-focus-within:!top-px group-focus-within:!text-sm group-focus-within:!text-blue-500">خیابان اصلی</label>

                                <fieldset
                                    class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] invisible peer-placeholder-shown:visible
                                    group-focus-within:!border-blue-500 group-focus-within:border-2 group-hover:border-gray-700">
                                    <legend
                                        class="mr-2 px-0 text-sm transition-all duration-300 invisible max-w-[0.01px] group-focus-within:max-w-full group-focus-within:px-1 whitespace-nowrap">
                                        خیابان اصلی</legend>
                                </fieldset>

                                <fieldset
                                    class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] visible peer-placeholder-shown:invisible
                                    group-focus-within:border-2 group-focus-within:!border-blue-500 group-hover:border-gray-700">
                                    <legend class="mr-2 text-sm invisible px-1 max-w-full whitespace-nowrap">خیابان اصلی</legend>
                                </fieldset>
                            </div>
                            @error('last_name')
                                <span class="text-red-500 font-bold text-xs">{{ $message }}</span>
                            @enderror
                        </section>

                        {{-- aux.. st --}}
                        <section class="col-span-full md:col-span-6">
                            <div class="relative w-1/ group">
                                <input type="text" name="auxiliary_st"
                                    class="border-none w-full focus:border-none focus:ring-0 outline-none px-3 py-3 peer"
                                    placeholder=" " />

                                <label
                                    class="absolute right-[9px] top-px text-sm text-gray-500 transition-all duration-300 px-1 transform -translate-y-1/2 pointer-events-none
                                    peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-md group-focus-within:!top-px group-focus-within:!text-sm group-focus-within:!text-blue-500">خیابان فرعی</label>

                                <fieldset
                                    class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] invisible peer-placeholder-shown:visible
                                    group-focus-within:!border-blue-500 group-focus-within:border-2 group-hover:border-gray-700">
                                    <legend
                                        class="mr-2 px-0 text-sm transition-all duration-300 invisible max-w-[0.01px] group-focus-within:max-w-full group-focus-within:px-1 whitespace-nowrap">
                                        خیابان فرعی</legend>
                                </fieldset>

                                <fieldset
                                    class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] visible peer-placeholder-shown:invisible
                                    group-focus-within:border-2 group-focus-within:!border-blue-500 group-hover:border-gray-700">
                                    <legend class="mr-2 text-sm invisible px-1 max-w-full whitespace-nowrap">خیابان فرعی</legend>
                                </fieldset>
                            </div>
                            @error('last_name')
                                <span class="text-red-500 font-bold text-xs">{{ $message }}</span>
                            @enderror
                        </section>

                        {{-- alley --}}
                        <section class="col-span-full md:col-span-6 lg:col-span-3">
                            <div class="relative w-full group">
                                <input type="text" name="alley"
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
                                        کوچه</legend>
                                </fieldset>

                                <fieldset
                                    class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] visible peer-placeholder-shown:invisible
                                    group-focus-within:border-2 group-focus-within:!border-blue-500 group-hover:border-gray-700">
                                    <legend class="mr-2 text-sm invisible px-1 max-w-full whitespace-nowrap">کوچه</legend>
                                </fieldset>
                            </div>
                            @error('last_name')
                                <span class="text-red-500 font-bold text-xs">{{ $message }}</span>
                            @enderror
                        </section>

                        {{-- deadend --}}
                        <section class="col-span-full md:col-span-6 lg:col-span-3">
                            <div class="relative w-1/ group">
                                <input type="text" name="deadend"
                                    class="border-none w-full focus:border-none focus:ring-0 outline-none px-3 py-3 peer"
                                    placeholder=" " />

                                <label
                                    class="absolute right-[9px] top-px text-sm text-gray-500 transition-all duration-300 px-1 transform -translate-y-1/2 pointer-events-none
                                    peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-md group-focus-within:!top-px group-focus-within:!text-sm group-focus-within:!text-blue-500">بن بست</label>

                                <fieldset
                                    class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] invisible peer-placeholder-shown:visible
                                    group-focus-within:!border-blue-500 group-focus-within:border-2 group-hover:border-gray-700">
                                    <legend
                                        class="mr-2 px-0 text-sm transition-all duration-300 invisible max-w-[0.01px] group-focus-within:max-w-full group-focus-within:px-1 whitespace-nowrap">
                                        بن بست</legend>
                                </fieldset>

                                <fieldset
                                    class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] visible peer-placeholder-shown:invisible
                                    group-focus-within:border-2 group-focus-within:!border-blue-500 group-hover:border-gray-700">
                                    <legend class="mr-2 text-sm invisible px-1 max-w-full whitespace-nowrap">بن بست</legend>
                                </fieldset>
                            </div>
                            @error('last_name')
                                <span class="text-red-500 font-bold text-xs">{{ $message }}</span>
                            @enderror
                        </section>

                        {{-- corporate name --}}
                        <section class="col-span-full md:col-span-6 lg:col-span-3">
                            <div class="relative w-full group">
                                <input type="text" name="builing_name"
                                    class="border-none w-full focus:border-none focus:ring-0 outline-none px-3 py-3 peer"
                                    placeholder=" " />

                                <label
                                    class="absolute right-[9px] top-px text-sm text-gray-500 transition-all duration-300 px-1 transform -translate-y-1/2 pointer-events-none
                                    peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-md group-focus-within:!top-px group-focus-within:!text-sm group-focus-within:!text-blue-500">نام مجتمع</label>

                                <fieldset
                                    class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] invisible peer-placeholder-shown:visible
                                    group-focus-within:!border-blue-500 group-focus-within:border-2 group-hover:border-gray-700">
                                    <legend
                                        class="mr-2 px-0 text-sm transition-all duration-300 invisible max-w-[0.01px] group-focus-within:max-w-full group-focus-within:px-1 whitespace-nowrap">
                                        نام مجتمع</legend>
                                </fieldset>

                                <fieldset
                                    class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] visible peer-placeholder-shown:invisible
                                    group-focus-within:border-2 group-focus-within:!border-blue-500 group-hover:border-gray-700">
                                    <legend class="mr-2 text-sm invisible px-1 max-w-full whitespace-nowrap">نام مجتمع</legend>
                                </fieldset>
                            </div>
                            @error('last_name')
                                <span class="text-red-500 font-bold text-xs">{{ $message }}</span>
                            @enderror
                        </section>

                        <section class="col-span-full md:col-span-6 lg:col-span-3">
                            <div class="relative w-1/ group">
                                <input type="number" name="postal_code"
                                    class="border-none w-full focus:border-none focus:ring-0 outline-none px-3 py-3 peer"
                                    placeholder=" " />

                                <label
                                    class="absolute right-[9px] top-px text-sm text-gray-500 transition-all duration-300 px-1 transform -translate-y-1/2 pointer-events-none
                                    peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-md group-focus-within:!top-px group-focus-within:!text-sm group-focus-within:!text-blue-500">پلاک </label>

                                <fieldset
                                    class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] invisible peer-placeholder-shown:visible
                                    group-focus-within:!border-blue-500 group-focus-within:border-2 group-hover:border-gray-700">
                                    <legend
                                        class="mr-2 px-0 text-sm transition-all duration-300 invisible max-w-[0.01px] group-focus-within:max-w-full group-focus-within:px-1 whitespace-nowrap">
                                        کد پستی</legend>
                                </fieldset>

                                <fieldset
                                    class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] visible peer-placeholder-shown:invisible
                                    group-focus-within:border-2 group-focus-within:!border-blue-500 group-hover:border-gray-700">
                                    <legend class="mr-2 text-sm invisible px-1 max-w-full whitespace-nowrap"> پلاک</legend>
                                </fieldset>
                            </div>
                            @error('last_name')
                                <span class="text-red-500 font-bold text-xs">{{ $message }}</span>
                            @enderror
                        </section>
                    </section>

                    <section class="grid grid-cols-12 gap-2.5 space-y-3 space-y-reverse">
                        <section class="col-span-full">
                            <section class="my-6 flex items-center space-x-2 space-x-reverse text-blue-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z" />
                                </svg>
                                <span>شرح شکایت</span>
                            </section>
                            <textarea name="description" id="editor" cols="30" rows="10">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="text-red-500 font-bold text-xs">{{ $message }}</span>
                            @enderror
                        </section>
                    </section>
                    <section class="my-8 w-full flex flex-col items-center">
                        @recaptcha
                        @error('g-recaptcha-response')
                            <div class="text-red-500 mt-2 text-center font-bold text-xs">{{ $message }}</div>
                        @enderror
                    </section>
                    <section class="flex justify-center py-4">
                        <button type="submit"
                            class="text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-7 py-3 text-center mb-2">ثبت</button>
                    </section>
                </section>
        </form>
    </section>
@endsection

@section('script')
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
