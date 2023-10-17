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
        <div class="row" style="position: relative">
            <div style="position:fixed;z-index:100;left:2rem; bottom:3rem;">
                <button type="submit" id="save-btn" class="btn btn-primary ml-2">اعمال تغییرات</button>
            </div>
            <div class="col-12 col-md-12 pt-2 pr-2">
                <div class="card">
                    <div class="card-header" onclick="openCard(this)">
                        <div class="row d-flex justify-content-between px-2">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>                                  

                                <span class="ml-1">تنظیمات  عمومی</span>
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
                            <div class="form-group col-lg-4">
                                <label for="full_name" class="input-title mr-3">پسوند های مجاز آپلود</label>
                                <input type="text" name="allowed-extensions" value="{{ $config['allowed-extensions'] }}"
                                       placeholder="نام پسوند را وارد نماییدو با , از هم جدا کنید" dir="ltr" class="form-control custom-focus" id="full_name">
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="full_name" class="input-title">حداکثر حجم فایل (بر اساس مگابایت)</label>
                                <input type="number" name="max-file-size" value="{{ $config['max-file-size'] }}"
                                       placeholder="حداکثر حجم فایل" dir="ltr" class="form-control custom-focus" id="full_name">
                            </div> 
                            <div class="form-group col-lg-2">
                                <label for="full_name" class="input-title">حداکثر تعداد فایل</label>
                                <input type="number" name="max-files" value="{{ $config['max-files'] }}"
                                       placeholder="حداکثر تعداد فایل" dir="ltr" class="form-control custom-focus" id="full_name">
                            </div>  
                            <div class="form-group col-lg-3">
                                <label for="full_name" class="input-title">مهلت پاسخ به شکایات (بر اساس روز)</label>
                                <input type="number" name="deadline-responding" value="{{ $config['deadline-responding'] }}"
                                       placeholder="حداکثر تعداد فایل" dir="ltr" class="form-control custom-focus" id="full_name">
                            </div>  
                        </div> 
                    </div>
                    <!-- end places content -->
                </div>
            </div>
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
                                    <input id="send_sms_operator" name="notifications[send_sms_operator]" value="1" data-width="100" data-off="غیرفعال" data-on="فعال" data-onstyle="success" data-offstyle="danger" class="form-check-input" type="checkbox"
                                        data-toggle="toggle" data-style="mr-1" @checked($config['notifications']['send_sms_operator'])>
                                    <label for="send_sms_operator" class="form-check-label pr-2 pl-0">ارسال sms برای اطلاع
                                        رسانی پاسخ دهنده شکایت</label>
                                </div>

                                <div class="form-check form-check-inline col-md-5 mx-0 my-3">
                                    <input id="send_sms_plaintiff"  name="notifications[send_sms_plaintiff]" value="1" data-width="100" data-off=" غیرفعال" data-on="فعال" data-onstyle="success" data-offstyle="danger" class="form-check-input" type="checkbox"
                                        data-toggle="toggle" data-style="mr-1" @checked($config['notifications']['send_sms_plaintiff'])>
                                    <label for="send_sms_plaintiff" class="form-check-label pr-2 pl-0">ارسال sms برای اطلاع
                                        رسانی شاکی </label>
                                </div>

                                <div class="form-check form-check-inline col-md-6 mx-0 my-3">
                                    <input id="confirm_referrer" name="notifications[confirm_referrer]" value="1" data-width="100" data-off="غیرفعال" data-on="فعال" data-onstyle="success" data-offstyle="danger" class="form-check-input" type="checkbox"
                                        data-toggle="toggle" data-style="mr-1" @checked($config['notifications']['confirm_referrer'])>
                                    <label for="confirm_referrer" class="form-check-label pr-2 pl-0">شکایت بعد از تایید
                                        کارشناس توسط شاکی قابل مشاهده باشد.</label>
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
