@extends('admin.layouts.app', ['title' => 'ویرایش کاربر'])

@section('content')
    <div class="row d-flex justify-content-between">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h3 mb-0 section-heading">ویرایش کاربر</h2>
        </div>
        <div class="col-auto mb-3">
            <a href="{{ route('admin.user.users.index') }}" type="button" class="btn btn-success px-4">بازگشت</a>
        </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger d-flex flex-column" role="alert">
            @foreach ($errors->all() as $error)
                <div class="mt-2">{{ $error }}</div>
            @endforeach
        </div>
    @endif
    <form action="{{ route('admin.user.users.update' , $user->id) }}" method="post" enctype="multipart/form-data" id="form">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-12 col-md-9 pr-2">
                <div class="card">
                    <div class="card-header" onclick="openCard(this)">
                        <div class="row d-flex justify-content-between px-2">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                    class="bi bi-person-vcard" viewBox="0 0 16 16">
                                    <path
                                        d="M5 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm4-2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5ZM9 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4A.5.5 0 0 1 9 8Zm1 2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5Z" />
                                    <path
                                        d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2ZM1 4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H8.96c.026-.163.04-.33.04-.5C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1.006 1.006 0 0 1 1 12V4Z" />
                                </svg>
                                <span class="ml-1">اطلاعات حساب کاربری</span>
                            </div>
                            <span class="card-dropdown-button caret-up">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-caret-down" viewBox="0 0 16 16">
                                    <path
                                        d="M3.204 5h9.592L8 10.481 3.204 5zm-.753.659 4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659z" />
                                </svg>
                            </span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- places content -->
                            <div class="col-md-12">
                                <div class="form-row">
                                    <div class="form-group col-lg-6 my-2">
                                        <label for="full_name" class="input-title mr-3">نام کامل :</label>
                                        <input type="text" name="full_name"
                                            value="{{ old('full_name', $user->full_name) }}" placeholder="نام کاربر"
                                            class="form-control custom-focus" id="full_name">
                                    </div>
                                    <div class="form-group col-lg-6 my-2">
                                        <label for="" class="input-title mr-3">شناسه کاربری :</label>
                                        <input type="text" name="username" value="{{ old('username', $user->username) }}"
                                            placeholder="شناسه کاربر" class="form-control url custom-focus" id="username">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-lg-6 my-2">
                                        <label for="email" class="input-title mr-3"> ایمیل (اختیاری) :</label>
                                        <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                            placeholder="ایمیل" class="form-control url custom-focus" id="email">
                                    </div>
                                    <div class="form-group col-lg-6 my-2">
                                        <label for="" class="input-title mr-3">شماره تلفن :</label>
                                        <input type="text" name="mobile" value="{{ old('mobile', $user->mobile) }}"
                                            placeholder="شماره تلفن" class="form-control url custom-focus" id="mobile">
                                    </div>
                                </div>
                            </div> <!-- /. col -->
                        </div>
                    </div>
                    <!-- end places content -->
                </div>
                <div class="card mt-2 permissions-area d-none">
                    <div class="card-header" onclick="openCard(this)">
                        <div class="row d-flex justify-content-between px-2">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                    class="bi bi-shield-fill-check" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M8 0c-.69 0-1.843.265-2.928.56-1.11.3-2.229.655-2.887.87a1.54 1.54 0 0 0-1.044 1.262c-.596 4.477.787 7.795 2.465 9.99a11.777 11.777 0 0 0 2.517 2.453c.386.273.744.482 1.048.625.28.132.581.24.829.24s.548-.108.829-.24a7.159 7.159 0 0 0 1.048-.625 11.775 11.775 0 0 0 2.517-2.453c1.678-2.195 3.061-5.513 2.465-9.99a1.541 1.541 0 0 0-1.044-1.263 62.467 62.467 0 0 0-2.887-.87C9.843.266 8.69 0 8 0zm2.146 5.146a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793l2.646-2.647z" />
                                </svg>
                                <span class="ml-1">مدیریت مجوز ها</span>
                            </div>
                            <span class="card-dropdown-button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-caret-down" viewBox="0 0 16 16">
                                    <path
                                        d="M3.204 5h9.592L8 10.481 3.204 5zm-.753.659 4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659z" />
                                </svg>
                            </span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mr-3 font-weight-bold text-muted">انتخاب نقش</div>
                        <div class="d-flex flex-wrap mt-2">
                            <div class="form-group mt-2 custom-control custom-checkbox mr-4">
                                <input type="checkbox" value="1" class="custom-control-input">
                                <label class="custom-control-label input-title"> مدیر</label>
                            </div>
                            <div class="form-group mt-2 custom-control custom-checkbox mr-4">
                                <input type="checkbox" value="1" class="custom-control-input">
                                <label class="custom-control-label input-title">مدیریت محتوا</label>
                            </div>
                            <div class="form-group mt-2 custom-control custom-checkbox mr-4">
                                <input type="checkbox" value="1" class="custom-control-input">
                                <label class="custom-control-label input-title">شفاف سازی</label>
                            </div>
                            <div class="form-group mt-2 custom-control custom-checkbox mr-4">
                                <input type="checkbox" value="1" class="custom-control-input">
                                <label class="custom-control-label input-title">مدیریت کاربران</label>
                            </div>
                        </div>
                    </div>
                    <!-- end places content -->
                </div>
            </div>
            <div class="col-12 col-md-3 px-0">
                <div class="card">
                    <div class="card-header" onclick="openCard(this)">
                        <div class="row d-flex justify-content-between px-2">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
                                    <path
                                        d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                                    <path fill-rule="evenodd"
                                        d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
                                </svg>
                                <span class="ml-1">تنظیم و ایجاد کاربر</span>
                            </div>
                            <span class="card-dropdown-button caret-up">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-caret-down" viewBox="0 0 16 16">
                                    <path
                                        d="M3.204 5h9.592L8 10.481 3.204 5zm-.753.659 4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659z" />
                                </svg>
                            </span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group mt-2 custom-control custom-checkbox ">
                            <input type="checkbox" name="is_staff" value="1" @checked(old('is_staff' , $user->is_staff))
                                class="custom-control-input" id="is_staff">
                            <label class="custom-control-label input-title" for="is_staff">به این کاربر مجوز داده
                                شود</label>
                        </div>
                        <div class="form-group mt-2 custom-control custom-checkbox ">
                            <input type="checkbox" name="email_verified_at" @if($user->email_verified_at) disabled @endif value="1" @checked(old('email_verified_at' , $user->email_verified_at ?? false))
                                class="custom-control-input" id="email_verified_at">
                            <label class="custom-control-label input-title" for="email_verified_at"> ایمیل تایید
                                شود</label>
                        </div>
                        <div class="form-group mt-2 custom-control custom-checkbox ">
                            <input type="checkbox" name="mobile_verified_at" @if($user->mobile_verified_at) disabled @endif value="1" @checked(old('mobile_verified_at' , $user->mobile_verified_at ?? false))
                                class="custom-control-input" id="mobile_verified_at">
                            <label class="custom-control-label input-title" for="mobile_verified_at"> شماره تلفن تایید
                                شود</label>
                        </div>
                        <div class="form-group mt-2 custom-control custom-checkbox ">
                            <input type="checkbox" name="is_block" value="1" @checked(old('is_block' , $user->is_block))
                                class="custom-control-input" id="is_block">
                            <label class="custom-control-label input-title" for="is_block"> کاربر مسدود باشد</label>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between px-2">
                        <button type="submit" id="save-btn" class="btn btn-primary ml-2">ویرایش</button>
                    </div>
                </div>
            </div>
        </div> <!-- .row -->
    </form>
    <div class="row">
        <div class="col-9"></div>
        <div class="card mt-2 col-md-3">
            <div class="card-header" onclick="openCard(this)">
                <div class="row d-flex justify-content-between px-2">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="bi bi-key" viewBox="0 0 16 16">
                            <path
                                d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8zm4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5z" />
                            <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                        </svg>
                        <span class="ml-1">تغییر کلمه عبور</span>
                    </div>
                    <span class="card-dropdown-button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-caret-down" viewBox="0 0 16 16">
                            <path
                                d="M3.204 5h9.592L8 10.481 3.204 5zm-.753.659 4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659z" />
                        </svg>
                    </span>
                </div>
            </div>
            <div class="card-body d-none">
                <form action="{{ route('admin.user.change-password' , $user->id) }}" method="post">
                    @csrf
                    <div class="form-row">
                        <div class="form-group">
                            <label for="password" class="input-title mr-3"> کلمه عبور :</label>
                            <input type="password" name="password" placeholder="کلمه عبور"
                                class="form-control url custom-focus" id="password">
                        </div>
                        <div class="form-group">
                            <label for="" class="input-title mr-3">تکرار کلمه عبور :</label>
                            <input type="password" name="password_confirmation" placeholder="تکرار کلمه عبور "
                                class="form-control url custom-focus" id="password_confirmation">
                        </div>
                        <button type="submit" id="save-btn" class="btn btn-sm btn-dark ml-2">تغییر کلمه
                            عبور</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/admin/js/custom.js') }}"></script>

    <script>
        const staffCheckbox = document.querySelector('#is_staff');

        staffCheckbox.addEventListener('change', () => {
            const permissionBox = document.querySelector('.permissions-area');

            if (staffCheckbox.checked)
                permissionBox.classList.remove('d-none');
            else
                permissionBox.classList.add('d-none');
        });
    </script>
@endsection
