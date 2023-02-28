<section x-data="{searchModal : false }" x-show="searchModal" x-transition x-cloak
    @open-search-modal.window="if ($event.detail.id == 'searchModal') searchModal = true"
    class="z-50 fixed w-screen h-screen flex items-center justify-center bg-gray-900 bg-opacity-80">
    <!-- close search -->
    <section class="absolute top-0 left-0 cursor-pointer flex flex-col items-center mt-4 ml-6 sm:ml-8 z-50"
        @click="searchModal = false">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 md:h-12 w-8 md:w-12 text-gray-100" fill="none" viewBox="0 0 24 24"
            stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </section>

    <form action="{{ route('search') }}" class="w-full flex justify-center items-center" method="get">
        <input type="text" name="search" class="search-input" placeholder="عنوان را جستجو کنید" autocomplete="off">
        <div></div>
    </form>
</section>
<div class="md:flex hidden h-auto p-4  bg-black">
    <div class="container flex flex-wrap items-center justify-between mx-auto">
        <span class="text-white z-40 mr-2 font-bold text-center items-center">
            تیتر جدید ترین خبر : <span class="font-normal text-sm">
                <div id="featured-slider" class="mt-2 text-right ">
                    <div id="slider" class="ml-9">
                        @foreach ($latestNews as $news )
                        <div class="slide">
                            <a href="{{ $news->publicPath() }}">{{ Str::limit($news->title, 70,'...')  }}</a>
                        </div>
                        @endforeach

                    </div>
                </div>
            </span>
        </span>
        <span style="font-family: iransans" class="text-white ml-2  items-end">
            {{ jalaliDate(date('Y-m-d')) }}
        </span>

    </div>
</div>