@extends('admin.layouts.app', ['title' => 'ویرایش پروژه'])

@section('head-tag')
    <!-- datepicker -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/jalalidatepicker/persian-datepicker.min.css') }}">
    <!-- tinymce -->
    <script src="{{ asset('assets/admin/plugins/tinymce/js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
@endsection

@section('content')
    <div class="row d-flex justify-content-between">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h3 mb-0 section-heading">ویرایش پروژه</h2>
        </div>
        <div class="col-auto mb-3">
            <a href="{{ route('admin.clarification.investments.index') }}" type="button"
                class="btn btn-success px-4">بازگشت</a>
        </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger d-flex flex-column" role="alert">
            @foreach ($errors->all() as $error)
                <div class="mt-2">{{ $error }}</div>
            @endforeach
        </div>
    @endif
    <form action="{{ route('admin.clarification.investments.update', $investment->id) }}" method="post"
        enctype="multipart/form-data" id="form">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-12 col-md-9 position-sticky">
                <div class="row">
                    <!-- content -->
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-12 my-2">
                                <input type="text" name="title" value="{{ old('title', $investment->title) }}"
                                    onkeyup="copyToSlug(this)" placeholder="عنوان را اینجا وارد کنید"
                                    class="form-control custom-input-size custom-focus" id="title">
                            </div>
                            <div class="col-12 slug d-flex">
                                <span>https://lahijan.ir/shafaf/investments/</span>
                                <span class="slug-box"></span>
                            </div>
                            <div class="form-group col-md-12 my-2">
                                <select name="category_id" class="form-control custom-input-size custom-focus"
                                    id="category_id">
                                    <option>یک دسته بندی انتخاب کنید</option>
                                    @foreach ($categories as $categoryItem)
                                        <option value="{{ $categoryItem->id }}" @selected(old('category_id', $investment->category_id) == $categoryItem->id)>
                                            {{ $categoryItem->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-12 my-2">
                                <textarea name="description" id="editor">{{ old('description', $investment->description) }}</textarea>
                            </div>
                            <div class="form-group col-md-4 my-2">
                                <label for="position" class="input-title">
                                    موقعیت
                                </label>
                                <input type="text" name="position" value="{{ old('position', $investment->position) }}"
                                    placeholder="موقعیت"
                                    class="form-control custom-focus @error('position') is-invalid @enderror"
                                    id="position">
                            </div>
                            <div class="form-group col-md-4 my-2">
                                <label for="investor_task" class="input-title">
                                    آورده سرمایه گذار
                                </label>
                                <input type="text" name="investor_task"
                                    value="{{ old('investor_task', $investment->investor_task) }}"
                                    placeholder="آورده سرمایه گذار"
                                    class="form-control custom-focus @error('investor_task') is-invalid @enderror"
                                    id="investor_task">
                            </div>
                            <div class="form-group col-md-4 my-2">
                                <label for="" class="input-title">
                                    آورده شهرداری
                                </label>
                                <input type="text" name="municipality_task"
                                    value="{{ old('municipality_task', $investment->municipality_task) }}"
                                    placeholder="آورده شهرداری"
                                    class="form-control custom-focus @error('municipality_task') is-invalid @enderror"
                                    id="municipality_task">
                            </div>
                        </div>
                    </div> <!-- /. col -->
                    <!-- end places content -->
                </div> <!-- /. end-section -->
            </div>
            <div class="col-12 col-md-3 my-2 px-0">
                <div class="card">
                    <div class="card-header" onclick="openCard(this)">
                        <div class="row d-flex justify-content-between px-2">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-collection-play" viewBox="0 0 16 16">
                                    <path
                                        d="M2 3a.5.5 0 0 0 .5.5h11a.5.5 0 0 0 0-1h-11A.5.5 0 0 0 2 3zm2-2a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7A.5.5 0 0 0 4 1zm2.765 5.576A.5.5 0 0 0 6 7v5a.5.5 0 0 0 .765.424l4-2.5a.5.5 0 0 0 0-.848l-4-2.5z" />
                                    <path
                                        d="M1.5 14.5A1.5 1.5 0 0 1 0 13V6a1.5 1.5 0 0 1 1.5-1.5h13A1.5 1.5 0 0 1 16 6v7a1.5 1.5 0 0 1-1.5 1.5h-13zm13-1a.5.5 0 0 0 .5-.5V6a.5.5 0 0 0-.5-.5h-13A.5.5 0 0 0 1 6v7a.5.5 0 0 0 .5.5h13z" />
                                </svg>
                                <span class="ml-1">چند رسانه ای</span>
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
                        <label for="" class="input-title">
                            آپلود تصویر شاخص
                        </label>
                        <div class="form-group inputDnD">
                            <input type="file" class="form-control-file" name="image" id="inputFile"
                                onchange="readUrl(this)" data-title="کلیک کنید یا تصویر را بکشید">
                        </div>
                        <label for="" class="input-title d-block">
                            تصویر فعلی
                        </label>
                        <img style="width:7rem" src="{{ asset($investment->image) }}" alt="">
                    </div>
                </div>
                <div class="card mt-2">
                    <div class="card-header" onclick="openCard(this)">
                        <div class="row d-flex justify-content-between px-2">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-calendar2-check" viewBox="0 0 16 16">
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
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-caret-down" viewBox="0 0 16 16">
                                    <path
                                        d="M3.204 5h9.592L8 10.481 3.204 5zm-.753.659 4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659z" />
                                </svg>
                            </span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-9">
                                <label for="start_date_view" class="input-title">
                                    فایل آگهی (PDF)
                                </label>
                                <input type="file" name="file">
                            </div>
                            <a href="{{ asset($investment->file) }}" target="_blank" class="col-md-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    fill="currentColor" class="bi bi-filetype-pdf text-danger" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z" />
                                </svg>
                            </a>
                        </div>

                        <div class="mt-2">
                            <label for="start_date_view" class="input-title">
                                تاریخ شروع
                            </label>
                            <input type="hidden" name="start_date" id="start_date"
                                value="{{ $investment->start_date }}">
                            <input id="start_date_view" value="{{ $investment->start_date }}"
                                class="form-control custom-focus">
                        </div>

                        <div class="mt-2">
                            <label for="end_date_view" class="input-title">
                                تاریخ پایان
                            </label>
                            <input type="hidden" name="end_date" id="end_date" value="{{ $investment->end_date }}">
                            <input id="end_date_view" value="{{ $investment->end_date }}"
                                class="form-control custom-focus">
                        </div>
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
        renderEditor('#editor')

        copyToSlug(document.querySelector('input[name=title]'))
    </script>

    <script>
        $(document).ready(function() {
            $('#start_date_view').persianDatepicker({
                altField: '#start_date',
                format: 'YYYY/MM/DD',
                minDate: "today",
            })
        });

        $(document).ready(function() {
            $('#end_date_view').persianDatepicker({
                altField: '#end_date',
                format: 'YYYY/MM/DD',
                minDate: "today",
            })
        });
    </script>
@endsection
