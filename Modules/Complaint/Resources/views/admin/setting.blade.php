@extends('admin.layouts.app', ['title' => 'تنظیمات سامانه ثبت شکایات'])

@section('head-tag')
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/tagify/tagify.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/jalalidatepicker/persian-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="d-flex justify-content-between">
        <div class="col mb-2">
            <h2 class="h3 mb-0 page-title">تنظیمات</h2>
        </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger d-flex flex-column" role="alert">
            @foreach ($errors->all() as $error)
                <div class="mt-2">{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form action="{{ route('admin.settings.store') }}" method="post" enctype="multipart/form-data" id="form">
        @csrf
        <div class="row">
            <div class="col-12 col-md-12 pt-2 pr-2">
                <div class="card">
                    <div class="card-header" onclick="openCard(this)">
                        <div class="row d-flex justify-content-between px-2">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" width="24" height="24" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0M3.124 7.5A8.969 8.969 0 015.292 3m13.416 0a8.969 8.969 0 012.168 4.5" />
                                </svg>

                                <span class="ml-1">اطلاع رسانی ها</span>
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
                                <div class="form-check form-check-inline col-md-6 mx-0 my-3">
                                    <input id="send_sms_operator" name="send_sms_operator" value="1" data-width="100" data-off="غیرفعال" data-on="فعال" data-onstyle="success" data-offstyle="danger" class="form-check-input" type="checkbox"
                                        data-toggle="toggle" data-style="mr-1" @checked($config['send_sms_operator'])>
                                    <label for="send_sms_operator" class="form-check-label pr-2 pl-0">ارسال sms برای اطلاع
                                        رسانی پاسخ دهنده شکایت</label>
                                </div>

                                <div class="form-check form-check-inline col-md-5 mx-0 my-3">
                                    <input id="send_sms_plaintiff"  name="send_sms_plaintiff" value="1" data-width="100" data-off=" غیرفعال" data-on="فعال" data-onstyle="success" data-offstyle="danger" class="form-check-input" type="checkbox"
                                        data-toggle="toggle" data-style="mr-1" @checked($config['send_sms_plaintiff'])>
                                    <label for="send_sms_plaintiff" class="form-check-label pr-2 pl-0">ارسال sms برای اطلاع
                                        رسانی شاکی شکایت</label>
                                </div>

                                <div class="form-check form-check-inline col-md-6 mx-0 my-3">
                                    <input id="confirm_referrer" name="confirm_referrer" value="1" data-width="100" data-off="غیرفعال" data-on="فعال" data-onstyle="success" data-offstyle="danger" class="form-check-input" type="checkbox"
                                        data-toggle="toggle" data-style="mr-1" @checked($config['confirm_referrer'])>
                                    <label for="confirm_referrer" class="form-check-label pr-2 pl-0">شکایت بعد از تایید
                                        کارشناس توسط شاکی قابل مشاهده باشد.</label>
                                </div>

                                <div class="mt-3">
                                    <button type="submit" id="save-btn" class="btn btn-primary ml-2">ذخیره</button>
                                </div>
                            </div> <!-- /. col -->
                        </div>
                    </div>
                    <!-- end places content -->
                </div>
            </div>
        </div> <!-- .row -->
    </form>
@endsection

@section('script')
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

    <script>
        var select_users = $('#select_users');
        select_users.select2({
            placeholder: 'لطفا کاربران مورد نظر را وارد نمایید',
            multiple: true,
            tags: true,
            dir: 'rtl'
        })
    </script>
    @include('admin.alerts.confirm')
@endsection
