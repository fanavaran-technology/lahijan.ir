@extends('admin.layouts.app' , ['title' => 'نوشتن خبری جدید'])

@section('head-tag')
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/tagify/tagify.css')}}">
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/jalalidatepicker/persian-datepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/css/custom.css') }}">

<!-- tinymce -->
<script src="{{ asset('assets/admin/plugins/tinymce/js/tinymce/tinymce.min.js') }}"  referrerpolicy="origin"></script>

@endsection

@section('content')
<div class="d-flex justify-content-between">
    <h2 class="h3 mb-0 section-heading">افزودن خبر جدید</h2>
  </div>
  <form>
    <div class="row">
      <div class="col-12 col-md-9">
        <div class="row">
          <!-- news content -->
          <div class="col-md-12">
            <div class="form-row">
              <div class="form-group col-md-12 my-2">
                <input type="text" onkeyup="copyToSlug(this)" placeholder="عنوان را اینجا وارد کنید"
                  class="form-control custom-input-size custom-focus" id="title">
              </div>
              <div class="col-12 slug d-flex">
                <span>https://lahijan.ir/news/</span>
                <span class="slug-box"></span>
                <input type="hidden" name="slug" value="">
              </div>
              <div class="form-group col-md-12 my-2">
                <textarea id="editor"></textarea>
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
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down" viewBox="0 0 16 16">
                  <path d="M3.204 5h9.592L8 10.481 3.204 5zm-.753.659 4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659z"/>
                </svg>
              </span>
            </div>
          </div>
          <div class="card-body">
            <label for="" class="input-title">
              آپلود تصویر شاخص
            </label>
            <div class="form-group inputDnD">
              <input type="file" class="form-control-file" id="inputFile" onchange="readUrl(this)"
                data-title="کلیک کنید یا تصویر را بکشید">
            </div>
          </div>
        </div>
        <div class="card mt-2">
          <div class="card-header" onclick="openCard(this)">
            <div class="row d-flex justify-content-between px-2">
              <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                  class="bi bi-tags" viewBox="0 0 16 16">
                  <path
                    d="M3 2v4.586l7 7L14.586 9l-7-7H3zM2 2a1 1 0 0 1 1-1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 2 6.586V2z" />
                  <path
                    d="M5.5 5a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm0 1a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zM1 7.086a1 1 0 0 0 .293.707L8.75 15.25l-.043.043a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 0 7.586V3a1 1 0 0 1 1-1v5.086z" />
                </svg>
                <span class="ml-1">تگ ها</span>
              </div>
              <span class="card-dropdown-button" onclick="openCard(this)">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down" viewBox="0 0 16 16">
                  <path d="M3.204 5h9.592L8 10.481 3.204 5zm-.753.659 4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659z"/>
                </svg>
              </span>
            </div>
          </div>
          <div class="card-body d-none">
            <label for="" class="input-title">
              تگ ها را با enter جدا کنید
            </label>
            <input name='tags' class='tagify--outside' placeholder='تگ را وارد کنید'>
          </div>
        </div>
        <div class="card mt-2">
          <div class="card-header" onclick="openCard(this)">
            <div class="row d-flex justify-content-between px-2">
              <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                  class="bi bi-images" viewBox="0 0 16 16">
                  <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" />
                  <path
                    d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2zM14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1zM2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1h-10z" />
                </svg>
                <span class="ml-1">گالری تصاویر</span>
              </div>
              <span class="card-dropdown-button" onclick="openCard(this)">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down" viewBox="0 0 16 16">
                  <path d="M3.204 5h9.592L8 10.481 3.204 5zm-.753.659 4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659z"/>
                </svg>
              </span>
            </div>
          </div>
          <div class="card-body d-none">
            <label for="tags" class="input-title">
              تگ ها را با enter جدا کنید
            </label>
            <input name='tags' class='tagify--outside' placeholder='تگ را وارد کنید'>
          </div>
        </div>
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
                  <path d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V4z" />
                </svg>
                <span class="ml-1">تنظیم و انتشار</span>
              </div>
              <span class="card-dropdown-button">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down" viewBox="0 0 16 16">
                  <path d="M3.204 5h9.592L8 10.481 3.204 5zm-.753.659 4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659z"/>
                </svg>
              </span>
            </div>
          </div>
          <div class="card-body d-none">
            <div class="form-group custom-control custom-checkbox ">
              <input type="checkbox" class="custom-control-input  " id="10">
              <label class="custom-control-label input-title" for="10">این خبر فوری است</label>
            </div>
            <div class="form-group mt-2 custom-control custom-checkbox ">
              <input type="checkbox" class="custom-control-input" id="12">
              <label class="custom-control-label input-title" for="12">این خبر سنجاق شود</label>
            </div>
            <div class="form-group mt-2 custom-control custom-checkbox ">
              <input type="checkbox" class="custom-control-input" id="13">
              <label class="custom-control-label input-title" for="13">این خبر مربوط به آتش نشانی است</label>
            </div>
            <label for="" class="input-title">
              تعیین زمان انتشار
            </label>
            <input class="published_at_view form-control" />
            <input type="hidden" name="published_at" id="published_at">
          </div>
          <div class="card-footer d-flex justify-content-between px-2">
            <button type="submit" class="btn btn-outline-secondary btn-sm">ذخیره پیش نویس</button>
            <button type="submit" class="btn btn-primary ml-2">انتشار</button>
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


let input = document.querySelector('input[name=tags]')
// init Tagify script on the above inputs
new Tagify(input, {
  dropdown: {
    position: "input",
    enabled: 0 // always opens dropdown when input gets focus
  }
})

$('.published_at_view').persianDatepicker({
  format: 'YYYY/MM/DD ساعت H:m:s' ,
  alt : "#published_at",
  timePicker: {
    enabled: true,
    meridiem: {
      enabled: true
    }
  }
});
</script>
@endsection