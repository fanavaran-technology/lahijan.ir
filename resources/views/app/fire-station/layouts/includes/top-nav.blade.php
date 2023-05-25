    <div class="p-2 border-b border-[#FF0035]  bg-gray-0">
        <div class="flex flex-col md:flex-row md:justify-between">
            <div class="flex justify-between md:hidden w-full md:w-auto">
                <img src="{{ asset('images/2.png') }}" class="w-40" alt="">
                <img src="{{ asset('images/3.png') }}" class="h-12 md:mr-2" alt="">
            </div>
            <div class="order-first md:flex hidden">
                <img src="{{ asset('images/2.png') }}" class="w-40" alt="">
            </div>
            <div class="md:order-last md:flex hidden">
                <img src="{{ asset('images/3.png') }}" class="h-12" alt="">
            </div>

            <form action="{{ route('fire-search') }}" method="get">
                <div class="lg:flex md:flex lg:flex-row md:flex-row md:mt-0 my-2 flex-col">
                    <div class="relative">
                        <input type="text" name="search"  class="block p-2.5 w-full lg:w-[600px] md:w-[400px] z-20 text-sm text-gray-900 bg-gray-100 rounded-lg border-l-gray-50 border-l-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 " placeholder="خبر مورد نظر خود را جست و جو کنید..." required>
                        <button type="submit"  class="absolute h-full top-0 left-0 p-2.5 text-sm font-medium text-white bg-[#FF0035] rounded-l-lg border border-red-700 hover:bg-red-6   00 focus:ring-4 focus:outline-none focus:ring-blue-300 px-5">
                            جست و جو
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
    </div>

