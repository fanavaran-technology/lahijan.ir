@extends('app.layouts.app', ['title' => 'شهرداری لاهیجان | فرم ثبت شکایات'])

@section('head-tag')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <section class="min-h-screen wrapper">
        <form action="{{ route('complaints.tracking.proccess') }}" method="post" id="tracking_form">
            @csrf

            <section class="min-h-screen">
                <section class="text-center md:w-8/12 mx-auto mt-14">
                        <h1
                            class="text-xl font-shabnam font-extrabold leading-none tracking-tight text-gray-700 md:text-2xl lg:text-3xl">
                            پیگیری شکایت
                        </h1>
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

                    <section class="mt-4 flex justify-center">
                        <section class="w-full md:w-1/2">
                            <div class="relative w-full group">
                                <input type="text" name="tracking_code" value="{{ old('tracking_code') }}" autofocus
                                    class="border-none w-full focus:border-none focus:ring-0 outline-none px-3 py-3 peer"
                                    placeholder=" " />

                                <label
                                    class="absolute right-[9px] top-px text-sm text-gray-500 transition-all duration-300 px-1 transform -translate-y-1/2 pointer-events-none
                                    peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-md group-focus-within:!top-px group-focus-within:!text-sm group-focus-within:!text-rose-500">کد پیگیری
                                    *
                                </label>

                                <fieldset
                                    class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] invisible peer-placeholder-shown:visible
                                    group-focus-within:!border-rose-500 group-focus-within:border-2 group-hover:border-gray-700">
                                    <legend
                                        class="mr-2 px-0 text-sm transition-all duration-300 invisible max-w-[0.01px] group-focus-within:max-w-full group-focus-within:px-1 whitespace-nowrap">
                                        کد پیگیری *
                                    </legend>
                                </fieldset>

                                <fieldset
                                    class="inset-0 absolute border border-gray-300 rounded pointer-events-none mt-[-9px] visible peer-placeholder-shown:invisible
                                    group-focus-within:border-2 group-focus-within:!border-rose-500 group-hover:border-gray-700">
                                    <legend class="mr-2 text-sm invisible px-1 max-w-full whitespace-nowrap">کد پیگیری *
                                    </legend>
                                </fieldset>
                            </div>
                            <span class="text-red-500 font-bold text-xs er-first_name"></span>
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
                            پیگیری 
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

    <script>
        const complaintForm = document.querySelector('#tracking_form');
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

@endsection
