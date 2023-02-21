<nav
class="{{ Route::currentRouteName() == 'home' ? 'sm:absolute' : 'border-b' }} font-vazir  z-40 w-full lg:bg-black lg:bg-opacity-70 md:bg-black bg-[#000601] bg-opacity-[83%]  md:bg-opacity-70 border-gray-200 px-2 md:px-4 py-2.5">
<div class="container flex flex-wrap items-center justify-between mx-auto">
  <div class="flex items-center">
    <a href="{{ route('home') }}">
      <img src="{{ asset(Setting::getValue('logo')) }}" alt="لوگوی سایت" class="h-14 whitespace-nowrap">
    </a>
  </div>
  <div class="flex md:order-2">
    <div class="flex md:order-2 ">
      {{-- <a href="#"
        class="p-2.5 text-center items-end text-gray-100 focus:outline-none focus:ring-1 focus:ring-gray-200 rounded-lg">
        <svg class="text-white mt-1 w-5 h-5 text-center items-center" viewBox="0 0 20 20"
          xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-telephone-forward">
          <path class="text-center"
            d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511zm10.762.135a.5.5 0 0 1 .708 0l2.5 2.5a.5.5 0 0 1 0 .708l-2.5 2.5a.5.5 0 0 1-.708-.708L14.293 4H9.5a.5.5 0 0 1 0-1h4.793l-1.647-1.646a.5.5 0 0 1 0-.708z" />
        </svg>
      </a> --}}
      <button type="button" x-data="{id : 'searchModal'}" @click="$dispatch('open-search-modal',{id})"
        aria-controls="navbar-search" aria-expanded="false"
        class="text-gray-200 hover:text-gray-50 rounded-lg text-sm p-2.5 mr-1">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
        </svg>
        <span class="sr-only">Search</span>
      </button>
    </div>
    <div class="flex items-center md:order-1">
      <button data-collapse-toggle="mega-menu" type="button"
        class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
        aria-controls="mega-menu" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
          xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd"
            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
            clip-rule="evenodd"></path>
        </svg>
      </button>
    </div>
  </div>

  <div id="mega-menu"
    class="hidden  items-center w-full text-sm md:text-xs lg:text-sm md:flex md:w-auto md:order-1">
    <ul class="flex flex-col mt-4 font-medium md:flex-row md:space-x-4 lg:space-x-6 md:mt-0">
      <li class="md:ml-4 ml-6">
        <button id="dropdownNavbarLink" data-dropdown-toggle="1-parentMenu"
          class="flex items-center  whitespace-nowrap w-full text-gray-100 font-bold  border-gray-100 hover:bg-gray-500 md:hover:bg-transparent  md:hover:text-green-400 p-1 md:p-0 md:w-auto">درباره
          ما<svg class="w-4 h-4 ml-1" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
              clip-rule="evenodd"></path>
          </svg></button>
        <!-- Dropdown menu -->
        <div id="1-parentMenu"
          class="z-10 hidden font-normal bg-white w-40 divide-y divide-gray-100 rounded shadow "
          style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(1105px, 57px);"
          data-popper-placement="bottom">

          <ul class="py-1 text-sm text-gray-700" aria-labelledby="dropdownLargeButton">
            <li>
              <a href="#" class="block  px-4 py-2 hover:bg-gray-100">
                 معرفی شهر لاهیجان</a>
            </li>

            <li aria-labelledby="dropdownNavbarLink">
              <button id="doubleDropdownButton" data-dropdown-toggle="6-menu-594"
                data-dropdown-placement="left-start" type="button"
                class="flex items-center  w-full px-4 py-2 hover:bg-gray">
                زیر منو
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                  stroke="currentColor" class="w-4 h-4">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"></path>
                </svg>
              </button>
              <div id="6-menu-594" class="z-10 hidden w-32 bg-white divide-y divide-gray-100 rounded shadow "
                style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(10px, 0px);"
                data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="right-start">
                <ul class="py-1 text-sm text-gray-700" aria-labelledby="dropdownLargeButton">
                  <li>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-100">
                      زیر منو</a>
                  </li>
                </ul>
              </div>
            </li>
          </ul>
        </div>
      </li>

      <li class="md:ml-4 ml-6">
        <a href="#"
          class="block font-bold whitespace-nowrap text-gray-100  border-gray-100 hover:bg-gray-500 md:hover:bg-transparent md:border-0 md:hover:text-green-400 p-1 md:p-0">خانه</a>
      </li>
      <li class="md:ml-4 ml-6">
        <a href="#"
          class="block font-bold whitespace-nowrap text-gray-100  border-gray-100 hover:bg-gray-500 md:hover:bg-transparent md:border-0 md:hover:text-green-400 p-1 md:p-0">پیوند
          ها</a>
      </li>
      <li class="md:ml-4 ml-6">
        <a href="#"
          class="block font-bold whitespace-nowrap text-gray-100  border-gray-100 hover:bg-gray-500 md:hover:bg-transparent md:border-0 md:hover:text-green-400 p-1 md:p-0">مالی</a>
      </li>
      <li class="md:ml-4 ml-6">
        <button id="dropdownNavbarLink" data-dropdown-toggle="4-parentMenu"
          class="flex items-center  whitespace-nowrap w-full text-gray-100 font-bold  border-gray-100 hover:bg-gray-500 md:hover:bg-transparent md:border-0 md:hover:text-green-400 p-1 md:p-0 md:w-auto">درباره
          شهر<svg class="w-4 h-4 ml-1" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
              clip-rule="evenodd"></path>
          </svg></button>
        <!-- Dropdown menu -->
        <div id="4-parentMenu"
          class="z-10 hidden font-normal w-40 bg-white divide-y divide-gray-100 rounded shadow "
          style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(792px, 57px);"
          data-popper-placement="bottom">

          <ul class="py-1 text-sm text-gray-700" aria-labelledby="dropdownLargeButton">
            <li>
              <a href="#" class="block px-4 py-2 hover:bg-gray-100">
                زیر منو</a>
            </li>


          </ul>
        </div>
      </li>
      <li class="md:ml-4 ml-6">
        <a href="#"
          class="block font-bold whitespace-nowrap text-gray-100  border-gray-100 hover:bg-gray-500 md:hover:bg-transparent md:border-0 md:hover:text-green-400 p-1 md:p-0">ضوابط
          و شرایط</a>
      </li>
      <li class="md:ml-4 ml-6">
        <button id="dropdownNavbarLink" data-dropdown-toggle="7-parentMenu"
          class="flex items-center whitespace-nowrap w-full text-gray-100 font-bold  border-gray-100 hover:bg-gray-500 md:hover:bg-transparent md:border-0 md:hover:text-green-400 p-1 md:p-0 md:w-auto">ارتباط
          با ما<svg class="w-4 h-4 ml-1" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
              clip-rule="evenodd"></path>
          </svg></button>
        <!-- Dropdown menu -->
        <div id="7-parentMenu"
          class="z-10 hidden font-normal ص-40 bg-white divide-y divide-gray-100 rounded shadow w-auto"
          style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(419px, 57px);"
          data-popper-placement="bottom">

          <ul class="py-1 text-sm text-gray-700" aria-labelledby="dropdownLargeButton">
            <li>
              <a href="#" class="block px-4 py-2 hover:bg-gray-100">
                راه هاى ارتباطى</a>
            </li>
            <li>
              <a href="#" class="block px-4 py-2 hover:bg-gray-100">
                پيشنهادات و انتقادات</a>
            </li>
            <li>
              <a href="#" class="block px-4 py-2 hover:bg-gray-100">
                رضايتمندى </a>
            </li>

          </ul>
        </div>
      </li>
    </ul>

  </div>

</div>

</nav>
