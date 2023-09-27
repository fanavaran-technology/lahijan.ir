@extends('admin.layouts.app', ['title' => ' ویرایش دپارتمان جدید'])

@section('head-tag')
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/tagify/tagify.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/jalalidatepicker/persian-datepicker.min.css') }}">
@endsection

@section('content')
    <div class="d-flex justify-content-between">
        <div class="col mb-2">
            <h2 class="h3 mb-0 page-title">ویرایش دپارتمان</h2>
        </div>

        <div class="col-auto mb-3">
            <a href="{{ route('admin.departements.index') }}" type="button" class="btn btn-success px-4">بازگشت</a>
        </div>

    </div>
    @if ($errors->any())
        <div class="alert alert-danger d-flex flex-column" role="alert">
            @foreach ($errors->all() as $error)
                <div class="mt-2">{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form action="{{ route('admin.departements.update' , $departement->id) }}" method="post" enctype="multipart/form-data" id="form">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-12 col-md-12 pt-2 pr-2">
                <div class="card">
                    <div class="card-header" onclick="openCard(this)">
                        <div class="row d-flex justify-content-between px-2">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                     class="bi bi-person-vcard" viewBox="0 0 16 16">
                                    <path
                                        d="M5 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm4-2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5ZM9 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4A.5.5 0 0 1 9 8Zm1 2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5Z" />
                                    <path
                                        d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2ZM1 4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H8.96c.026-.163.04-.33.04-.5C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1.006 1.006 0 0 1 1 12V4Z" />
                                </svg>
                                <span class="ml-1">ویرایش اطلاعات دپارتمان</span>
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
                        <div class="row">
                            <!-- places content -->
                            <div class="col-md-12">
                                <div class="form-row">
                                    <div class="form-group col-lg-6 my-2">
                                        <label for="full_name" class="input-title mr-3">عنوان :</label>
                                        <input type="text" name="title" value="{{ old('title' , $departement->title) }}"
                                               placeholder=" عنوان را وارد کنید" class="form-control custom-focus" id="title">
                                    </div>
                                    <div class="form-group col-lg-6 my-2">
                                        <label for="place_birth" class="input-title mr-3">توضیحات :</label>
                                        <input type="text" name="description" value="{{ old('description' , $departement->description) }}"
                                               placeholder="توضیحات" class="form-control custom-focus" id="description">
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <button type="submit" id="save-btn" class="btn btn-primary ml-2">ذخیره</button>
                                </div>
                            </div> <!-- /. col -->
                        </div>
                    </div>
                    <!-- end places content -->
                </div>
            </div>
        </div> <!-- .row -->
    </form>
@endsection

