<nav class="topnav navbar navbar-light">

    <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
        <i class="fe fe-menu navbar-toggler-icon"></i>
    </button>
    <form class="form-inline  mr-auto searchform text-muted">
        <input class="form-control  mr-sm-2 bg-transparent border-0 pl-2 text-muted" type="search"
            placeholder="جستجو کنید..." aria-label="Search">
    </form>
    <ul class="nav">

        @canany(['manage_complaint', 'complaint_handler'])
            @if (auth()->user()->unreadNotifications->count() !== 0)
                <div class="row justify-content-center mt-3 text-center mr-5">
                    <div class="col-md-5">
                        <div class="dropdown custom-dropdown">
                            <a href="#" data-toggle="dropdown" class="dropdown-link" aria-haspopup="true"
                                aria-expanded="false">
                                <span class="wrap-icon icon-notifications"></span>
                                <span class="btn__badge pulse-button bg-danger">
                                    {{ auth()->user()->unreadNotifications->count() }}
                                </span>

                            </a>
                            <div class="dropdown-menu dropdown-menu-right" style="width: 330px; font-family: Vazir"
                                aria-labelledby="dropdownMenuButton">
                                <div class="title-wrap d-flex align-items-center">
                                    <h3 class="title font-bold fo mb-0">
                                        <strong>شکایت های ثبت شده</strong>
                                    </h3>
                                    <a href="" id="all" class="small ml-auto">خواندن همه</a>
                                </div>

                                <ul class="custom-notifications">
                                    @foreach (auth()->user()->unreadNotifications as $notification)
                                        <li class="unread">
                                            <a href="#" class="d-flex">
                                                <div class="text">
                                                    <strong>
                                                        {{ $notification['data']['message'] }}
                                                    </strong>
                                                </div>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                                <p class="text-center m-0 p-0 mt-2"><a href="{{ route('admin.complaints.index') }}"
                                        class="small">نمایش همه</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endcanany


        @can('complaint_handler')
            <li class="nav-item d-flex align-items-center mr-4">
                <a href="{{ route('admin.my-complaints.index') }}" class="btn btn-light border align-items-center">
                    <span>شکایات </span>
                    <span class="badge badge-pill bg-danger text-white">{{ $myComplaintsCount }}</span>
                </a>
            </li>
        @endcan
        @can('manage_communication')
            <li class="nav-item nav-notif">
                <a class="nav-link text-muted my-2 mx-3" href="./#" data-toggle="modal" data-target=".modal-notif">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        class="bi bi-envelope-paper" viewBox="0 0 16 16">
                        <path
                            d="M4 0a2 2 0 0 0-2 2v1.133l-.941.502A2 2 0 0 0 0 5.4V14a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V5.4a2 2 0 0 0-1.059-1.765L14 3.133V2a2 2 0 0 0-2-2H4Zm10 4.267.47.25A1 1 0 0 1 15 5.4v.817l-1 .6v-2.55Zm-1 3.15-3.75 2.25L8 8.917l-1.25.75L3 7.417V2a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v5.417Zm-11-.6-1-.6V5.4a1 1 0 0 1 .53-.882L2 4.267v2.55Zm13 .566v5.734l-4.778-2.867L15 7.383Zm-.035 6.88A1 1 0 0 1 14 15H2a1 1 0 0 1-.965-.738L8 10.083l6.965 4.18ZM1 13.116V7.383l4.778 2.867L1 13.117Z" />
                    </svg>
                    @if ($communications->isNotEmpty())
                        <span class="dot dot-md bg-danger"></span>
                    @endif
                </a>
            </li>
        @endcan
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-muted pr-0 mx-2" href="#" id="navbarDropdownMenuLink"
                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="avatar avatar-sm mt-2">
                    <img src="{{ asset(auth()->user()->profile_image) }}" alt="{{ auth()->user()->full_name }}"
                        class="profile_image">
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
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z" />
                            <path fill-rule="evenodd"
                                d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                        </svg>
                        خروج
                    </button>
                </form>
            </div>
        </li>
    </ul>


</nav>

<script>
    $(document).ready(function() {
        $(".notification-drop .item").on('click', function() {
            $(this).find('ul').toggle();
        });
    });
</script>

<script>
    let notificationDropdown2 = document.getElementById('all');
    notificationDropdown2.addEventListener('click', function() {
        $.ajax({
            type: "POST",
            url: '/admin/notification/read-all',
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function() {
                console.log('yes');
            }
        })
    });
</script>
