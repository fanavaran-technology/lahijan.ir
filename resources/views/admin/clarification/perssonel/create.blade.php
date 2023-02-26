@extends('admin.layouts.app', ['title' => 'ایجاد کارمند جدید'])

@section('head-tag')
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/jalalidatepicker/persian-datepicker.min.css') }}">
@endsection

@section('content')
    <div class="row d-flex justify-content-between">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h3 mb-0 section-heading">ایجاد کارمند جدید </h2>
        </div>
        <div class="col-auto mb-3">
            <a href="{{ route('admin.clarification.perssonels.index') }}" type="button" class="btn btn-success px-4">بازگشت</a>
        </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger d-flex flex-column" role="alert">
            @foreach ($errors->all() as $error)
                <div class="mt-2">{{ $error }}</div>
            @endforeach
        </div>
    @endif
    <form action="{{ route('admin.clarification.perssonels.store') }}" method="post" enctype="multipart/form-data" id="form">
        @csrf
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
                                <span class="ml-1">ثبت اطلاعات کارمند</span>
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
                                        <label for="first_name" class="input-title mr-3">نام :</label>
                                        <input type="text" name="first_name" value="{{ old('first_name') }}"
                                            placeholder="نام" class="form-control custom-focus" id="first_name">
                                    </div>
                                    <div class="form-group col-lg-6 my-2">
                                        <label for="last_name" class="input-title mr-3">نام خانوادگی :</label>
                                        <input type="text" name="last_name" value="{{ old('last_name') }}"
                                            placeholder="نام خانوادگی" class="form-control custom-focus" id="last_name">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-lg-6 my-2">
                                        <label for="birth_date" class="input-title mr-3"> تاریخ تولد :</label>
                                        <input type="hidden" name="birth_date" id="birth_date"
                                            value="{{ old('birth_date') }}">
                                        <input id="birth_date_view" value="{{ old('birth_date') }}" class="form-control custom-focus"
                                            placeholder="تاریخ تولد">
                                    </div>
                                    <div class="form-group col-lg-6 my-2">
                                        <label for="employeement_date" class="input-title mr-3">تاریخ استخدام :</label>
                                        <input type="hidden" name="employeement_date" id="employeement_date"
                                            value="{{ old('employeement_date') }}">
                                        <input id="employeement_date_view" value="{{ old('employeement_date') }}" class="form-control custom-focus"
                                            placeholder="تاریخ استخدام">
                                    </div>
                                </div>
                            </div> <!-- /. col -->
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
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                    class="bi bi-person-plus" viewBox="0 0 16 16">
                                    <path
                                        d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                                    <path fill-rule="evenodd"
                                        d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
                                </svg>
                                <span class="ml-1">تنظیم و ایجاد</span>
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
                        <div class="form-group custom-control custom-checkbox ">
                            <input type="checkbox" name="is_disable" value="1" @checked(old('is_disable'))
                                class="custom-control-input" id="is_disable">
                            <label class="custom-control-label input-title" for="is_disable"> کارمند غبرفعال باشد</label>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between px-2">
                        <button type="submit" id="save-btn" class="btn btn-primary ml-2">ایجاد</button>
                    </div>
                </div>
            </div>
        </div> <!-- .row -->
    </form>
@endsection

@section('script')
    <script src="{{ asset('assets/admin/js/custom.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/jalalidatepicker/persian-date.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/jalalidatepicker/persian-datepicker.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#employeement_date_view').persianDatepicker({
                altField: '#employeement_date',
                format: 'YYYY/MM/DD',
            })
        });
        $(document).ready(function() {
            $('#birth_date_view').persianDatepicker({
                altField: '#birth_date',
                format: 'YYYY/MM/DD',
            })
        });
    </script>
@endsection
