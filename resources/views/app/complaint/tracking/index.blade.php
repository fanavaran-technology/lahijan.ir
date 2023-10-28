@extends('app.layouts.app', ['title' => 'شهرداری لاهیجان | فرم ثبت شکایات'])

@section('head-tag')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('assets/app/plugins/viewer/css/viewer.min.css') }}">
@endsection

@section('content')
    <section class="min-h-screen wrapper">
        @empty($complaint)
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
                        <section class="mt-4 flex justify-center">
                            <section class="w-full md:w-1/2">
                                <div class="relative w-full group">
                                    <input type="text" name="tracking_code" value="{{ old('tracking_code') }}" autofocus
                                        class="border-none w-full focus:border-none focus:ring-0 outline-none px-3 py-3 peer"
                                        placeholder=" " />

                                    <label
                                        class="absolute right-[9px] top-px text-sm text-gray-500 transition-all duration-300 px-1 transform -translate-y-1/2 pointer-events-none
                                    peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-md group-focus-within:!top-px group-focus-within:!text-sm group-focus-within:!text-rose-500">کد
                                        پیگیری
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
                                @error('tracking_code')
                                    <span class="text-red-500 font-bold text-xs er-tracking_code">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </section>
                        </section>

                        <section class="my-8 w-full flex flex-col items-center">
                            @recaptcha
                            @error('g-recaptcha-response')
                                <div class="text-red-500 mt-2 text-center font-bold text-xs er-g-recaptcha-response">
                                    {{ $message }}
                                </div>
                            @enderror
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
        @else
            <div class="bg-gray-50 flex flex-col w-full mt-8 rounded-md md:w-11/12 mx-auto overflow-hidden">
                <div class="bg-gray-100 rounded text-black p-3">
                    <span class="text-gray-600">موضوع شکایت</span>
                    <h1 class="text-lg">{{ $complaint->subject }}</h1>
                </div>

                <div class="flex-1 overflow-y-auto p-4">
                    <div class="flex flex-col space-y-1 overflow-hidden">

                        <div class="text-center my-4">
                            <span class="bg-gray-200 py-1.5 px-2 text-xs rounded-full text-gray-500">
                                {{ jalaliDate($complaint->created_at, 'd M Y') }}
                            </span>
                        </div>
                        <div class="flex">
                            <div class="flex mb-4">
                                <div class="relative ml-2 hidden md:block">
                                    <img class="w-12 h-12 border rounded-full object-cover"
                                        src="{{ asset('images/user/default.png') }}" alt="">
                                </div>
                                <div
                                    class="bg-blue-100 border text-gray-800 leading-9 p-4 rounded-lg md:w-8/12 w-full text-base">
                                    {{ $complaint->description }}
                                </div>
                            </div>
                        </div>

                        @if ($complaint->files()->whereNull('user_id')->get()->isNotEmpty())
                            <div class="flex">
                                <div class="flex mr-0 md:mr-12 mb-4">
                                    <div class="text-gray-800 leading-9 rounded-lg md:w-8/12 w-full text-base">
                                        <ul id="sender" class="grid grid-cols-6 mt-2">
                                            @foreach ($complaint->files->whereNull('user_id') as $complaintFiles)
                                                @foreach ($complaintFiles->files as $complaintFile)
                                                    @if (isImageFile($complaintFile))
                                                        <li
                                                            class="col-span-2 md:col-span-2 border-2 border-blue-100 rounded-md">
                                                            <img class="object-cover w-full h-52 rounded-md"
                                                                src="{{ asset($complaintFile) }}" alt=""
                                                                alt="Picture 1">
                                                        </li>
                                                    @else
                                                        <li
                                                            class="col-span-2 md:col-span-2 border-2 border-blue-100 rounded-md">
                                                            <a href="{{ asset($complaintFile) }}" target="_blank"
                                                                style="width: 7rem; height: 7rem; margin: .5rem 1rem; background: #ddd"
                                                                alt="">
                                                                <div
                                                                    class="w-full h-full flex align-items-center justify-center text-red-500">

                                                                    <h3>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="60"
                                                                            height="60" fill="currentColor"
                                                                            class="bi bi-{{ File::extension($complaintFile) }}"
                                                                            viewBox="0 0 16 16">
                                                                            <path fill-rule="evenodd"
                                                                                d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z" />
                                                                        </svg>
                                                                    </h3>
                                                                </div>
                                                            </a>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($complaint->is_answered && $complaint->is_confirm)
                            <div class="text-center">
                                <span class="bg-gray-200 py-1.5 px-2 text-xs rounded-full text-gray-500">
                                    {{ jalaliDate($complaint->answered_at, 'd M Y') }}
                                </span>
                            </div>

                            <div class="flex justify-end">
                                <div
                                    class="bg-green-200 text-black border mt-4 leading-9 p-4 rounded-lg md:w-8/12 w-full text-base">
                                    {!! $complaint->answer !!}
                                </div>
                                <div class="relative mr-2 mt-4">
                                    <img class="w-12 h-12 border rounded-full object-cover"
                                        src="{{ asset('images/settings/support.png') }}" alt="">
                                </div>
                            </div>
                            @if ($complaint->files()->whereNotNull('user_id')->get()->isNotEmpty())
                                <div class="flex justify-end">
                                    <div class="flex justify-end w-full mr-0 md:ml-12 mb-4">
                                        <div class="text-gray-800 leading-9 rounded-lg md:w-8/12 w-full text-base">
                                            <ul id="reciver" class="grid grid-cols-6 mt-2" dir="ltr">
                                                @foreach ($complaint->files->whereNotNull('user_id') as $complaintFiles)
                                                    @foreach ($complaintFiles->files as $complaintFile)
                                                        @if (isImageFile($complaintFile))
                                                            <li
                                                                class="col-span-2 md:col-span-2 border-2 border-blue-100 rounded-md">
                                                                <img class="object-cover w-full h-52 rounded-md"
                                                                    src="{{ asset($complaintFile) }}" alt=""
                                                                    alt="Picture 1">
                                                            </li>
                                                        @else
                                                            <li
                                                                class="col-span-2 md:col-span-2 border-2 border-blue-100 rounded-md">
                                                                <a href="{{ asset($complaintFile) }}" target="_blank"
                                                                    style="width: 7rem; height: 7rem; margin: .5rem 1rem; background: #ddd"
                                                                    alt="">
                                                                    <div
                                                                        class="w-full h-full flex align-items-center justify-center text-red-500">

                                                                        <h3>
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                width="60" height="60"
                                                                                fill="currentColor"
                                                                                class="bi bi-{{ File::extension($complaintFile) }}"
                                                                                viewBox="0 0 16 16">
                                                                                <path fill-rule="evenodd"
                                                                                    d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z" />
                                                                            </svg>
                                                                        </h3>
                                                                    </div>
                                                                </a>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                @endforeach

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @else
                            <div class="flex justify-end">
                                <div
                                    class="bg-red-100 text-red-400 mb-4 border leading-9 p-2 rounded-lg md:w-8/12 w-full text-base">
                                    هنوز پاسخی برای این شکایت ثبت نشده است ، با تشکر از صبر و شکیبایی شما
                                </div>
                                <div class="relative mr-2">
                                    <img class="w-12 h-12 border rounded-full object-cover"
                                        src="{{ asset('images/settings/support.png') }}" alt="">
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif

        </section>
    @endsection

    @section('script')
        <script src="{{ asset('assets/app/plugins/viewer/js/viewer.min.js') }}"></script>
        <script>
            new Viewer(document.getElementById('sender'));
            new Viewer(document.getElementById('reciver'));
        </script>
    @endsection
