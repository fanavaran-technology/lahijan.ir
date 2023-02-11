@extends('admin.layouts.app', ['title' => 'پروفایل کاربری'])

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger d-flex flex-column row" role="alert">
            @foreach ($errors->all() as $error)
                <div class="mt-2">{{ $error }}</div>
            @endforeach
        </div>
    @endif
    <div class="row">
        <div class="col-12 col-md-7 pr-2">
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
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.user.profile.update') }}" method="post" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-row d-flex justify-content-center">
                                    <div class="profile-pic">
                                        <label class="-label d-flex flex-column justify-content-center align-items-center" for="file">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-camera-fill" viewBox="0 0 16 16">
                                                <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                                <path d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0z"/>
                                            </svg>
                                        </label>
                                        <input id="file" name="profile_photo" type="file" onchange="loadFile(event)" />
                                        <img src="{{ asset(auth()->user()->profile_image) }}"
                                            id="output">
                                    </div>
                                </div>
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
                                <div class="form-row">
                                    <button type="submit" id="save-btn" class="btn btn-primary mt-3">ویرایش</button>
                                </div>
                            </div>
                            <!-- /. col -->
                        </div>
                    </form>
                </div>
                <!-- end places content -->
            </div>
        </div>
        <div class="col-12 col-md-5 px-0">
            <div class="card">
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
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.user.change-password' , auth()->user()->id) }}" method="post">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label for="old_password" class="input-title mr-3"> کلمه عبور فعلی :</label>
                                <input type="password" name="old_password" placeholder="کلمه عبور فعلی"
                                    class="form-control url custom-focus" id="old_password">
                            </div>
                            <div class="form-group col-12">
                                <label for="password" class="input-title mr-3">کلمه عبور جدید :</label>
                                <input type="password" name="password" placeholder="کلمه عبور"
                                    class="form-control url custom-focus" id="password">
                            </div>
                            <div class="form-group col-12">
                                <label for="" class="input-title mr-3">تکرار کلمه عبور :</label>
                                <input type="password" name="password_confirmation" placeholder="تکرار کلمه عبور "
                                    class="form-control url custom-focus" id="password_confirmation">
                            </div>
                            <button type="submit" id="save-btn" class="btn btn-dark">تغییر کلمه
                                عبور</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> <!-- .row -->
@endsection

@section('script')
    <script src="{{ asset('assets/admin/js/custom.js') }}"></script>
@endsection