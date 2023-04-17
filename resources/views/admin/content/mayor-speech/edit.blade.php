@extends('admin.layouts.app', ['title' => 'ویرایش سخن شهردار '])


@section('content')
    <div class="d-flex justify-content-between">
        <div class="col mb-2">
            <h2 class="h3 mb-0 page-title">ویرایش شهردار</h2>
        </div>

        <div class="col-auto mb-3">
            <a href="{{ route('admin.content.mayor-speech.index') }}" type="button" class="btn btn-success px-4">بازگشت</a>
        </div>

    </div>
    @if ($errors->any())
        <div class="alert alert-danger d-flex flex-column" role="alert">
            @foreach ($errors->all() as $error)
                <div class="mt-2">{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form action="{{ route('admin.content.mayor-speech.update' , $mayorSpeech->id) }}" method="post" enctype="multipart/form-data" id="form">
        @csrf
        @method('put')

        <div class="row">
            <div class="col-12 col-md-9 pt-2 pr-2">
                <div class="form-group col-md-12 my-2">
                    <input type="text" @error('full_name') autofocus="autofocus" @enderror name="full_name" value="{{ old('full_name' , $mayorSpeech->full_name) }}"
                           placeholder="نام شهردار"
                           class="form-control custom-input-size custom-focus" id="title">
                </div>

                <div class="form-group col-md-12 my-2">
                    <input type="text" @error('description') autofocus="autofocus" @enderror name="description" value="{{ old('description' , $mayorSpeech->description) }}"
                           placeholder="سخن شهردار"
                           class="form-control custom-input-size custom-focus" id="title">
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
                            <input type="checkbox" name="status" value="1" @checked(old('status' , $mayorSpeech->status))
                            class="custom-control-input" id="status">
                            <label class="custom-control-label input-title" for="status">فعال کردن سخن شهردار</label>
                        </div>
                        <label for="inputFile" class="input-title mt-2">
                            تصویر شهردار
                        </label>
                        <div>
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
                            <label for="" class="input-title d-block">
                                تصویر فعلی
                            </label>
                            <img style="width:7rem" src="{{ asset($mayorSpeech->image) }}" alt="">
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
