<aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
    <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
      <i class="fe fe-x"><span class="sr-only"></span></i>
    </a>
    <nav class="vertnav navbar navbar-light">
      <!-- nav bar -->
      <div class="w-100 mb-4 d-flex">
        <a class="mx-auto mt-2 flex-fill text-center" href="./index.html">
          <img src="{{ asset('images/settings/logo.jpg') }}" alt="logo" class="brand-sm ">
        </a>
      </div>
      <ul class="navbar-nav flex-fill w-100 mb-2">
        <li class="nav-item ">
          <a href="./index.html"  aria-expanded="false" class=" nav-link">
            <i class="fe fe-home fe-16"></i>
            <span class="ml-3 item-text">داشبورد</span><span class="sr-only">(current)</span>
          </a>
        </li>
      </ul>
      <p class="text-muted nav-heading mt-4 mb-1">
        <span>بخش محتوا</span>
      </p>
      <ul class="navbar-nav flex-fill w-100 mb-2">
        <li class="nav-item dropdown">
          <a href="#news" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-newspaper" viewBox="0 0 16 16">
              <path d="M0 2.5A1.5 1.5 0 0 1 1.5 1h11A1.5 1.5 0 0 1 14 2.5v10.528c0 .3-.05.654-.238.972h.738a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 1 1 0v9a1.5 1.5 0 0 1-1.5 1.5H1.497A1.497 1.497 0 0 1 0 13.5v-11zM12 14c.37 0 .654-.211.853-.441.092-.106.147-.279.147-.531V2.5a.5.5 0 0 0-.5-.5h-11a.5.5 0 0 0-.5.5v11c0 .278.223.5.497.5H12z"/>
              <path d="M2 3h10v2H2V3zm0 3h4v3H2V6zm0 4h4v1H2v-1zm0 2h4v1H2v-1zm5-6h2v1H7V6zm3 0h2v1h-2V6zM7 8h2v1H7V8zm3 0h2v1h-2V8zm-3 2h2v1H7v-1zm3 0h2v1h-2v-1zm-3 2h2v1H7v-1zm3 0h2v1h-2v-1z"/>
            </svg>
            <span class="ml-3 item-text">اخبار</span>
          </a>
          <ul class="collapse list-unstyled pl-4 w-100" id="news">
            <li class="nav-item">
              <a class="nav-link pl-3" href="{{ route('admin.content.news.index') }}"><span class="ml-1 item-text">همه اخبار </span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link pl-3" href="{{ route('admin.content.news.create') }}"><span class="ml-1 item-text">اخبار جدید</span></a>
            </li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a href="#places" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pin-map" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M3.1 11.2a.5.5 0 0 1 .4-.2H6a.5.5 0 0 1 0 1H3.75L1.5 15h13l-2.25-3H10a.5.5 0 0 1 0-1h2.5a.5.5 0 0 1 .4.2l3 4a.5.5 0 0 1-.4.8H.5a.5.5 0 0 1-.4-.8l3-4z"/>
              <path fill-rule="evenodd" d="M8 1a3 3 0 1 0 0 6 3 3 0 0 0 0-6zM4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999z"/>
            </svg>
            <span class="ml-3 item-text">مکان های گردشگری</span>
          </a>
          <ul class="collapse list-unstyled pl-4 w-100" id="places">
            <li class="nav-item">
              <a class="nav-link pl-3" href="{{ route('admin.content.places.index') }}"><span class="ml-1 item-text">همه مکان ها</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link pl-3" href="{{ route('admin.content.places.create') }}"><span class="ml-1 item-text">مکان گردشگری جدید</span></a>
            </li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a href="#public-call" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send-check" viewBox="0 0 16 16">
              <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855a.75.75 0 0 0-.124 1.329l4.995 3.178 1.531 2.406a.5.5 0 0 0 .844-.536L6.637 10.07l7.494-7.494-1.895 4.738a.5.5 0 1 0 .928.372l2.8-7Zm-2.54 1.183L5.93 9.363 1.591 6.602l11.833-4.733Z"/>
              <path d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Zm-1.993-1.679a.5.5 0 0 0-.686.172l-1.17 1.95-.547-.547a.5.5 0 0 0-.708.708l.774.773a.75.75 0 0 0 1.174-.144l1.335-2.226a.5.5 0 0 0-.172-.686Z"/>
            </svg>
            <span class="ml-3 item-text">فراخوان های عمومی</span>
          </a>
          <ul class="collapse list-unstyled pl-4 w-100" id="public-call">
            <li class="nav-item">
              <a class="nav-link pl-3" href="{{ route('admin.content.public-calls.index') }}"><span class="ml-1 item-text">همه فراخوان ها </span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link pl-3" href="{{ route('admin.content.public-calls.create') }}"><span class="ml-1 item-text">فراخوان جدید</span></a>
            </li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a href="#menu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-menu-up" viewBox="0 0 16 16">
              <path d="M7.646 15.854a.5.5 0 0 0 .708 0L10.207 14H14a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h3.793l1.853 1.854zM1 9V6h14v3H1zm14 1v2a1 1 0 0 1-1 1h-3.793a1 1 0 0 0-.707.293l-1.5 1.5-1.5-1.5A1 1 0 0 0 5.793 13H2a1 1 0 0 1-1-1v-2h14zm0-5H1V3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v2zM2 11.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 0-1h-8a.5.5 0 0 0-.5.5zm0-4a.5.5 0 0 0 .5.5h11a.5.5 0 0 0 0-1h-11a.5.5 0 0 0-.5.5zm0-4a.5.5 0 0 0 .5.5h6a.5.5 0 0 0 0-1h-6a.5.5 0 0 0-.5.5z"/>
            </svg>
            <span class="ml-3 item-text">منو ها</span>
          </a>
          <ul class="collapse list-unstyled pl-4 w-100" id="menu">
            <li class="nav-item">
              <a class="nav-link pl-3" href="{{ route('admin.content.menus.index') }}"><span class="ml-1 item-text">همه منو ها </span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link pl-3" href="{{ route('admin.content.menus.create') }}"><span class="ml-1 item-text">منوی جدید</span></a>
            </li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a href="#shafaf" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
            <i class="fe fe-pie-chart fe-16"></i>
            <span class="ml-3 item-text">شفاف سازی</span>
          </a>
          <ul class="collapse list-unstyled pl-4 w-100" id="shafaf">
            <li class="nav-item">
              <a class="nav-link pl-3" href="./all-shafaf.html"><span class="ml-1 item-text">همه فیش حقوقی </span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link pl-3" href="./create-shafaf.html"><span class="ml-1 item-text">شفاف سازی
                  جدید</span></a>
            </li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a href="#users" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
            <i class="fe fe-users fe-16"></i>
            <span class="ml-3 item-text">کاربران</span>
          </a>
          <ul class="collapse list-unstyled pl-4 w-100" id="users">
            <li class="nav-item">
              <a class="nav-link pl-3" href="./all-user.html"><span class="ml-1 item-text">همه کاربران </span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link pl-3" href="#"><span class="ml-1 item-text">کاربر جدید</span></a>
            </li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a href="#slider" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
            <i class="fe fe-layers
          fe-16"></i>
            <span class="ml-3 item-text">اسلایدر</span>
          </a>
          <ul class="collapse list-unstyled pl-4 w-100" id="slider">
            <li class="nav-item">
              <a class="nav-link pl-3" href="{{ route('admin.content.sliders.index') }}"><span class="ml-1 item-text">همه اسلایدر </span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link pl-3" href="{{ route('admin.content.sliders.create') }}"><span class="ml-1 item-text">اسلایدر جدید</span></a>
            </li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a href="#page" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
            <i class="fe fe-layers
          fe-16"></i>
            <span class="ml-3 item-text">صفحه ها</span>
          </a>
          <ul class="collapse list-unstyled pl-4 w-100" id="page">
            <li class="nav-item">
              <a class="nav-link pl-3" href="{{ route('admin.content.pages.index') }}"><span class="ml-1 item-text">همه صفحات </span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link pl-3" href="{{ route('admin.content.pages.create') }}"><span class="ml-1 item-text">صفحه جدید</span></a>
            </li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a href="./setting.html" data-toggle="collapse" aria-expanded="false" class="nav-link">
            <i class="fe fe-settings fe-16"></i>
            <span class="ml-3 item-text">تنظیمات</span>
          </a>
        </li>

      </ul>
    </nav>
</aside>
