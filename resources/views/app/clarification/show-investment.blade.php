@extends('app.clarification.layouts.app', ['title' => "$investment->title"])

@section('content')
    <section class="min-h-screen">
        <section class="grid grid-cols-12 container">
            <section class="col-span-12 md:ml-2">
                <section class="my-4 bg-gray-50 bg-opacity-50 p-4 md:p-8 text-gray-700 shadow-sm rounded">
                    <section class="flex flex-wrap lg:flex-nowrap space-y-4 md:space-y-4 justify-between gap-2">
                        <section class="space-y-4 w-screen lg:w-4/6 mt-8">
                            <section>
                                <h5
                                    class="mb-2 text-lg text-center md:text-xl lg:text-2xl font-bold tracking-tight text-gray-900">
                                    {{ $investment->title }}</h5>
                            </section>
                            <section class="flex flex-col flex-wrap justify-around items-center text-gray-500">
                                <section class="flex text-base mt-3">
                                    <label class="ml-2">موقعیت: </label>
                                    <p>{{ $investment->position }}</p>
                                </section>
                                <section class="flex text-base mt-3">
                                    <label class="ml-2">آورده سرمایه گذار: </label>
                                    <p>{{ $investment->investor_task }}</p>
                                </section>
                                <section class="flex text-base mt-3">
                                    <label class="ml-2">آورده شهرداری: </label>
                                    <p>{{ $investment->municipality_task }}</p>
                                </section>
                                <section class="flex items-center text-base mt-3">
                                    <label class="ml-2">تاریخ شروع : </label>
                                    <p class="font-sans text-gray-400 text-sm">{{ jalaliDate($investment->start_date) }}</p>
                                </section>
                                <section class="flex items-center text-base mt-3">
                                    <label class="ml-2">تاریخ پایان: </label>
                                    <p class="font-sans text-gray-400 text-sm">{{ jalaliDate($investment->end_date) }}</p>
                                </section>
                            </section>
                        </section>
                        <section class="w-full lg:w-2/5 h-5/6 relative">
                            <img src="{{ asset($investment->image) }}" class="w-full h-full object-cover rounded-lg"
                                alt="{{ $investment->title }}">
                            @if ($investment->file)    
                            <a href="{{ asset($investment->file) }}" target="_blank" type="button"
                                class="flex focus:outline-none absolute bottom-2 left-2 text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2 mr-2 mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                    class="bi bi-filetype-pdf ml-2" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z" />
                                </svg>
                                <span>دریافت فایل آگهی</span>
                            </a>
                            @endif
                        </section>
                    </section>
                    <article class="py-6 text-gray-600 text-sm lg:text-base leading-8 lg:leading-10">
                        {!! $investment->description !!}
                    </article>
                </section>
            </section>
        </section>
    </section>
@endsection
