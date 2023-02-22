@extends('admin.layouts.app', ['title' => 'نوشتن خبری جدید'])

@section('head-tag')
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/tagify/tagify.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/jalalidatepicker/persian-datepicker.min.css') }}">

    <!-- tinymce -->
    <script src="{{ asset('assets/admin/plugins/tinymce/js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
@endsection

@section('content')
    <div class="modal" id="video-upload-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">آپلود ویدئو</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="video" class="input-title">
                        انتخاب ویدئو
                    </label>
                    <div class="input-group">
                        <input type="text" id="video" class="form-control custom-focus" autocomplete="off" name="image" aria-label="Image"
                            aria-describedby="button-image">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" id="button-image">انتخاب</button>
                        </div>
                    </div>
                    <label for="description" class="input-title mt-2">
                        توضیحات ویدئو
                    </label>
                    <textarea name="video[description]" class="form-control custom-focus" id="description"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">تایید</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row d-flex justify-content-between">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h3 mb-0 section-heading">افزودن خبر جدید</h2>
        </div>
        <div class="col-auto mb-3">
            <a href="{{ route('admin.content.news.index') }}" type="button" class="btn btn-success px-4">بازگشت</a>
        </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger d-flex flex-column" role="alert">
            @foreach ($errors->all() as $error)
                <div class="mt-2">{{ $error }}</div>
            @endforeach
        </div>
    @endif
    <form action="{{ route('admin.content.news.store') }}" method="post" enctype="multipart/form-data" id="form">
        @csrf
        <div class="row">
            <div class="col-12 col-md-9 position-sticky">
                <div class="row">
                    <!-- news content -->
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-12 my-2">
                                <input type="text" name="title" value="{{ old('title') }}" onkeyup="copyToSlug(this)"
                                    placeholder="عنوان را اینجا وارد کنید"
                                    class="form-control custom-input-size custom-focus" id="title">
                            </div>
                            <div class="col-12 slug d-flex">
                                <span>https://lahijan.ir/news/</span>
                                <span class="slug-box"></span>
                            </div>
                            <div class="form-group col-md-12 my-2">
                                <textarea name="body" class="" id="editor">{{ old('body') }}</textarea>
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
                        <label for="inputFile" class="input-title">
                            آپلود تصویر شاخص
                        </label>
                        <div class="form-group inputDnD">
                            <input type="file" class="form-control-file" name="image" id="inputFile"
                                onchange="readUrl(this)" data-title="کلیک کنید یا تصویر را بکشید">
                        </div>
                        <div class="d-flex flex-column">
                            <label for="" class="input-title">
                                آپلود ویدئو
                            </label>
                            <button type="button" class="btn btn-indigo" id="upload-video">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-film" viewBox="0 0 16 16">
                                    <path
                                        d="M0 1a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V1zm4 0v6h8V1H4zm8 8H4v6h8V9zM1 1v2h2V1H1zm2 3H1v2h2V4zM1 7v2h2V7H1zm2 3H1v2h2v-2zm-2 3v2h2v-2H1zM15 1h-2v2h2V1zm-2 3v2h2V4h-2zm2 3h-2v2h2V7zm-2 3v2h2v-2h-2zm2 3h-2v2h2v-2z" />
                                </svg>
                                <span class="ml-2">آپلود ویدئو</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card mt-2">
                    <div class="card-header" onclick="openCard(this)">
                        <div class="row d-flex justify-content-between px-2">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-tags" viewBox="0 0 16 16">
                                    <path
                                        d="M3 2v4.586l7 7L14.586 9l-7-7H3zM2 2a1 1 0 0 1 1-1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 2 6.586V2z" />
                                    <path
                                        d="M5.5 5a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm0 1a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zM1 7.086a1 1 0 0 0 .293.707L8.75 15.25l-.043.043a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 0 7.586V3a1 1 0 0 1 1-1v5.086z" />
                                </svg>
                                <span class="ml-1">تگ ها</span>
                            </div>
                            <span class="card-dropdown-button" onclick="openCard(this)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-caret-down" viewBox="0 0 16 16">
                                    <path
                                        d="M3.204 5h9.592L8 10.481 3.204 5zm-.753.659 4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659z" />
                                </svg>
                            </span>
                        </div>
                    </div>
                    <div class="card-body d-none">
                        <label for="" class="input-title">
                            تگ ها را با enter جدا کنید
                        </label>
                        <input type="hidden" name="tags">
                        <input id="tags_input" value="{{ old('tags') }}" class='tagify--outside'
                            placeholder='تگ را وارد کنید'>
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
                        <div class="form-group mt-2 custom-control custom-checkbox ">
                            <input type="checkbox" name="is_pined" value="1" @checked(old('is_pined'))
                                class="custom-control-input" id="is_pined">
                            <label class="custom-control-label input-title" for="is_pined">این خبر سنجاق شود</label>
                        </div>
                        <div class="form-group mt-2 custom-control custom-checkbox ">
                            <input type="checkbox" name="is_fire_station" value="1" @checked(old('is_fire_station'))
                                class="custom-control-input" id="is_fire_station">
                            <label class="custom-control-label input-title" for="is_fire_station">این خبر مربوط به آتش
                                نشانی است</label>
                        </div>
                        <div class="form-group custom-control custom-checkbox ">
                            <input type="checkbox" name="is_draft" value="1" @checked(old('is_draft'))
                                class="custom-control-input" id="is_draft">
                            <label class="custom-control-label input-title" for="is_draft">این خبر پیش نویس است</label>
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
    <script src="{{ asset('assets/admin/plugins/tagify/tagify.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/jalalidatepicker/persian-date.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/jalalidatepicker/persian-datepicker.min.js') }}"></script>

    <script>
        renderEditor('#editor')

        copyToSlug(document.querySelector('input[name=title]'))

        let input = document.querySelector('#tags_input')
        // init Tagify script on the above inputs
        new Tagify(input, {
            pattern: /^[^\-\s_,$%&\^()\[\]{}!*@+=`/~/'/":;0-9A-Z۰-۹].[^\s_,$%\^()\[\]{}&!*@+=`/~/'/":;0-9A-Z۰-۹]{2,30}$/,
            dropdown: {
                position: "input",
                enabled: 0 // always opens dropdown when input gets focus
            }
        })
    </script>

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

    <script>
        const newsForm = document.querySelector("#form");

        newsForm.addEventListener('submit', (e) => {
            e.preventDefault();

            tagsvalues = document.getElementsByClassName('tagify__tag');

            tagsList = []
            for (tagEle of tagsvalues)
                tagsList.push(tagEle.title)

            tagInput = document.querySelector('input[name=tags]');

            tagInput.value = tagsList.join(',');

            newsForm.submit();
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            document.getElementById('button-image').addEventListener('click', (event) => {
                event.preventDefault();

                window.open('/file-manager/fm-button', 'fm', 'width=1400,height=800');
            });
        });

        // set file link
        function fmSetLink($url) {
            document.getElementById('video').value = $url;
        }
    </script>

    <script>
        $("#upload-video").on('click' , function (e) {
            $('#video-upload-modal').modal('show')
        })
    </script>
@endsection
