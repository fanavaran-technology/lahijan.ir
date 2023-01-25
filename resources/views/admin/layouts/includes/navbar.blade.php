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
            <img src="{{ asset('images/avatars/profile.jpg') }}" alt="..." class="avatar-img rounded-circle">
          </span>
        </a>
        <div class="dropdown-menu dropdown-menu-right " aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item text-secondary text-left" href="#">Alireza Alikhani</a>
          <hr class="mb-1 mt-1">
          <a class="dropdown-item text-secondary text-left" href="#">
            <i class="fe fe-user"></i>
            پروفایل
          </a>
          <a class="dropdown-item text-secondary text-left" href="#">
            <i class="fe fe-settings"></i>
            تنظیمات حساب</a>
          <a class="dropdown-item text-secondary text-left" href="#">
            <i class="fe fe-log-out"></i>
            خروج</a>
        </div>
      </li>
    </ul>
  </nav>