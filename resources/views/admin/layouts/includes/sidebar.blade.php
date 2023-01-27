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
          <a href="#article" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
            <i class="fe fe-book fe-16"></i>
            <span class="ml-3 item-text">مقالات</span>
          </a>
          <ul class="collapse list-unstyled pl-4 w-100" id="article">
            <li class="nav-item">
              <a class="nav-link pl-3" href="./all-article.html"><span class="ml-1 item-text">همه مقالات </span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link pl-3" href="./create-article.html"><span class="ml-1 item-text">مقاله جدید</span></a>
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
          <a href="./setting.html" data-toggle="collapse" aria-expanded="false" class="nav-link">
            <i class="fe fe-settings fe-16"></i>
            <span class="ml-3 item-text">تنظیمات</span>
          </a>
        </li>

      </ul>
    </nav>
</aside>
