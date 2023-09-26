@extends('admin.layouts.app', ['title' => $complaint->subject])

@section('head-tag')
    <script src="{{ asset('assets/admin/plugins/tinymce/js/tinymce/tinymce.min.js') }}"
            referrerpolicy="origin"></script>
@endsection

@section('content')
    <div class="row d-flex justify-content-between mb-3">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h3 mb-0 section-heading">جزئیات پیام</h2>
        </div>
        <div class="col-auto mb-3">
            <a href="{{ route('complaints.index') }}" type="button" class="btn btn-success px-4">بازگشت</a>
        </div>
    </div>
    <div class="row">
        <div class="col-12 position-sticky">
            <div class="row">
                <!-- news content -->
                <div class="col-md-4">
                    <div class="form-row">
                        <label for="inputFile" class="input-title">
                            نام و نام خانوادگی
                        </label>
                        <div class="form-group col-md-12 my-2">
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
                        <div class="form-group col-md-12 my-2">
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
                        <div class="form-group col-md-12 my-2">
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
                        <div class="form-group col-md-12 my-2">
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
                        <div class="form-group col-md-12 my-2">
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
                        <div class="form-group col-md-12 my-2">
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
                        <div class="form-group col-md-12 my-2">
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
                        <div class="form-group col-md-12 my-2">
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
                        <div class="form-group col-md-12 my-2">
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
                            {!! $complaint->description !!}
                        </div>
                    </div>
                </div>
                {{--                <div class="col-12 mt-2">--}}
                {{--                    <form action="{{ route('admin.communications.update', $communication->id) }}" method="post">--}}
                {{--                        @csrf--}}
                {{--                        @method('PUT')--}}
                {{--                        <label for="inputFile" class="input-title">--}}
                {{--                            متن پاسخ یا پیگیری--}}
                {{--                        </label>--}}
                {{--                        <textarea name="response" id="reply" cols="30" rows="10">{{ old('response' , $communication->response) }}</textarea>--}}
                {{--                        @error('response')--}}
                {{--                        <small class="text-danger">{{ $message }}</small>--}}
                {{--                        @enderror--}}
                {{--                        <div class="card-footer d-flex justify-content-between px-2">--}}
                {{--                            <button type="submit" id="save-btn" class="btn btn-lg btn-info">ثبت پاسخ</button>--}}
                {{--                        </div>--}}
                {{--                    </form>--}}
                {{--                </div>--}}
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
