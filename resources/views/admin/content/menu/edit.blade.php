@extends('admin.layouts.app', ['title' => 'ویرایش منو'])

@section('content')
    <div class="row d-flex justify-content-between">
      <div class="d-flex justify-content-between align-items-center">
          <h2 class="h3 mb-0 section-heading">افزودن منوی جدید</h2>
      </div>
      <div class="col-auto mb-3">
        <a href="{{ route('admin.content.menus.index') }}" type="button" class="btn btn-success px-4">بازگشت</a>
      </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger d-flex flex-column" role="alert">
            @foreach ($errors->all() as $error)
                <div class="mt-2">{{ $error }}</div>
            @endforeach
        </div>
    @endif
    <form action="{{ route('admin.content.menus.update' , $menu->id) }}" method="post" enctype="multipart/form-data" id="form">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-12 col-md-9 position-sticky">
                <div class="row">
                    <!-- places content -->
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-12 my-2">
                                <input type="text" name="title" value="{{ old('title' , $menu->title) }}" onkeyup="copyToSlug(this)"
                                    placeholder="عنوان را اینجا وارد کنید"
                                    class="form-control custom-input-size custom-focus" @error('title') autofocus="autofocus" @enderror id="title">
                            </div>
                            <div class="form-group col-md-12 my-2">
                                <label for="" class="input-title mr-3">تعیین آدرس  : </label>
                                <input type="text" name="url" value="{{ old('url' , filter_var($menu->url, FILTER_VALIDATE_URL) ? $menu->url : URL::to('/') . $menu->url) }}" @error('url') autofocus="autofocus" @enderror
                                    placeholder="آدرس اینترنتی را وارد نمایید"
                                    class="form-control custom-input-size url custom-focus" id="url">
                            </div>
                            <div class="form-group col-md-12 my-2">
                                <label for="" class="input-title mr-3">تعیین زیر منو : </label>
                                <select name="parent_id" class="form-control custom-input-size custom-focus" id="" @error('parent_id') autofocus="autofocus" @enderror>
                                    <option value="">منوی اصلی</option>
                                    @foreach($parentMenus as $parentMenu)
                                    <option value="{{ $parentMenu->id }}" @selected(old('parent_id' , $menu->parent_id) == $parentMenu->id)>{{ $parentMenu->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div> <!-- /. col -->
                    <!-- end places content -->
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
                        <div class="form-group custom-control custom-checkbox ">
                            <input type="checkbox" name="status" value="1" @checked(old('status' , $menu->status))
                                class="custom-control-input" id="status">
                            <label class="custom-control-label input-title" for="status">این منو فعال باشد</label>
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

