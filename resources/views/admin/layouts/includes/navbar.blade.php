<nav class="topnav navbar navbar-light">
    <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
      <i class="fe fe-menu navbar-toggler-icon"></i>
    </button>
    <form class="form-inline  mr-auto searchform text-muted">
      <input class="form-control  mr-sm-2 bg-transparent border-0 pl-2 text-muted" type="search"
        placeholder="جستجو کنید..." aria-label="Search">
    </form>
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link text-muted my-2" href="./#" data-toggle="modal" data-target=".modal-shortcut">
          <span class="fe fe-grid fe-16"></span>
        </a>
      </li>
      <li class="nav-item nav-notif">
        <a class="nav-link text-muted my-2" href="./#" data-toggle="modal" data-target=".modal-notif">
          <span class="fe fe-bell fe-16"></span>
          <span class="dot dot-md bg-success"></span>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-muted pr-0 mx-2" href="#" id="navbarDropdownMenuLink" role="button"
          data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="avatar avatar-sm mt-2">
            <img src="{{ asset(auth()->user()->profile_image) }}" alt="{{ auth()->user()->full_name }}" class="profile_image">
          </span>
        </a>
        <div class="dropdown-menu dropdown-menu-right " aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item text-secondary text-left" href="#">{{ auth()->user()->full_name }}</a>
          <hr class="mb-1 mt-1">
          <a class="dropdown-item text-secondary text-left" href="{{ route('admin.user.profile.index') }}">
            <i class="fe fe-user"></i>
            پروفایل
          </a>
          <a class="dropdown-item text-secondary text-left" href="#">
            <i class="fe fe-settings"></i>
            تنظیمات حساب</a>
          <form action="{{ route('logout') }}" method="post" class="d-flex align-items-center">
            @csrf
            <button class="dropdown-item text-secondary text-left" href="#">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
              </svg>
              خروج
            </button>
          </form>
        </div>
      </li>
    </ul>
  </nav>