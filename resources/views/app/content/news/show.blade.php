@extends('app.layouts.app', ['title' => "$news->title"])

@section('head-tag')
    <link rel="stylesheet" href="{{ asset('assets/app/plugins/viewer/css/viewer.min.css') }}">

    <style>
        .tippy-box[data-theme~='indigo'] {
            color: azure;
            background-color: rgb(35, 194, 48);
        }

        .tippy-box[data-theme~='indigo'][data-placement^='top']>.tippy-arrow::before {
            border-top-color: rgb(35, 194, 48);
        }

        .tippy-box[data-theme~='indigo'][data-placement^='bottom']>.tippy-arrow::before {
            border-bottom-color: rgb(35, 194, 48);
        }

        .tippy-box[data-theme~='indigo'][data-placement^='left']>.tippy-arrow::before {
            border-left-color: rgb(35, 194, 48);
        }

        .tippy-box[data-theme~='indigo'][data-placement^='right']>.tippy-arrow::before {
            border-right-color: rgb(35, 194, 48);
        }
    </style>
@endsection

@section('content')
    <section class="mt-5 min-h-screen">
        <section class="grid grid-cols-12">
            <section class="col-span-12 md:col-span-9 md:ml-2">
                <section class="my-4 bg-gray-50 bg-opacity-50 p-4 md:p-8 text-gray-700 shadow-sm rounded">
                    <section class="w-full bg-gray-100 rounded-lg p-2.5 flex flex-wrap justify-center sm:justify-between items-center">
                        <div>
                            <div class="text-gray-600 flex items-center space-x-2 space-x-reverse">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3"
                                    stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244" />
                                </svg>
                                <span class="text-sm hidden sm:block">لینک کوتاه خبر</span>
                                <p class="text-xs mr-3 text-gray-400 cursor-pointer hover:text-green-500" id="short_link"
                                    onclick="copyLink()">
                                    {{ route('news.show-id', $news->id) }}</p>
                            </div>
                        </div>
                        <div class="mr-4 sm:mr-auto">
                            <div class="text-gray-600 flex flex-wrap items-center flex-end space-x-4 space-x-reverse">
                                <a href="whatsapp://send?text={{ route('news.show', $news) }}"
                                    data-action="share/whatsapp/share" target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                        fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                                        <path
                                            d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z" />
                                    </svg>
                                </a>
                                <a href="https://telegram.me/share/url?url={{ route('news.show', $news) }}" target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                        fill="currentColor" class="bi bi-telegram" viewBox="0 0 16 16">
                                        <path
                                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.287 5.906c-.778.324-2.334.994-4.666 2.01-.378.15-.577.298-.595.442-.03.243.275.339.69.47l.175.055c.408.133.958.288 1.243.294.26.006.549-.1.868-.32 2.179-1.471 3.304-2.214 3.374-2.23.05-.012.12-.026.166.016.047.041.042.12.037.141-.03.129-1.227 1.241-1.846 1.817-.193.18-.33.307-.358.336a8.154 8.154 0 0 1-.188.186c-.38.366-.664.64.015 1.088.327.216.589.393.85.571.284.194.568.387.936.629.093.06.183.125.27.187.331.236.63.448.997.414.214-.02.435-.22.547-.82.265-1.417.786-4.486.906-5.751a1.426 1.426 0 0 0-.013-.315.337.337 0 0 0-.114-.217.526.526 0 0 0-.31-.093c-.3.005-.763.166-2.984 1.09z" />
                                    </svg>
                                </a>
                                <a href="http://twitter.com/share?text={{ route('news.show', $news) }}"
                                    data-action="share/whatsapp/share" target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
                                        <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/>
                                      </svg>
                                </a>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-6 h-6 text-yellow-600">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.217 10.907a2.25 2.25 0 100 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186l9.566-5.314m-9.566 7.5l9.566 5.314m0 0a2.25 2.25 0 103.935 2.186 2.25 2.25 0 00-3.935-2.186zm0-12.814a2.25 2.25 0 103.933-2.185 2.25 2.25 0 00-3.933 2.185z" />
                                </svg>                                  
                            </div>
                        </div>
                        <div>
                    </section>
                    <section
                        class="flex flex-wrap lg:flex-nowrap space-y-4 md:space-y-4 justify-between gap-2 items-center">
                        <section class="space-y-4 w-screen lg:w-4/6">
                            <!-- title -->
                            <section class="text-lg md:text-2xl text-gray-700 font-bold">{{ $news->title }}</section>
                            <!-- utility -->
                            <section class="flex items-center space-x-3 space-x-reverse text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mx-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span class="text-sm">{{ jalaliDate($news->created_at, '%d %B، %Y') }}</span>
                            </section>
                            @can('edit_news')
                                <a href="{{ $news->privatePath() }}" target="_blank"
                                    class="flex space-x-2 space-x-reverse text-blue-700 font-bold">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>
                                    <span>ویرایش خبر</span>
                                </a>
                            @endcan
                            <section class="my-4 flex">
                                @foreach ($news->tags as $tag)
                                    <a href="{{ $tag->publicPath() }}"
                                        class="p-1 ml-2 text-sm text-gray-600 bg-white hover:bg-white border border-gray-300 rounded">#{{ $tag->title }}</a>
                                @endforeach
                            </section>
                        </section>
                        @if ($news->video)
                            <video id="news-video" class="video-js vjs-theme-forest rounded-lg" data-setup="{}" controls
                                preload="auto" width="540" height="220">
                                <source src="{{ asset($news->video->video) }}" type="video/mp4" />
                            </video>
                        @else
                            <img src="{{ asset($news->image) }}" class="w-full lg:w-2/6 h-5/6 object-cover rounded-lg"
                                alt="{{ $news->title }}">
                        @endif
                    </section>
                    <article class="py-6 text-gray-600 text-sm lg:text-base leading-8 lg:leading-10">
                        {!! $news->body !!}
                    </article>
                    <section>
                        @if ($news->gallerizable->isNotEmpty())
                            <section class="my-4 sm:my-8">
                                <ul id="images" class="grid grid-cols-4 gap-2">
                                    @foreach ($news->gallerizable as $gallery)
                                        <li class="col-span-4 sm:col-span-2 lg:col-span-1">
                                            <img class="object-cover w-full h-48 lg:h-32"
                                                src="{{ asset($gallery->image) }}" alt="{{ $gallery->alt }}"
                                                alt="Picture 1">
                                        </li>
                                    @endforeach
                                </ul>
                            </section>
                        @endif
                    </section>
                </section>
            </section>
            <aside class="col-span-12 sidebar md:col-span-3 mx-4 md:mx-2 space-y-4">
                <section class="overflow-y-auto px-0 bg-gray-100 shadow-sm bg-opacity-50 rounded">
                    <section class="flex text-gray-700 items-center px-2 py-4 border-b">
                        <span class="font-semibold text-sm">جدیدترین اخبار</span>
                    </section>
                    <ul class="mt-2 divide-y">
                        @foreach ($latestNews as $lastNews)
                            <li>
                                <a href="{{ $lastNews->publicPath() }}"
                                    class="relative flex items-center p-2 text-base transition-all delay-150 ease-in-out hover:bg-gray-50 border-r-2 hover:border-green-500 space-x-2 space-x-reverse">
                                    <div class="grid grid-cols-12">
                                        <div class="w-10 h-10  col-span-2">
                                            <img src="{{ asset($lastNews->image) }}"
                                                class="object-cover w-10 h-10 rounded-lg" alt="">
                                        </div>
                                        <div class="space-y-2 col-span-10 flex items-center">
                                            <h5
                                                class="flex-1 lg:mr-1 md:mr-5 font-bold pl-3 md:text-xs lg:text-sm text-gray-600">
                                                {{ Str::limit($lastNews->title, 60, '...') }}
                                            </h5>
                                            @if ($lastNews->video)
                                                <div
                                                    class="text-xs px-1 bg-indigo-400 text-gray-100 py-0.5 rounded absolute bottom-2 left-2 space-x-1 space-x-reverse flex">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-4 h-4">
                                                        <path stroke-linecap="round"
                                                            d="M15.75 10.5l4.72-4.72a.75.75 0 011.28.53v11.38a.75.75 0 01-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25h-9A2.25 2.25 0 002.25 7.5v9a2.25 2.25 0 002.25 2.25z" />
                                                    </svg>
                                                    <span>+ ویدئو</span>
                                                </div>
                                            @endif
                                            @if ($lastNews->gallerizable->isNotEmpty())
                                                <div
                                                    class="text-xs px-1 bg-green-400 text-gray-800 py-0.5 rounded absolute bottom-2 left-2 space-x-1 space-x-reverse flex">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-4 h-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
                                                    </svg>
                                                    <span>+ گالری تصاویر</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </section>
            </aside>
        </section>
    </section>
    <main>
        <div id="container" class="container">
        </div>
    </main>




@endsection

@section('script')
    <script src="{{ asset('assets/app/plugins/tippy/popper.min.js') }}"></script>
    <script src="{{ asset('assets/app/plugins/tippy/tippy-bundle.umd.js') }}"></script>
    <script>
        tippy('#short_link', {
            content: 'کپی',
            animation: 'fade',
            allowHTML: true,
        });

        tippy('#short_link', {
            trigger: 'click',
            theme: 'indigo',
            content: 'کپی شد !',
            allowHTML: true,
        });
    </script>
    <script>
        function copyLink() {
            // Get the text field
            let copyText = document.getElementById("short_link");

            // Copy the text inside the text field
            navigator.clipboard.writeText(copyText.innerHTML);
        }
    </script>
    <script src="{{ asset('assets/app/plugins/viewer/js/viewer.min.js') }}"></script>
    <script>
        new Viewer(document.getElementById('images'));
    </script>
@endsection
