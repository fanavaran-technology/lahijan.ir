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
                    @if (!$complaint->is_invalid)
                    <li class="list-inline-item event-list">
                        <div class="px-4">
                            <img src="{{ asset($complaint->user->profile_image) }}" class="event-date rounded-circle" style="border: 3px solid dodgerblue;" />
                            <small>در انتظار پاسخ </small>
                            <h6 class="font-size-16 mt-1">{{ $complaint->user->full_name }}</h6>
                        </div>
                        <span class="small text-center d-block d-lg-inline">{{ jdate()->forge($complaint->referenced_at)->ago() }}</span>
                    </li>
                    @endif

                    @foreach($userFails as $userFail)
                    <li class="list-inline-item event-list">
                        <div class="px-4">
                            <img src="{{ asset($userFail->user->profile_image) }}" class="event-date rounded-circle" style="border: 3px solid rgb(179, 23, 23);" />
                            <small>پاسخی ثبت نشد</small>
                            <h6 class="font-size-16 mt-1">{{ $userFail->user->full_name }}</h6>
                        </div>
                        <span class="small text-center d-block d-lg-inline">{{ jdate()->forge($userFail->created_at)->ago() }}</span>
                    </li>
                    @endforeach

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
