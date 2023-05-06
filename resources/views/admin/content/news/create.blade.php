@extends('admin.layouts.app', ['title' => 'نوشتن خبری جدید'])

@section('head-tag')
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/tagify/tagify.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/jalalidatepicker/persian-datepicker.min.css') }}">

    <!-- tinymce -->
    <script src="{{ asset('assets/admin/plugins/tinymce/js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
@endsection

@section('content')
    <div class="row d-flex justify-content-between">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h3 mb-0 section-heading">افزودن خبر جدید</h2>
        </div>
        <div class="col-auto mb-3">
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
        {{-- gallery modal --}}
        <!-- Modal -->
        <div class="modal fade" id="galleryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-images" viewBox="0 0 16 16">
                                <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" />
                                <path
                                    d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2zM14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1zM2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1h-10z" />
                            </svg>
                            گالری تصاویر
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group" style="direction:ltr !important">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupFileAddon01">آپلود</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" id="galleryUploads" name="galleries[]" accept=".jpg, .jpeg, .png, gif"
                                    multiple class="custom-file-input" id="inputGroupFile01"
                                    aria-describedby="inputGroupFileAddon01">
                                <label class="custom-file-label" for="inputGroupFile01">انتخاب فایل ها</label>
                            </div>
                        </div>
                        <div class="preview-images d-flex row m-4">
                            <div class="p-2 d-block">هنوز تصویری اضافه نشده است</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">تایید</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- end gallery modal --}}
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
                            <div id="upload-container" class="text-center">
                                <button type="button" id="browseFile" class="btn btn-outline-dark w-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                        fill="currentColor" class="bi bi-cloud-upload" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M4.406 1.342A5.53 5.53 0 0 1 8 0c2.69 0 4.923 2 5.166 4.579C14.758 4.804 16 6.137 16 7.773 16 9.569 14.502 11 12.687 11H10a.5.5 0 0 1 0-1h2.688C13.979 10 15 8.988 15 7.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 2.825 10.328 1 8 1a4.53 4.53 0 0 0-2.941 1.1c-.757.652-1.153 1.438-1.153 2.055v.448l-.445.049C2.064 4.805 1 5.952 1 7.318 1 8.785 2.23 10 3.781 10H6a.5.5 0 0 1 0 1H3.781C1.708 11 0 9.366 0 7.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383z" />
                                        <path fill-rule="evenodd"
                                            d="M7.646 4.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V14.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3z" />
                                    </svg>
                                    <span class="ml-2">آپلود ویدئو</span>
                                </button>
                            </div>
                            <div id="upload-container" class="text-center mt-2">
                                <button type="button" id="list-video-btn" class="btn btn-outline-primary w-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-film" viewBox="0 0 16 16">
                                        <path
                                            d="M0 1a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V1zm4 0v6h8V1H4zm8 8H4v6h8V9zM1 1v2h2V1H1zm2 3H1v2h2V4zM1 7v2h2V7H1zm2 3H1v2h2v-2zm-2 3v2h2v-2H1zM15 1h-2v2h2V1zm-2 3v2h2V4h-2zm2 3h-2v2h2V7zm-2 3v2h2v-2h-2zm2 3h-2v2h2v-2z" />
                                    </svg>
                                    <span class="ml-2">ویدئو های موجود</span>
                                </button>
                            </div>
                            <div style="display: none" class="progress mt-3" style="height: 25px">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary "
                                    role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
                                    style="width: 75%; height: 100%">75%</div>
                            </div>
                            <video id="videoPreview" src="{{ old('video') ? URL::to('/') . '/' . old('video') : '' }}"
                                controls class="{{ @old('video') ? 'block' : 'd-none' }} mt-3"
                                style="width: 100%; height: auto"></video>

                            <input type="hidden" name="video" value="{{ old('video') }}">
                        </div>
                        <label for="" class="input-title mt-3">
                            گالری تصاویر
                        </label>
                        <div class="text-center">
                            <button type="button" data-toggle="modal" data-target="#galleryModal"
                                class="btn btn-outline-success w-100">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-images" viewBox="0 0 16 16">
                                    <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" />
                                    <path
                                        d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2zM14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1zM2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1h-10z" />
                                </svg>
                                <span class="ml-2">آپلود تصاویر</span>
                                <span id="image_count">(0)</span>
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
                        <div class="form-group mt-2 custom-control custom-checkbox ">
                            <input type="checkbox" name="is_auction_tender" value="1" @checked(old('is_auction_tender'))
                                class="custom-control-input" id="is_auction_tender">
                            <label class="custom-control-label input-title" for="is_auction_tender">این یک مزایده یا
                                مناقصه است</label>
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
    <script src="{{ asset('assets/admin/plugins/resumable/resumable.min.js') }}"></script>

    <script>
        let browseFile = $('#browseFile');
        let progress = $('.progress');
        let resumable = new Resumable({
            target: '{{ route('admin.content.news.upload-video') }}',
            query: {
                _token: "{{ csrf_token() }}"
            }, // CSRF token
            fileType: ['mp4'],
            // default is 1*1024*1024, this should be less than your maximum limit in php.ini
            chunkSize: 10 * 1024 * 1024,
            headers: {
                'Accept': 'application/json'
            },
            testChunks: true,
            throttleProgressCallbacks: 1,
            maxFileSize: "{{ Config::get('chunk-upload.max_upload_file_size') }}",
            fileTypeErrorCallback: function(file, errorCount) {
                errorToast('نوع فایل نا معتبر است.');
            },
            maxFileSizeErrorCallback: function(file, errorCount) {
                errorToast("اندازه فایل نباید بزرگتر از 100 مگابایت باشد.");
            }

        });

        resumable.assignBrowse(browseFile[0]);

        resumable.on('fileAdded', function(file) {
            showProgress();
            resumable.upload();
            $("#browseFile").remove();
        });

        resumable.on('fileProgress', function(file) {
            updateProgress(Math.floor(file.progress() * 100));
        });

        resumable.on('fileSuccess', function(file, response) {
            response = JSON.parse(response)
            $('#videoPreview').removeClass('d-none');
            $('#videoPreview').attr('src', response.path);
            url = response.path.replace(location.origin, '', response.path).substring(1);
            $('input[name=video]').attr('value', url);
            progress.find('.progress-bar').removeClass('bg-primary');
            progress.find('.progress-bar').addClass('bg-success');
            progress.find('.progress-bar').removeClass('progress-bar-animated');
            successToast('آپلود ویدئو کامل شد')
            successToast('به لیست ویدئو ها اضافه شد')
        });

        resumable.on('fileError', function(file, response) {
            progress.find('.progress-bar').removeClass('bg-primary');
            progress.find('.progress-bar').addClass('bg-danger');
            errorToast('آپلود با خطا مواجه شد')
        });


        function showProgress() {
            progress.find('.progress-bar').css('width', '0%');
            progress.find('.progress-bar').html('0%');
            progress.show();
        }

        function updateProgress(value) {
            progress.find('.progress-bar').css('width', `${value}%`)
            progress.find('.progress-bar').html(`${value}%`)
        }

        function hideProgress() {
            progress.hide();
        }
    </script>

    <script>
        document.getElementById('list-video-btn').addEventListener('click', (event) => {
            event.preventDefault();
            window.open('/file-manager/fm-button/?leftDisk=videos', 'fm', 'width=800,height=400');
        });

        function fmSetLink($url) {
            const validFileType = $url.split('.')[1] === 'mp4';
            if (validFileType) {
                const videoPreview = document.querySelector('#videoPreview');
                videoPreview.classList.remove('d-none');
                videoPreview.setAttribute('src', $url);
                videoPreview.value = $url;
                $url = $url.replace(location.host, '', $url).substring(1);
                document.querySelector('input[name=video]').value = $url;
                successToast('ویدئو اضافه شد.')
            } else
                errorToast('فایل انتخابی باید یک ویدئو باشد.')
        }
    </script>

    <script>
        var imageInput = document.querySelector('#galleryUploads');
        var preview = document.querySelector('.preview-images');

        imageInput.style.opacity = 0;
        imageInput.addEventListener('change', updateImageDisplay);

        function updateImageDisplay() {
            while (preview.firstChild) {
                preview.removeChild(preview.firstChild);
            }

            var curFiles = imageInput.files;
            if (curFiles.length === 0) {
                var para = document.createElement('p');
                para.classList.add('text-wrap');
                para.textContent = 'هیچ تصویری برای آپلود انتخاب نشده است.';
                preview.appendChild(para);
            } else if (curFiles.length > 20) {
                errorToast('تعداد تصاویر نباید بیشتر از 20 باشد');
            }
            else {
                var list = document.createElement('ol');
                preview.appendChild(list);
                for (var i = 0; i < curFiles.length; i++) {
                    var listItem = document.createElement('li');
                    listItem.classList.add('row')
                    var para = document.createElement('p');
                    if (validFileType(curFiles[i])) {
                        successToast("فایل " + curFiles[i].name + " اضافه شد.");
                        para.textContent = 'اندازه فایل ' + returnFileSize(curFiles[i]
                            .size);
                        var image = document.createElement('img');
                        image.classList.add('col-md-4')
                        image.src = window.URL.createObjectURL(curFiles[i]);
                        image.style.height = "8rem";
                        image.style.objectFit = 'cover';
                        image.classList.add('mb-3')

                        var imageInfoContent = document.createElement('div');


                        var altInput = document.createElement('input');
                        altInput.id = `alt-${i}`;
                        altInput.name = `alts[]`;
                        altInput.placeholder = "توضیح تصویر";
                        altInput.classList.add('form-control');
                        altInput.style.width = "12rem";

                        imageInfoContent.appendChild(para);
                        imageInfoContent.appendChild(altInput)

                        listItem.appendChild(image);
                        listItem.appendChild(imageInfoContent);

                    } else {
                        para.textContent = 'اسم فایل : ' + curFiles[i].name +
                            ': فایل نامعتبر است لطفا دوباره انتخاب نمایید';
                        listItem.appendChild(para);
                    }

                    list.appendChild(listItem);

                    imageCountTag = document.querySelector('#image_count');
                    imageCountTag.innerHTML = `(${curFiles.length})`
                }
            }
        }
        var fileTypes = [
            'image/jpeg',
            'image/pjpeg',
            'image/png',
            'image/webp',
            'image/gif'
        ]

        function validFileType(file) {
            for (var i = 0; i < fileTypes.length; i++) {
                if (file.type === fileTypes[i]) {
                    return true;
                }
            }

            return false;
        }

        function returnFileSize(number) {
            if (number < 1024) {
                return number + 'bytes';
            } else if (number > 1024 && number < 1048576) {
                return (number / 1024).toFixed(1) + 'KB';
            } else if (number > 1048576) {
                return (number / 1048576).toFixed(1) + 'MB';
            }
        }
    </script>
@endsection
