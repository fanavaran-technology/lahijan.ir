@extends('admin.layouts.app', ['title' => 'ویرایش دسته بندی '])

@section('content')
    <div class="row d-flex justify-content-between">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h3 mb-0 section-heading">ویرایش دسته بندی </h2>
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
    <form action="{{ route('admin.clarification.categories.update', $category->id) }}" method="post" enctype="multipart/form-data" id="form">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-12 col-md-9 position-sticky">
                <div class="row">
                    <!-- places content -->
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-12 my-2">
                                <input type="text" name="title" value="{{ old('title', $category->title) }}" onkeyup="copyToSlug(this)"
                                    placeholder="عنوان را اینجا وارد کنید"
                                    class="form-control custom-input-size custom-focus"
                                    @error('title') autofocus="autofocus" @enderror id="title">
                            </div>
                        </div>
                    </div> <!-- /. col -->
                    <!-- end places content -->
                </div> <!-- /. end-section -->
            </div>
            <div>
                <button type="submit" id="save-btn" class="btn btn-lg btn-primary mt-2">ویرایش</button>
            </div>
        </div> <!-- .row -->
    </form>
@endsection
