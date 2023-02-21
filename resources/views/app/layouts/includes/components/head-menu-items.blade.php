<ul class="py-1 text-sm text-gray-700" aria-labelledby="dropdownLargeButton">
    @foreach($menus as $submenu)

        @php
            $allSubmenus = $submenu->childrens;
        @endphp
        @if($allSubmenus->count() == 0)
            <li>
                <a href="{{ $submenu->url ?? '#' }}" class="block  px-4 py-2 hover:bg-gray-100">
                    {{ $submenu->title }}</a>
            </li>
        @else

            @php
                $uniqueMenu = rand(1,1000);
            @endphp

            <li aria-labelledby="dropdownNavbarLink">
                <button id="doubleDropdownButton" data-dropdown-toggle="{{ $loop->iteration }}-menu-{{ $uniqueMenu }}"
                        data-dropdown-placement="left-start" type="button"
                        class="flex items-center  w-full px-4 py-2 hover:bg-gray">
                    {{ $submenu->title }}
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"></path>
                    </svg>
                </button>
                <div id="{{ $loop->iteration }}-menu-{{ $uniqueMenu }}" class="z-10 hidden w-32 bg-white divide-y divide-gray-100 rounded shadow "
                     style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(10px, 0px);"
                     data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="right-start">
                        @include('app.layouts.includes.components.head-menu-items' , ['menus' => $allSubmenus])
                </div>
            </li>
        @endif
    @endforeach
</ul>
