@extends('admin.layouts.app', ['title' => 'همه خبر ها'])

@section('head-tag')
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/tagify/tagify.css') }}">
@endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger d-flex flex-column" role="alert">
            @foreach ($errors->all() as $error)
                <div class="mt-2">{{ $error }}</div>
            @endforeach
        </div>
    @endif
    <form action="{{ route('admin.settings.store') }}" method="post" id="form" enctype="multipart/form-data">
        @csrf
        <div class="row justify-content-center">
            <div class="col">
                <h2 class="h3 mb-0 page-title">تنظیمات</h2>
            </div>
        </div>
        <div class="card overflow-hidden mt-4">
            <div class="row no-gutters row-bordered row-border-light">
                <div class="col-md-3 pt-0">
                    <div class="list-group list-group-flush account-settings-links pl-0">
                        <a class="list-group-item list-group-item-action active" data-toggle="list"
                            href="#account-general">تنظیمات
                            عمومی</a>
                        <a class="list-group-item list-group-item-action" data-toggle="list"
                            href="#account-change-password">اطلاعات تماس</a>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="account-general">
                            <div class="card-body media align-items-center">
                                <div class="media-body ml-4">
                                    <div class="profile-pic">
                                        <label class="-label d-flex flex-column justify-content-center align-items-center"
                                            for="file">
                                            تغییر لوگو
                                        </label>
                                        <input id="file" name="settings[logo]" type="file" onchange="loadFile(event)" />
                                        <img src="{{ asset(Setting::getValue('logo')) }}" id="output">
                                    </div>

                                    <div class="text-light text-center small mt-1">پسوند های مجاز JPG, webp , GPEG یا PNG. حداکثر
                                        سایز
                                        آپلود 1 مگابایت</div>
                                </div>
                            </div>
                            <hr class="border-light m-0">

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title" class="input-title">عنوان سایت</label>
                                    <input type="text" value="{{ Setting::getValue('title') }}" id="title" name="settings[title]"
                                        class="form-control custom-focus mb-1">
                                </div>
                                <div class="form-group">
                                    <label for="description" class="input-title">توضیحات</label>
                                    <textarea name="settings[description]" id="description" class="form-control custom-focus">{{ Setting::getValue('description') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label class="input-title" for="keywords">کلمات کلیدی</label>
                                    <input type="text" value="{{ Setting::getValue('keywords') }}" id="keywords"
                                        class="form-control custom-focus mb-1">
                                    <input type="hidden" id="keywords_value" name="settings[keywords]">
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="account-change-password">
                            <div class="card-body pb-2">
                                <h5 class="pb-3 text-secondary">ارتباط با ما</h5>
                                <div class="form-group">
                                    <label class="input-title" for="telephone">شماره تلفن</label>
                                    <input type="text" value="{{ Setting::getValue('telephone') }}" name="settings[telephone]"
                                        class="form-control url custom-focus">
                                </div>

                                <div class="form-group">
                                    <label class="input-title" for="email">ایمیل</label>
                                    <input type="email" name="settings[email]" value="{{ Setting::getValue('email') }}" id="email"
                                        class="form-control url custom-focus">
                                </div>

                                <div class="form-group">
                                    <label class="input-title" for="fax">آدرس فکس</label>
                                    <input type="text" id="fax" name="settings[fax]" value="{{ Setting::getValue('fax') }}" class="form-control custom-focus url">
                                </div>

                                <h5 class="py-3 text-secondary">شبکه های اجتماعی</h5>
                                <div class="form-group">
                                    <label class="input-title" for="instagram">اینستاگرام</label>
                                    <input type="text" id="instagram" name="settings[instagram]" value="{{ Setting::getValue('instagram') }}" class="form-control url custom-focus"
                                        value="">
                                </div>
                                <div class="form-group">
                                    <label class="input-title" for="telegram">تلگرام</label>
                                    <input type="text" id="telegram" name="settings[telegram]" value="{{ Setting::getValue('telegram') }}" class="form-control url custom-focus"
                                        value="">
                                </div>
                                <div class="form-group">
                                    <label class="input-title" for="whatsapp">واتساپ</label>
                                    <input type="text" id="whatsapp" name="settings[whatsapp]" value="{{ Setting::getValue('whatsapp') }}" class="form-control url custom-focus"
                                        value="">
                                </div>
                                <div class="form-group">
                                    <label class="input-title" for="eita">ایتا</label>
                                    <input type="text" id="eita" name="settings[eita]" value="{{ Setting::getValue('eita') }}" class="form-control url custom-focus"
                                        value="">
                                </div>
                                <div class="form-group">
                                    <label class="input-title" name="settings[sorush]" for="sorush">سروش</label>
                                    <input type="text" id="sorush" name="settings[sorush]" value="{{ Setting::getValue('sorush') }}" class="form-control url custom-focus"
                                        value="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-right mt-3">
            <button type="submit" class="btn btn-primary">ذخیره تغییرات</button>
        </div>
    </form>
@endsection

@section('script')
    <script src="{{ asset('assets/admin/plugins/tagify/tagify.min.js') }}"></script>

    <script>
        const input = document.querySelector('#keywords')
        new Tagify(input)


        const newsForm = document.querySelector("#form");

        newsForm.addEventListener('submit', (e) => {
            e.preventDefault();

            tagsvalues = document.getElementsByClassName('tagify__tag');

            tagsList = []
            for (tagEle of tagsvalues)
                tagsList.push(tagEle.title)

            tagInput = document.querySelector('#keywords_value');

            tagInput.value = tagsList.join(',');

            newsForm.submit();
        });
    </script>
@endsection
