@extends('admin.layouts.app', ['title' => 'ویرایش صفحه جدید'])

@section('head-tag')
    <!-- tinymce -->
    <script src="{{ asset('assets/admin/plugins/tinymce/js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
@endsection

@section('content')
    <div class="row d-flex justify-content-between">
      <div class="d-flex justify-content-between align-items-center">
          <h2 class="h3 mb-0 section-heading">ویرایش صفحه جدید</h2>
      </div>
      <div class="col-auto mb-3">
        <a href="{{ route('admin.content.pages.index') }}" type="button" class="btn btn-success px-4">بازگشت</a>
      </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger d-flex flex-column" role="alert">
            @foreach ($errors->all() as $error)
                <div class="mt-2">{{ $error }}</div>
            @endforeach
        </div>
    @endif
    <form action="{{ route('admin.content.pages.update' , $page->id) }}" method="post" enctype="multipart/form-data" id="form">
        @csrf
    {{ method_field('put') }}
        <div class="row">
            <div class="col-12 col-md-9 position-sticky">
                <div class="row">
                    <!-- pages content -->
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-12 my-2">
                                <input type="text" name="title" value="{{ old('title' , $page->title) }}" onkeyup="copyToSlug(this)"
                                    placeholder="عنوان را اینجا وارد کنید"
                                    class="form-control custom-input-size custom-focus" id="title">
                            </div>                 
                            <div class="form-group col-md-12 my-2">
                                <textarea name="body" id="editor">{{ old('body' , $page->body) }}</textarea>
                            </div>
                        </div>
                    </div> <!-- /. col -->
                    <!-- end pages content -->
                </div> <!-- /. end-section -->
            </div>
            <div class="col-12 col-md-3 my-2 px-0">
            
                <div class="card mt-2">
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
                            <input type="checkbox" name="is_draft" value="1" @checked(old('is_draft' , $page->is_draft))
                                class="custom-control-input" id="is_draft">
                            <label class="custom-control-label input-title" for="is_draft">این صفحه فعال باشد</label>
                        </div>

                       

                        <div class="form-group mt-2 custom-control custom-checkbox ">
                            <input type="checkbox" name="is_quick_access" value="1" @checked(old('is_quick_access' , $page->is_quick_access))
                                class="custom-control-input" id="is_quick_access">
                            <label class="custom-control-label input-title" for="is_quick_access">افزدون دسترسی سریع</label>
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

    <script>
        renderEditor('#editor')

        copyToSlug(document.querySelector('input[name=title]'))
    </script>

@endsection
