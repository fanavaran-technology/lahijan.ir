<section class="col-span-12 md:col-span-7 bg-white p-3 sm:p-4 md:p-6 rounded-lg">
    <section class="font-shabnam flex justify-between">
        <div class="border-r-4 border-indigo-400">&nbsp;&nbsp;آخرین اخبار</div>
        <a href="{{ route('news.index') }}" class="text-sm text-indigo-500">آرشیو اخبار</a>
    </section>
    <section class="mt-4">
        @foreach($news['latestNews'] as $news)
        <section class="rounded-lg bg-white p-1 sm:p-4 md:p-6 shadow transition-all hover:shadow-lg mt-4">
            <a href="#!">
                <img class="rounded-lg w-full object-cover md:h-60" src="{{ asset($news->image) }}"
                    alt="" />
            </a>
            <div>
                <section class="flex flex-col space-y-2">
                    <a href="{{ $news->publicPath() }}">
                        <h5 class="text-gray-900  text-base md:text-lg lg:text-xl font-medium mt-3">{{ $news->title }}</h5>
                    </a>
                    <p style="font-family: iransans" class="text-gray-600 text-sm lg:text-base mt-2 mb-4" >{{ Str::limit($news->summery, 150, '...') }}</p>

                </section>

                <section class="flex justify-end items-center mt-3">
                    <a href="{{ $news->publicPath() }}" class="flex items-center">
                        <span
                            class="text-green-600 text-sm sm:text-base transition-all hover:text-green-700 hover:mx-2">بیشتر
                            بخوانید</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor"
                            class="w-6 h-6 mt-1     text-blue-500">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                        </svg>
                    </a>
                </section>
            </div>
        </section>
        @endforeach

    </section>
</section>


