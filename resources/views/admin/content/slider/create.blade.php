@extends('admin.layouts.app', ['title' => ' اسلایدر جدید'])

@section('head-tag')
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/jalalidatepicker/persian-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/custom.css') }}">
@endsection

@section('content')
    <div class="d-flex justify-content-between">
        <div class="col mb-2">
            <h2 class="h3 mb-0 page-title">ایجاد اسلایدر</h2>
        </div>

        <div class="col-auto mb-3">
            <a href="{{ route('admin.content.sliders.index') }}" type="button" class="btn btn-success px-4">بازگشت</a>
        </div>

    </div>
    @if ($errors->any())
        <div class="alert alert-danger d-flex flex-column" role="alert">
            @foreach ($errors->all() as $error)
                <div class="mt-2">{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form action="{{ route('admin.content.sliders.store') }}" method="post" enctype="multipart/form-data" id="form">
        @csrf
        <div class="row">
            <div class="col-12 col-md-9 position-sticky">
                <div class="row">
                    <!-- news content -->
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-12 my-2">
                                <input type="text" @error('alt') autofocus="autofocus" @enderror name="alt" value="{{ old('alt') }}"
                                    placeholder="توضیحی درمورد تصویر بنویسید"
                                    class="form-control custom-input-size custom-focus" id="title">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12 my-2">
                                <input type="text" name="url"
                                    value="{{ old('url', request('url') ?? URL::to('/')) }}"
                                    placeholder="آدرس را وارد نمایید"
                                    class="form-control url custom-input-size custom-focus" id="title">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="slider-pic mt-4 w-100">
                                <label class="-label d-flex flex-column justify-content-center align-items-center" for="file">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-cloud-upload" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M4.406 1.342A5.53 5.53 0 0 1 8 0c2.69 0 4.923 2 5.166 4.579C14.758 4.804 16 6.137 16 7.773 16 9.569 14.502 11 12.687 11H10a.5.5 0 0 1 0-1h2.688C13.979 10 15 8.988 15 7.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 2.825 10.328 1 8 1a4.53 4.53 0 0 0-2.941 1.1c-.757.652-1.153 1.438-1.153 2.055v.448l-.445.049C2.064 4.805 1 5.952 1 7.318 1 8.785 2.23 10 3.781 10H6a.5.5 0 0 1 0 1H3.781C1.708 11 0 9.366 0 7.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383z"/>
                                        <path fill-rule="evenodd" d="M7.646 4.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V14.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3z"/>
                                    </svg>
                                </label>
                                <input id="file" name="image" type="file" onchange="loadFile(event)" />
                                <img src="{{ asset('images/content/news/no-photo.png') }}"
                                    id="output">
                            </div>
                        </div>
                    </div> <!-- /. col -->
                    <!-- end news content -->
                </div> <!-- /. end-section -->
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
                            <label class="custom-control-label input-title" for="status">اسلاید فعال باشد</label>
                        </div>
                        <label for="published_at_view" class="input-title">
                            تعیین زمان انتشار
                        </label>
                        <input type="hidden" name="published_at" id="published_at" value="{{ old('published_at') }}">
                        <input id="published_at_view" class="form-control custom-focus">
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
            $('#published_at_view').persianDatepicker({
                altField: '#published_at',
                format: 'YYYY/MM/DD',
                minDate: "today",
                timePicker: {
                    enabled: true,
                    meridiem: {
                        enabled: true
                    }
                }
            })
        });
    </script>
@endsection
