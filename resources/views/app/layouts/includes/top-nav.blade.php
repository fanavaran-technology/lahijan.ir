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
        <span class="text-white mr-2 font-bold text-center items-center">
            تیتر جدید ترین خبر : <span class="font-normal text-sm">شهردار لاهیجان از آمادگی ستاد عملیات زمستانی شهرداری
                خبر
                داد</span>
        </span>
        <span class="text-white ml-2  items-end">{{ jalaliDate(now()) }}</span>
    </div>
</div>
