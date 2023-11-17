@extends('admin.layouts.app', ['title' => $complaint->subject])

@section('head-tag')
    <script src="{{ asset('assets/admin/plugins/cookup/cookup.js') }}" referrerpolicy="origin"></script>
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
            <a href="{{ route('admin.complaints.index') }}" type="button" class="btn btn-success px-4">بازگشت</a>
        </div>
    </div>
    @if (!$complaint->reference_id || $complaint->is_invalid)
        <div class="card mt-4">
            <div class="card-header">
                <div class="row d-flex justify-content-between px-2">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                            stroke="currentColor" width="20" height="20">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 19.5l-15-15m0 0v11.25m0-11.25h11.25" />
                        </svg>

                        <span class="ml-1">ارجاع شکایت</span>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.complaints.referral', $complaint->id) }}" method="post" class="form-row">
                    <div class="form-group col-md-4">
                        @csrf
                        <select name="departement_id" class="custom-input custom-focus form-control">
                            <option value="">یک دپارتمان را انتخاب کنید</option>
                            @foreach ($departements as $departement)
                                <option value="{{ $departement->id }}">{{ $departement->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="spinner-border text-primary d-none loading" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <div class="form-group col-md-4 d-none">
                        <select name="reference_id" class="custom-input custom-focus form-control">
                            @if (!empty($referenceUser))
                            @endif
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <button type="submit" id="refferal-submit" disabled class="btn btn-primary">ارجاع</button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    @if ($complaint->reference_id)
        <div class="row mt-4">
            <div class="col-lg-12">
                <h4 class="card-title mb-5">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="20" height="20"
                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                    </svg>

                    سوابق پاسخ
                </h4>

                <div class="hori-timeline">
                    <ul class="list-inline events">
                        @if ($complaint->reference_id)
                            <li class="list-inline-item event-list">
                                <div class="px-4">
                                    <img src="{{ asset($complaint->user->profile_image) }}"
                                        class="event-date rounded-circle" style="border: 3px solid dodgerblue;" />
                                    <small>ارجاع داده شد</small>
                                    <h6 class="font-size-16 mt-1">{{ $complaint->user->full_name }}</h6>
                                </div>
                                <span
                                    class="small text-center d-block d-lg-inline">{{ jdate()->forge($complaint->referenced_at)->format('Y/m/d ساعت H:i') }}</span>
                            </li>
                        @endif

                        @foreach ($userFails as $userFail)
                            <li class="list-inline-item event-list">
                                <div class="px-4">
                                    <img src="{{ asset($userFail->user->profile_image) }}" class="event-date rounded-circle"
                                        style="border: 3px solid rgb(179, 23, 23);" />
                                    <small>پاسخی ثبت نشد</small>
                                    <h6 class="font-size-16 mt-1">{{ $userFail->user->full_name }}</h6>
                                </div>
                                <span
                                    class="small text-center d-block d-lg-inline">{{ jdate()->forge($userFail->created_at)->format('Y/m/d ساعت H:i') }}</span>
                            </li>
                        @endforeach

                        @if ($complaint->answer)
                            <li class="list-inline-item event-list">
                                <div class="px-4">
                                    <img src="{{ asset($complaint->user->profile_image) }}"
                                        class="event-date rounded-circle" style="border: 3px solid #2abf3e" />
                                    <small>پاسخ داده شد</small>
                                    <h6 class="font-size-16 mt-1">{{ $complaint->user->full_name }}</h6>
                                </div>
                                <span
                                    class="small text-center d-block d-lg-inline">{{ jdate()->forge($complaint->answered_at)->format('Y/m/d ساعت H:i') }}</span>
                            </li>
                        @endif

                        @if (complaintConfig('confirm_referrer') && $complaint->is_answered)
                            <li class="list-inline-item event-list">
                                <div class="px-4">
                                    <img src="{{ asset($complaint->user->profile_image) }}"
                                        class="event-date rounded-circle"
                                        style="border: 3px solid {{ $complaint->is_confirm ? '#2abf3e' : 'rgb(255, 166, 0)' }}" />
                                    <small>{{ $complaint->is_confirm ? 'پاسخ تایید شد' : 'هنوز تایید نشده' }}</small>
                                    @if ($complaint->is_confirm)
                                        <h6 class="font-size-16">تایید شده</h6>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" class="text-success" width="24" height="24" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    @else
                                        <form action="{{ route('admin.my-complaints.confirm', $complaint->id) }}"
                                            method="post">
                                            @csrf
                                            <button class="btn btn-success btn-sm my-4">تایید پاسخ</button>
                                        </form>
                                    @endif
                                </div>
                            </li>
                        @endif
                    </ul>
                </div>
                <!-- end card -->
            </div>
        </div>
    @endif

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
                    <div class="col-12 mt-4">
                        <div class="form-row d-flex flex-column">
                            <label for="inputFile" class="input-title" id="answer">
                                پاسخی که کاربر {{ $complaint->user->full_name }} ثبت کرد
                            </label>
                            <div class="mt-3">
                                {!! $complaint->answer !!}
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        const departementInput = document.querySelector('select[name=departement_id]');

        departementInput.addEventListener('change', (event) => {
            const departementId = event.currentTarget.value;

            if (departementId) {
                const url = `/admin/departement/${departementId}/fetch-user`;
                fetch(url, {
                    method: "get",
                }).then(response => {
                    return response.json();
                }).then(data => {
                    const referenceInput = document.querySelector('select[name=reference_id]');
                    referenceInput.innerHTML = '';
                    referenceInput.closest('.form-group').classList.remove('d-none');
                    document.querySelector('#refferal-submit').disabled = false;
                    data.forEach(user => {
                        referenceInput.innerHTML +=
                            `<option value="${user.id}">${user.full_name}</option>`
                    });
                });
            }
        })
    </script>
@endsection
