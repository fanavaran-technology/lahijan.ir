@extends('app.layouts.app', ['title' => 'شهرداری لاهیجان | آرشیو اخبار'])

@section('head-tag')
    <link rel="stylesheet" href="{{ asset('assets/app/plugins/datepicker/datepicker.min.css') }}">
@endsection

@section('content')
    <section class="container mt-5 min-h-screen">
        <section class="text-xl sm:text-2xl md:text-2xl font-bold mt-10 text-gray-700">
            آرشیو خبر ها
        </section>
        <section class="block sm:flex items-center sm:space-y-0 space-y-4 my-8">
            <form action="">
                <div class="flex space-x-2 space-x-reverse">
                    <div class="flex items-center w-1/2 md:w-40 space-x-2 space-x-reverse">
                        <label for="start-date" class="text-sm text-gray-700">از</label>
                        <input type="text" name="start_date" id="start-date" autocomplete="off"
                               value="{{ request('start_date') }}"
                               class="datepicker w-full text-sm p-1.5 border border-gray-300 focus:border-none text-gray-700 rounded">
                    </div>
                    <div class="flex items-center w-1/2 md:w-40 space-x-2 space-x-reverse">
                        <label for="end-date" class="text-sm text-gray-700">تا</label>
                        <input type="text" name="end_date" id="end-date" autocomplete="off"
                               value="{{ request('end_date') }}"
                               class="datepicker w-full text-sm p-1.5 border border-gray-300 focus:border-none text-gray-700 rounded">
                    </div>
                    <button type="submit"
                            class="focus:outline-none text-white bg-green-600 hover:bg-green-700 font-medium rounded-lg text-sm px-3 py-1.5">
                        فیلتر
                    </button>
                </div>
            </form>
            <div class="flex justify-center space-x-4 space-x-reverse">
                <div class="flex items-center mr-0 sm:mr-8">
                    <input id="video" type="checkbox" onclick="filterAction(this)" data-filter="video"
                           data-action="{{ request()->fullUrlWithQuery(['video' => 1]) }}" @checked(request('video'))
                           class="w-5 h-5 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 focus:ring-2">
                    <label for="video" class="mr-2 text-sm font-medium text-gray-900">ویدئو ها</label>
                </div>
                <div class="flex items-center mr-0 sm:mr-8">
                    <input id="gallery" type="checkbox" onclick="filterAction(this)" data-filter="gallery"
                           data-action="{{ request()->fullUrlWithQuery(['gallery' => 1]) }}"
                           @checked(request('gallery'))
                           class="w-5 h-5 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 focus:ring-2">
                    <label for="gallery" class="mr-2 text-sm font-medium text-gray-900">گالری تصاویر</label>
                </div>
            </div>
        </section>
        <section class="space-y-2 md:space-y-0">
            @if (request('start_date') || request('end_date'))
                <span id="badge-dismiss-green"
                      class="inline-flex items-center px-2 py-2 ml-2 text-sm font-medium text-blue-800 bg-blue-100 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z"/>
                    </svg>&nbsp;
                    از {{ request('start_date') ?? '1380/09/28' }}
                    تا {{ request('end_date') ?? 'تا زمان جاری' }}
                    <button type="button" id="date-filter-badge"
                            class="inline-flex items-center p-0.5 mr-2 text-sm text-blue-400 bg-transparent rounded-sm hover:bg-blue-200"
                            aria-label="Remove">
                        <svg aria-hidden="true" class="w-3.5 h-3.5" aria-hidden="true" fill="currentColor"
                             viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                  clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Remove badge</span>
                    </button>
                </span>
            @endif
            @request('gallery')
            <span id="badge-dismiss-green"
                  class="inline-flex items-center px-2 py-2 ml-2 text-sm font-medium text-blue-800 bg-blue-100 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/>
                    </svg>&nbsp;
                    + گالری تصاویر
                    <button type="button" onclick="removeFilter('gallery')"
                            class="inline-flex items-center p-0.5 mr-2 text-sm text-blue-400 bg-transparent rounded-sm hover:bg-blue-200"
                            aria-label="Remove">
                        <svg aria-hidden="true" class="w-3.5 h-3.5" aria-hidden="true" fill="currentColor"
                             viewBox="0 0 20 20"
                             xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                  clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Remove badge</span>
                    </button>
                </span>
            @endrequest
            @request('video')
            <span id="badge-dismiss-green"
                  class="inline-flex items-center px-2 py-2 ml-2 text-sm font-medium text-blue-800 bg-blue-100 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round"
                              d="M15.75 10.5l4.72-4.72a.75.75 0 011.28.53v11.38a.75.75 0 01-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25h-9A2.25 2.25 0 002.25 7.5v9a2.25 2.25 0 002.25 2.25z"/>
                    </svg>&nbsp;
                    + ویدئو
                    <button type="button" onclick="removeFilter('video')"
                            class="inline-flex items-center p-0.5 mr-2 text-sm text-blue-400 bg-transparent rounded-sm hover:bg-blue-200"
                            aria-label="Remove">
                        <svg aria-hidden="true" class="w-3.5 h-3.5" aria-hidden="true" fill="currentColor"
                             viewBox="0 0 20 20"
                             xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                  clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Remove badge</span>
                    </button>
                </span>
            @endrequest
        </section>

        <!-- news -->
        <section class="grid grid-cols-12 gap-6">
            @foreach ($allNews as $news)
                <section
                    class="col-span-12 sm:col-span-6 lg:col-span-4 rounded-lg flex justify-between flex-col {{ $news->is_pined ? 'relative bg-blue-50 border border-blue-400 skew-100' : 'bg-white' }} p-3 sm:p-4 md:p-6 shadow transition-all hover:shadow-lg mt-4">
                    @if ($news->is_pined)
                        <section class="absolute top-3 right-3 z-50">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-10 h-10 text-blue-600 border border-blue-600 skew-x-2 bg-white bg-opacity-75 rounded-full p-1"
                                 fill="currentColor" class="bi bi-pin-angle" viewBox="0 0 16 16">
                                <path
                                    d="M9.828.722a.5.5 0 0 1 .354.146l4.95 4.95a.5.5 0 0 1 0 .707c-.48.48-1.072.588-1.503.588-.177 0-.335-.018-.46-.039l-3.134 3.134a5.927 5.927 0 0 1 .16 1.013c.046.702-.032 1.687-.72 2.375a.5.5 0 0 1-.707 0l-2.829-2.828-3.182 3.182c-.195.195-1.219.902-1.414.707-.195-.195.512-1.22.707-1.414l3.182-3.182-2.828-2.829a.5.5 0 0 1 0-.707c.688-.688 1.673-.767 2.375-.72a5.922 5.922 0 0 1 1.013.16l3.134-3.133a2.772 2.772 0 0 1-.04-.461c0-.43.108-1.022.589-1.503a.5.5 0 0 1 .353-.146zm.122 2.112v-.002.002zm0-.002v.002a.5.5 0 0 1-.122.51L6.293 6.878a.5.5 0 0 1-.511.12H5.78l-.014-.004a4.507 4.507 0 0 0-.288-.076 4.922 4.922 0 0 0-.765-.116c-.422-.028-.836.008-1.175.15l5.51 5.509c.141-.34.177-.753.149-1.175a4.924 4.924 0 0 0-.192-1.054l-.004-.013v-.001a.5.5 0 0 1 .12-.512l3.536-3.535a.5.5 0 0 1 .532-.115l.096.022c.087.017.208.034.344.034.114 0 .23-.011.343-.04L9.927 2.028c-.029.113-.04.23-.04.343a1.779 1.779 0 0 0 .062.46z"/>
                            </svg>
                        </section>
                    @endif
                    <a href="{{ $news->publicPath() }}" class="relative">
                        <img class="rounded-lg w-full h-44 object-cover" src="{{ asset($news->image) }}"
                             alt="{{ $news->title }}"/>
                        <h5 class="text-gray-900 text-base md:text-base lg:text-lg font-medium my-4">
                            {{ Str::limit($news->title, 100, '...') }}
                        </h5>
                        @if ($news->video)
                            <div
                                class="text-xs px-1 bg-indigo-400 text-gray-100 py-0.5 rounded absolute top-2 left-2 space-x-1 space-x-reverse flex">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round"
                                        d="M15.75 10.5l4.72-4.72a.75.75 0 011.28.53v11.38a.75.75 0 01-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25h-9A2.25 2.25 0 002.25 7.5v9a2.25 2.25 0 002.25 2.25z" />
                                </svg>
                                <span>+ ویدئو</span>
                            </div>
                        @endif
                    </a>
                    <section class="flex justify-between items-center">
                        <div class="flex flex-col sm:flex-row justify-center items-center sm:space-x-4">
                            <img class="w-10 h-10 rounded-full object-cover"
                                 src="{{ asset($news->user->profile_image) }}" alt="">
                            <div class="font-medium">
                                <div class="text-xs sm:text-sm text-gray-600 mx-2 text-center">
                                    {{ $news->user->full_name }}
                                </div>
                                <div class="text-gray-500 text-xs mx-2">{{ jalaliDate($news->created_at, '%d %B، %Y') }}
                                </div>
                            </div>
                        </div>
                        <a href="{{ $news->publicPath() }}" class="flex items-center">
                            <span
                                class="text-green-600 text-sm sm:text-base transition-all hover:text-green-700 hover:mx-2">بیشتر
                                بخوانید</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mt-1     text-blue-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18"/>
                            </svg>
                        </a>
                    </section>
                    </div>
                </section>

            @endforeach

        </section>
        <section class="overflow-x-hidden mt-10 flex justify-center">
            {{ $allNews->appends($_GET)->render('vendor.pagination.tailwind') }}
        </section>
    </section>
@endsection

@section('script')
    <script src="{{ asset('assets/app/plugins/datepicker/datepicker.min.js') }}"></script>
    <script>
        jalaliDatepicker.startWatch({
            maxDate: 'today',
            selector: ".datepicker",
            time: false
        });
    </script>

    <script>
        function removeFilter(key, action = true, url = location.href) {
            let sourceURL = url;
            let rtn = sourceURL.split("?")[0],
                param,
                params_arr = [],
                queryString = (sourceURL.indexOf("?") !== -1) ? sourceURL.split("?")[1] : "";
            if (queryString !== "") {
                params_arr = queryString.split("&");
                for (let i = params_arr.length - 1; i >= 0; i -= 1) {
                    param = params_arr[i].split("=")[0];
                    if (param === key) {
                        params_arr.splice(i, 1);
                    }
                }
                if (params_arr.length) rtn = rtn + "?" + params_arr.join("&");
            }
            if (!action)
                return rtn;

            location.href = rtn;
        }

        document.querySelector('#date-filter-badge').addEventListener('click', (e) => {
            let newUrl = removeFilter('start_date', false);
            removeFilter('end_date', true, newUrl);
        });

        function filterAction(checkbox) {
            const filterName = checkbox.getAttribute('data-filter');
            const action = checkbox.getAttribute('data-action');
            checkbox.checked ? location.href = action : removeFilter(filterName);
        }
    </script>


@endsection
