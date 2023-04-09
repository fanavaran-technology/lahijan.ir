@extends('admin.layouts.app', ['title' => $communication->subject])

@section('head-tag')
    <script src="{{ asset('assets/admin/plugins/tinymce/js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
@endsection

@section('content')
    <div class="row d-flex justify-content-between mb-3">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h3 mb-0 section-heading">جزئیات پیام</h2>
        </div>
        <div class="col-auto mb-3">
            <a href="{{ route('admin.communications.index') }}" type="button" class="btn btn-success px-4">بازگشت</a>
        </div>
    </div>
    <div class="row">
        <div class="col-12 position-sticky">
            <div class="row">
                <!-- news content -->
                <div class="col-md-6">
                    <div class="form-row">
                        <label for="inputFile" class="input-title">
                            موضوع
                        </label>
                        <div class="form-group col-md-12 my-2">
                            <input type="text" value="{{ $communication->subject }}" disabled
                                class="form-control custom-input-size custom-focus" id="title">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-row">
                        <label for="inputFile" class="input-title">
                            نوع درخواست
                        </label>
                        <div class="form-group col-md-12 my-2">
                            <input type="text" value="{{ $communication->getType() }}" placeholder="" disabled
                                class="form-control custom-input-size custom-focus" id="title">
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-3">
                    <div class="form-row">
                        <label for="inputFile" class="input-title">
                            نام فرستنده
                        </label>
                        <div class="form-group col-md-12 ">
                            <input type="text" value="{{ $communication->full_name }}" placeholder="" disabled
                                class="form-control custom-input-size custom-focus" id="title">
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-3">
                    <div class="form-row">
                        <label for="inputFile" class="input-title">
                            شماره تلفن
                        </label>
                        <div class="form-group col-md-12 ">
                            <input type="text" value="{{ $communication->phone }}" placeholder=""
                                class="form-control custom-input-size custom-focus" disabled id="title">
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-2">
                    <div class="form-row">
                        <label for="inputFile" class="input-title">
                            آدرس
                        </label>
                        <div class="form-group col-md-12 ">
                            <textarea cols="30" disabled class="form-control custom-input-size custom-focus" rows="2">{{ $communication->address }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-2">
                    <div class="form-row d-flex flex-column">
                        <label for="inputFile" class="input-title">
                            محتوای پیام
                        </label>
                        <div class="mt-3">
                            {!! $communication->description !!}
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-2">
                    <form action="{{ route('admin.communications.update', $communication->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <label for="inputFile" class="input-title">
                            متن پاسخ یا پیگیری
                        </label>
                        <textarea name="response" id="reply" cols="30" rows="10">{{ old('response' , $communication->response) }}</textarea>
                        @error('response')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <div class="card-footer d-flex justify-content-between px-2">
                            <button type="submit" id="save-btn" class="btn btn-lg btn-info">ثبت پاسخ</button>
                        </div>
                    </form>
                </div>
                <!-- /. col -->
                <!-- end news content -->
            </div>

        </div>
    </div>
@endsection

@section('script')
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
