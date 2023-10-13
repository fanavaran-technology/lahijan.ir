@extends('admin.layouts.app', ['title' => $complaint->subject])

@section('head-tag')
    <script src="{{ asset('assets/admin/plugins/cookup/cookup.js') }}" referrerpolicy="origin"></script>
    <script src="{{ asset('assets/admin/plugins/tinymce/js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endsection

@section('content')
    <div class="row d-flex justify-content-between mb-3">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h3 mb-0 section-heading">
                {{ $complaint->subject }} &nbsp;
                {!! $complaint->status_label !!}
            </h2>
        </div>
        <div class="col-auto mb-3">
            <a href="#reply-section" onclick="window.scrollToView('')" type="button" class="btn btn-primary px-4">ثبت پاسخ</a>
            <a href="{{ route('admin.my-complaints.index') }}" type="button" class="btn btn-success px-4">بازگشت</a>
        </div>
    </div>

    <div class="row mt-4">

        <div class="col-12 position-sticky">
            <div class="row mt-2">
                <!-- news content -->
                <div class="col-md-4">
                    <div class="form-row">
                        <label for="inputFile" class="input-title">
                            نام و نام خانوادگی
                        </label>
                        <div class="form-group col-md-12">
                            <input type="text" value="{{ $complaint->fullName }}" disabled
                                class="form-control custom-input-size custom-focus" id="title">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-row">
                        <label for="inputFile" class="input-title">
                            کد ملی
                        </label>
                        <div class="form-group col-md-12">
                            <input type="text" value="{{ $complaint->national_code }}" disabled
                                class="form-control custom-input-size custom-focus" id="title">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-row">
                        <label for="inputFile" class="input-title">
                            شماره تلفن
                        </label>
                        <div class="form-group col-md-12">
                            <input type="text" value="{{ $complaint->phone_number }}" disabled
                                class="form-control custom-input-size custom-focus" id="title">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-row">
                        <label for="inputFile" class="input-title">
                            خیابان اصلی
                        </label>
                        <div class="form-group col-md-12">
                            <input type="text" value="{{ $complaint->main_st }}" disabled
                                class="form-control custom-input-size custom-focus" id="title">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-row">
                        <label for="inputFile" class="input-title">
                            خیابان فرعی
                        </label>
                        <div class="form-group col-md-12">
                            <input type="text" value="{{ $complaint->auxiliary_st }}" disabled
                                class="form-control custom-input-size custom-focus" id="title">
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-row">
                        <label for="inputFile" class="input-title">
                            کوچه
                        </label>
                        <div class="form-group col-md-12">
                            <input type="text" value="{{ $complaint->alley }}" disabled
                                class="form-control custom-input-size custom-focus" id="title">
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-row">
                        <label for="inputFile" class="input-title">
                            بن بست
                        </label>
                        <div class="form-group col-md-12">
                            <input type="text" value="{{ $complaint->deadend }}" disabled
                                class="form-control custom-input-size custom-focus" id="title">
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-row">
                        <label for="inputFile" class="input-title">
                            نام مجتمع
                        </label>
                        <div class="form-group col-md-12">
                            <input type="text" value="{{ $complaint->builing_name }}" disabled
                                class="form-control custom-input-size custom-focus" id="title">
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-row">
                        <label for="inputFile" class="input-title">
                            کد پستی
                        </label>
                        <div class="form-group col-md-12">
                            <input type="text" value="{{ $complaint->postal_code }}" disabled
                                class="form-control custom-input-size custom-focus" id="title">
                        </div>
                    </div>
                </div>


                <div class="col-12 mt-2">
                    <div class="form-row d-flex flex-column">
                        <label for="inputFile" class="input-title">
                            محتوای پیام
                        </label>
                        <div class="mt-3">
                            {{ $complaint->description }}
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-4">
                    <div class="form-row d-flex flex-column">
                        <label for="inputFile" class="input-title">
                            فایل های ضمیمه شده
                        </label>
                        <div class="row col-12">
                            @forelse ($complaint->files->whereNull('user_id') as $complaintFiles)
                                @foreach ($complaintFiles->files as $complaintFile)
                                    @if (isImageFile($complaintFile))
                                        <a href="{{ asset($complaintFile) }}" target="_blank"><img
                                                src="{{ asset($complaintFile) }}"
                                                style="width: 7rem; height: 7rem; margin: .5rem 1rem; object-fit:cover"
                                                alt=""></a>
                                    @else
                                        <a href="{{ asset($complaintFile) }}" target="_blank"
                                            style="width: 7rem; height: 7rem; margin: .5rem 1rem; background: #ddd"
                                            alt="">
                                            <div class="w-100 h-100 d-flex align-items-center justify-content-center">

                                                <h3>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60"
                                                        fill="currentColor"
                                                        class="bi bi-{{ File::extension($complaintFile) }}"
                                                        viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd"
                                                            d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z" />
                                                    </svg>
                                                </h3>
                                            </div>
                                        </a>
                                    @endif
                                @endforeach
                                @empty
                                <p>هیچ فایلی ضمیمه نشده</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                @if ($complaint->answer)
                    <div class="col-12 mt-2">
                        <div class="form-row d-flex flex-column">
                            <label for="inputFile" class="input-title">
                                پاسخ شما
                            </label>
                            <div class="mt-3">
                                {!! $complaint->answer !!}
                            </div>
                        </div>
                    </div>
                    <label for="inputFile" class="input-title">
                        فایل های آپلود شده ی شما:
                    </label>
                    <div class="row col-12">
                        @foreach ($complaint->files->whereNotNull('user_id') as $complaintFiles)
                            @foreach ($complaintFiles->files as $complaintFile)
                                @if (isImageFile($complaintFile))
                                    <a href="{{ asset($complaintFile) }}" target="_blank"><img
                                            src="{{ asset($complaintFile) }}"
                                            style="width: 7rem; height: 7rem; margin: .5rem 1rem; object-fit:cover"
                                            alt=""></a>
                                @else
                                    <a href="{{ asset($complaintFile) }}" target="_blank"
                                        style="width: 7rem; height: 7rem; margin: .5rem 1rem; background: #ddd"
                                        alt="">
                                        <div class="w-100 h-100 d-flex align-items-center justify-content-center">

                                            <h3>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="60"
                                                    height="60" fill="currentColor"
                                                    class="bi bi-{{ File::extension($complaintFile) }}"
                                                    viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd"
                                                        d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z" />
                                                </svg>
                                            </h3>
                                        </div>
                                    </a>
                                @endif
                            @endforeach
                        @endforeach
                    </div>
                @else
                @if (!$complaint->is_invalid)
                    <div class="col-12" style="margin-top: 3rem">
                        <form action="{{ route('admin.my-complaints.anwser', $complaint->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <label for="inputFile" id="reply-section" class="input-title">
                                پاسخ
                            </label>
                            <textarea name="answer" id="reply" cols="30" rows="10">{{ old('answer', $complaint->answer) }}</textarea>
                            @error('answer')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror


                            {{-- file upload --}}
                            <section class="col-12">
                                <section>
                                    <label for="inputFile" class="input-title mt-2">
                                        ضممیه کردن فایل (در صورت لزوم)
                                    </label>
                                    <div class="d-flex flex-wrap justify-content-between my-2">
                                        <div class="dz-accepted-files">
                                            پسوند های مجاز :
                                        </div>
                                        <div class="dz-max-files">
                                            حداکثر تعداد فایل ها:
                                        </div>
                                        <div class="dz-max-file-size">
                                            حداکثر حجم فایل :
                                        </div>
                                    </div>
                                    <input type="hidden" id="files" name="files">
                                    <div id="my-dropzone" class="dropzone">

                                    </div>
                                    <div class="text-red-500 mt-2 text-center font-bold text-xs er-files">
                                    </div>
                                    <button type="button" id="upload-button" class="btn btn-success my-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                                        </svg>
                                        <span>آپلود</span>
                                    </button>
                                </section>
                            </section>

                            <div class="card-footer d-flex justify-content-between px-2">
                                <button type="submit" id="save-btn" class="btn btn-lg btn-info">ثبت پاسخ</button>
                            </div>

                        </form>
                    </div>
                    @else 
                        <p class="text-danger">امکان ثبت پاسخ وجود ندارد</p>
                    @endif
                @endif
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

    {{-- dropzone --}}

    <script>
        var acceptedFiles = "{{ complaintConfig('allowed-extensions') }}";
        var maxFilesize = "{{ complaintConfig('max-file-size') }}";
        var maxFiles = "{{ complaintConfig('max-files') }}";
        document.querySelector('.dz-accepted-files').textContent += acceptedFiles;
        document.querySelector('.dz-max-file-size').textContent += maxFilesize + " مگابایت";
        document.querySelector('.dz-max-files').textContent += maxFiles;
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        var myDropzone = new Dropzone("#my-dropzone", {
            url: "{{ route('complaints.upload') }}",
            paramName: "file",
            maxFilesize: maxFilesize,
            acceptedFiles: acceptedFiles,
            maxFiles: maxFiles,
            autoProcessQueue: false,
            addRemoveLinks: true,
            dictDefaultMessage: "فایل‌های خود را اینجا رها کنید یا کلیک کنید تا بارگذاری شوند",
            dictFallbackMessage: "مرورگر شما از آپلود فایل‌ها با کشیدن و رها کردن پشتیبانی نمی‌کند.",
            dictFallbackText: "لطفاً از فرم زیر برای آپلود فایل‌هایتان استفاده کنید.",
            dictFileTooBig: `فایل بسیار بزرگ است . حداکثر اندازه مجاز: 1 مگابایت.`,
            dictInvalidFileType: "نوع فایل انتخابی مجاز نیست.",
            dictResponseError: "سرور با خطا پاسخ داد.",
            dictCancelUpload: "لغو آپلود",
            dictCancelUploadConfirmation: "آیا مطمئن هستید که می‌خواهید این آپلود را لغو کنید؟",
            dictRemoveFile: "حذف فایل",
            dictRemoveFileConfirmation: null,
            dictMaxFilesExceeded: "شما نمی‌توانید فایل‌های بیشتری را آپلود کنید.",
            headers: {
                "X-CSRF-TOKEN": csrfToken
            },
        });

        document.getElementById("upload-button").addEventListener("click", function() {
            myDropzone.processQueue();
        });

        let items = [];

        myDropzone.on("success", function(file, response) {
            const path = response.path;

            const files = document.getElementById('files');

            items.push(path);

            files.value = items;
        });
    </script>

    {{-- end dropzone --}}


    <script>
        function renderEditor(key) {
            let editor_config = {
                selector: key,
                relative_urls: false,
                plugins: 'directionality table fullscreen',
                language: 'fa',
                toolbar: [{
                        name: 'styles',
                        items: ['styleselect']
                    },
                    {
                        name: 'formatting',
                        items: ['bold', 'italic', 'underline']
                    },
                    {
                        name: 'alignment',
                        items: ['alignright', 'aligncenter', 'alignleft', 'alignjustify', "format"]
                    },
                    {
                        name: 'indentation',
                        items: ['outdent', 'indent']
                    },
                    {
                        name: 'table',
                        items: ['table']
                    },
                    {
                        name: 'direction',
                        items: ['rtl', 'ltr']
                    },
                    {
                        name: 'history',
                        items: ['undo', 'redo']
                    },
                    {
                        name: 'fullscreen',
                        items: ["fullscreen"]
                    },
                ],
            };

            tinymce.init(editor_config);
        }
    </script>
    <script>
        renderEditor('#reply')
    </script>
@endsection
