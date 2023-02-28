<section x-data="{ openTab: 'photo' }" class="bg-white rounded-lg pb-4">
    <section>
        <ul class="flex p-4 justify-center items-center -mb-px text-sm font-medium text-center text-gray-500">
            <li @click="openTab = 'photo'" class="mr-2">
                <a href="#!"
                    class="px-2 lg:px-4 py-2 flex  items-center justify-center space-x-2 space-x-reverse group"
                    :class="openTab == 'photo' ? 'active-tab' : 'unactive-tab'">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
                    </svg>
                    <span>گزارش تصویری</span>
                </a>
            </li>
            <li @click="openTab = 'video'" class="mr-2">
                <a href="#!"
                    class="py-2 px-2 lg:px-4 flex items-center justify-center space-x-2 space-x-reverse group"
                    :class="openTab === 'video' ? 'active-tab' : 'unactive-tab'">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round"
                            d="M15.75 10.5l4.72-4.72a.75.75 0 011.28.53v11.38a.75.75 0 01-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25h-9A2.25 2.25 0 002.25 7.5v9a2.25 2.25 0 002.25 2.25z" />
                    </svg>
                    <span>ویدئو ها</span>
                </a>
            </li>
        </ul>
    </section>

    <section x-show="openTab === 'video'" class="px-6 py-2 flex justify-center">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper h-60">
                @forelse ($news['newsHasVideo'] as $newsVideo)
                    <a href="{{ $newsVideo->publicPath() }}" class="swiper-slide hover:cursor-pointer">

                        <img class="rounded-lg object-cover" src="{{ $newsVideo->image }}">
                        <div class="text-gray-50 z-50  bg-gray-900 p-1 rounded-lg text-sm absolute bottom-2 right-2">
                            {{ Str::limit($newsVideo->title, 60, '...') }}</div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-[100%] h-[40%] text-white rounded-full absolute top-[30%]">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.91 11.672a.375.375 0 010 .656l-5.603 3.113a.375.375 0 01-.557-.328V8.887c0-.286.307-.466.557-.327l5.603 3.112z" />
                        </svg>
                    </a>
                @empty
                    <p>ویدیو وجود ندارد</p>
                @endforelse
            </div>

            <div class="swiper-button-next text-gray-100 hover:text-gray-300"></div>
            <div class="swiper-button-prev text-gray-100 hover:text-gray-300"></div>
        </div>
    </section>

    <section x-show="openTab === 'photo'" class="px-6 py-2 flex justify-center">
        <div class="bg-black w-full lg:h-60 rounded-lg  relative">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper h-60">
                    @forelse ($news['reportImages'] as $reportImage)
                        <a href="{{ $reportImage->publicPath() }}" class="swiper-slide hover:cursor-pointer">
                            <img class="rounded-lg object-cover" src="{{ $reportImage->image }}">
                            <div
                                class="text-gray-50 z-50  bg-gray-900 p-1 rounded-lg text-sm absolute bottom-2 right-2">
                                {{ Str::limit($reportImage->title, 60, '...') }}</div>
                            <span style="font-family: iransans"
                                class="z-50 flex bg-gray-800 absolute top-2 left-2 text-gray-100 rounded px-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mx-2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                </svg>
                            </span>
                        </a>
                    @empty
                        <p class="w-full flex justify-center items-center z-50 text-white text-lg">عکسی وجود ندارد</p>
                    @endforelse
                </div>

                <div class="swiper-button-next text-gray-100 hover:text-gray-300"></div>
                <div class="swiper-button-prev text-gray-100 hover:text-gray-300"></div>
            </div>

        </div>
    </section>

</section>

