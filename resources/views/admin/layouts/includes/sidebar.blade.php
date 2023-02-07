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
          <a href="{{ route('admin.index') }}"  aria-expanded="false" class="nav-link @active('admin.index') active @endactive">
            <i class="fe fe-home fe-16"></i>
            <span class="ml-3 item-text">داشبورد</span><span class="sr-only">(current)</span>
          </a>
        </li>
      </ul>
      <p class="text-muted nav-heading mt-2 mb-1">
        <small>بخش محتوا</small>
      </p>
      <ul class="navbar-nav flex-fill w-100 mb-2">
        <li class="nav-item dropdown @active('admin.content.news') active @endactive">
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
        <li class="nav-item dropdown @active('admin.content.places') active @endactive">
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
        <li class="nav-item dropdown @active('admin.content.public-calls') active @endactive">
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
        <li class="nav-item dropdown @active('admin.content.menus') active @endactive">
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
        <li class="nav-item dropdown @active('admin.content.sliders') active @endactive">
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
        <li class="nav-item dropdown @active('admin.content.pages') active @endactive">
          <a href="#page" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-medical" viewBox="0 0 16 16">
              <path d="M7.5 5.5a.5.5 0 0 0-1 0v.634l-.549-.317a.5.5 0 1 0-.5.866L6 7l-.549.317a.5.5 0 1 0 .5.866l.549-.317V8.5a.5.5 0 1 0 1 0v-.634l.549.317a.5.5 0 1 0 .5-.866L8 7l.549-.317a.5.5 0 1 0-.5-.866l-.549.317V5.5zm-2 4.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zm0 2a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5z"/>
              <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
            </svg>
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
        <p class="text-muted text-sm nav-heading mt-2 mb-1">
          <small>بخش کاربران و دسترسی ها </small>
        </p>
        <li class="nav-item dropdown @active('admin.user.users') active @endactive">
          <a href="#users" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
              <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8Zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022ZM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816ZM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4Z"/>
            </svg>
            <span class="ml-3 item-text">کاربران</span>
          </a>
          <ul class="collapse list-unstyled pl-4 w-100" id="users">
            <li class="nav-item">
              <a class="nav-link pl-3" href="{{ route('admin.user.users.index') }}"><span class="ml-1 item-text">همه کاربران </span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link pl-3" href="{{ route('admin.user.users.create') }}"><span class="ml-1 item-text">کاربر جدید</span></a>
            </li>
          </ul>
        </li>
        <li class="nav-item dropdown @active('admin.user.roles') active @endactive">
          <a href="#roles" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-shield-exclamation" viewBox="0 0 16 16">
              <path d="M5.338 1.59a61.44 61.44 0 0 0-2.837.856.481.481 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.725 10.725 0 0 0 2.287 2.233c.346.244.652.42.893.533.12.057.218.095.293.118a.55.55 0 0 0 .101.025.615.615 0 0 0 .1-.025c.076-.023.174-.061.294-.118.24-.113.547-.29.893-.533a10.726 10.726 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.775 11.775 0 0 1-2.517 2.453 7.159 7.159 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7.158 7.158 0 0 1-1.048-.625 11.777 11.777 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 62.456 62.456 0 0 1 5.072.56z"/>
              <path d="M7.001 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.553.553 0 0 1-1.1 0L7.1 4.995z"/>
            </svg>
            <span class="ml-3 item-text">سطوح دسترسی</span>
          </a>
          <ul class="collapse list-unstyled pl-4 w-100" id="roles">
            <li class="nav-item">
              <a class="nav-link pl-3" href="{{ route('admin.user.roles.index') }}"><span class="ml-1 item-text">همه نقش ها </span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link pl-3" href="{{ route('admin.user.roles.create') }}"><span class="ml-1 item-text">نقش جدید</span></a>
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
          <a href="./setting.html" data-toggle="collapse" aria-expanded="false" class="nav-link">
            <i class="fe fe-settings fe-16"></i>
            <span class="ml-3 item-text">تنظیمات</span>
          </a>
        </li>
      </ul>
    </nav>
</aside>
