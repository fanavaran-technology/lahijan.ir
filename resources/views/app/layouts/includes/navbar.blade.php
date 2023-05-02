<nav
class="{{ Route::currentRouteName() == 'home' ? 'sm:absolute' : 'border-b' }} font-vazir top-nav  z-40 w-full lg:bg-black lg:bg-opacity-70 md:bg-black bg-[#000601] bg-opacity-[83%]  md:bg-opacity-70 border-gray-200 px-2 md:px-4 py-2.5">
<div class="container flex flex-wrap items-center justify-between mx-auto">
  <div class="flex items-center">
    <a href="{{ route('home') }}">
      <img src="{{ asset(Setting::getValue('logo')) }}" alt="لوگوی سایت" class="h-16 md:h-[5.5rem]  whitespace-nowrap">
    </a>
  </div>
  <div class="flex md:order-2">
    <div class="flex md:order-2 ">
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
        @foreach ($menus->whereNull('parent_id') as $menu)
        @if (($menu->childrens->count()))
            <li class="md:ml-4 ml-6">
        <button id="dropdownNavbarLink" data-dropdown-toggle="{{ $loop->iteration }}-parentMenu"
          class="flex items-center  whitespace-nowrap w-full text-gray-100 font-bold  border-gray-100 hover:bg-gray-500 md:hover:bg-transparent  md:hover:text-green-400 p-1 md:p-0 md:w-auto">
            {{ $menu->title }}<svg class="w-4 h-4 ml-1" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
              clip-rule="evenodd"></path>
          </svg></button>
        <!-- Dropdown menu -->
        <div id="{{ $loop->iteration }}-parentMenu"
          class="z-10 hidden font-normal bg-white w-40 divide-y divide-gray-100 rounded shadow "
          style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(1105px, 57px);"
          data-popper-placement="bottom">

          @php
          $allSubmenus = $menu->childrens;
          @endphp

            @include('app.layouts.includes.components.head-menu-items', ['menus' => $allSubmenus])
        </div>
      </li>
            @else
                <li class="md:ml-4 ml-6">
                    <a href="{{ empty($menu->url) ? URL::to('/') : $menu->url }}" class="block font-bold whitespace-nowrap text-white border-b border-gray-100 hover:bg-gray-50  md:border-0 md:hover:bg-transparent  md:hover:text-green-400 p-1 md:p-0">{{ $menu->title }}</a>
                </li>
            @endif
        @endforeach
    </ul>

  </div>

</div>

</nav>
