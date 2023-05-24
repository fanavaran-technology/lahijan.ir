<div class="p-2 border-b border-[#FF0035]  bg-gray-0">
    <div class="flex justify-between">
        <div class="order-first">
            <img src="{{ asset('images/2.png') }}" class="w-40" alt="">
        </div>
        <div class="md:order-last">
            <img src="{{ asset('images/3.png') }}" class="h-12" alt="">
        </div>

        <form>
            <div class="lg:flex md:flex lg:flex-row md:flex-row flex-col">
                <label for="search-dropdown" class="mb-2 text-sm font-medium text-gray-900 sr-only">Your Email</label>
                <div class="relative">
                    <input type="search" id="search-dropdown" class="block p-2.5 w-full lg:w-[600px] md:w-[400px] z-20 text-sm text-gray-900 bg-gray-100 rounded-lg border-l-gray-50 border-l-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 " placeholder="خبر مورد نظر خود را جست و جو کنید..." required>
                    <button type="submit" class="absolute h-full top-0 left-0 p-2.5 text-sm font-medium text-white bg-[#FF0035] rounded-l-lg border border-red-700 hover:bg-red-6   00 focus:ring-4 focus:outline-none focus:ring-blue-300 px-5">
{{--                        <svg aria-hidden="true" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>--}}
{{--                        <span class="sr-only">Search</span>--}}
                        جست و جو
                    </button>
                </div>
            </div>
        </form>


    </div>
</div>
</div>
