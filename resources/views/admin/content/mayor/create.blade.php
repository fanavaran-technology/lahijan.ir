@extends('admin.layouts.app', ['title' => ' شهردار جدید'])

@section('head-tag')
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/tagify/tagify.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/jalalidatepicker/persian-datepicker.min.css') }}">

    <!-- tinymce -->
    <script src="{{ asset('assets/admin/plugins/tinymce/js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
@endsection

@section('content')
    <div class="d-flex justify-content-between">
        <div class="col mb-2">
            <h2 class="h3 mb-0 page-title">ایجاد شهردار</h2>
        </div>

        <div class="col-auto mb-3">
            <a href="{{ route('admin.content.mayors.index') }}" type="button" class="btn btn-success px-4">بازگشت</a>
        </div>

    </div>
    @if ($errors->any())
        <div class="alert alert-danger d-flex flex-column" role="alert">
            @foreach ($errors->all() as $error)
                <div class="mt-2">{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form action="{{ route('admin.content.mayors.store') }}" method="post" enctype="multipart/form-data" id="form">
        @csrf
        <div class="row">
            <div class="col-12 col-md-9 pt-2 pr-2">
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
                                <span class="ml-1">ثبت اطلاعات شهردار</span>
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
                                        <label for="full_name" class="input-title mr-3">نام و نام خانوادگی :</label>
                                        <input type="text" name="full_name" value="{{ old('full_name') }}"
                                               placeholder="نام و  نام خانوادگی " class="form-control custom-focus" id="full_name">
                                    </div>
                                    <div class="form-group col-lg-6 my-2">
                                        <label for="place_birth" class="input-title mr-3">محل تولد :</label>
                                        <input type="text" name="place_birth" value="{{ old('place_birth') }}"
                                               placeholder="محل تولد" class="form-control custom-focus" id="place_birth">
                                    </div>
                                    <div class="form-group col-lg-6 my-2">
                                        <label for="place_birth" class="input-title mr-3">مدت مسئولیت :</label>
                                        <input type="text" name="term_responsibility" value="{{ old('term_responsibility') }}"
                                               placeholder="به طور مثال : 5 سال و 6 ماه" class="form-control custom-focus" id="term_responsibility">
                                    </div>

                                </div>

                            </div> <!-- /. col -->
                        </div>
                    </div>
                    <!-- end places content -->
                </div>
            </div>

            <div class="col-12 col-md-3 my-2 px-0">
                <div class="card">
                    <div class="card-header" onclick="openCard(this)">
                        <div class="row d-flex justify-content-between px-2">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-calendar2-check" viewBox="0 0 16 16">
                                    <path
                                        d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                                    <path
                                        d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H2z" />
                                    <path
                                        d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V4z" />
                                </svg>
                                <span class="ml-1">تنظیم و انتشار</span>
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
                            <input type="checkbox" name="status" value="1" @checked(old('status'))
                            class="custom-control-input" id="status">
                            <label class="custom-control-label input-title" for="status">شهردار فعال باشد</label>
                        </div>
                        <label for="inputFile" class="input-title mt-2">
                            تصویر شهردار
                        </label>
                        <div class="profile-pic">
                            <label class="-label d-flex flex-column justify-content-center align-items-center" for="file">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-camera-fill" viewBox="0 0 16 16">
                                    <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"></path>
                                    <path d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0z"></path>
                                </svg>
                            </label>
                            <input id="file" name="image" type="file" onchange="loadFile(event)">
                            <img src="{{ asset('images/avatars/profile.jpg') }}" id="output">
                        </div>

                        <label for="birthdate_view" class="input-title">
                            تاریخ تولد
                        </label>
                        <input type="hidden" name="birthdate" id="birthdate" value="{{ old('birthdate') }}">
                        <input id="birthdate_view" class="form-control custom-focus">

                        <label for="recruitment_view" class="input-title mt-2">
                            تاریخ انتصاب
                        </label>
                        <input type="hidden" name="recruitment" id="recruitment" value="{{ old('recruitment') }}">
                        <input id="recruitment_view" class="form-control custom-focus">

                    </div>
                    <div class="card-footer d-flex justify-content-between px-2">
                        <button type="submit" id="save-btn" class="btn btn-primary ml-2">ذخیره</button>
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
            $('#birthdate_view').persianDatepicker({
                altField: '#birthdate',
                format: 'YYYY/MM/DD',
                timePicker: {
                    meridiem: {
                        enabled: true
                    }
                }
            })
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#recruitment_view').persianDatepicker({
                altField: '#recruitment',
                format: 'YYYY/MM/DD',
                timePicker: {
                    meridiem: {
                        enabled: true
                    }
                }
            })
        });
    </script>

@endsection
