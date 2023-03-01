@extends('admin.layouts.app', ['title' => 'ثبت حقوق و دستمزد جدید'])

@section('head-tag')
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/jalalidatepicker/persian-datepicker.min.css') }}">
@endsection

@section('content')
    <div class="row d-flex justify-content-between">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h3 mb-0 section-heading">ثبت حقوق و دستمزد جدید </h2>
        </div>
        <div class="col-auto mb-3">
            <a href="{{ route('admin.clarification.salaries.index') }}" type="button" class="btn btn-success px-4">بازگشت</a>
        </div>



    </div>
    @if ($errors->any())
        <div class="alert alert-danger d-flex flex-column" role="alert">
            @foreach ($errors->all() as $error)
                <div class="mt-2">{{ $error }}</div>
            @endforeach
        </div>
    @endif
    <form action="{{ route('admin.clarification.salaries.store') }}" method="post" id="salaryForm" enctype="multipart/form-data">
        @csrf
        <!-- places content -->
        <div class="form-row">
            <label for="published_at_view" class="input-title">
                عنوان حقوق و دستمزد
            </label>
            <div class="form-group col-md-12 my-2">
                <input type="text" name="title" value="{{ old('title') }}" onkeyup="copyToSlug(this)"
                    placeholder="برای مثال اطلاعات حقوق و مزایای کارکنان شهرداری لاهیجان – اسفند 1401 "
                    class="form-control custom-input-size custom-focus" id="title">
            </div>
            <label for="published_at_view" class="input-title mt-2">
                توضیحات (اختیاری)
            </label>
            <div class="form-group col-md-12 mt-2">
                <textarea name="description" class="form-control custom-focus" cols="5">{{ old('description') }}</textarea>
            </div>
        </div>
        <table class="table table-striped">
            <thead>
                <th>نام</th>
                <th>نام خانوادگی</th>
                <th> دریافتی خالص (ریال)</th>
            </thead>
            <tbody>
                @forelse($perssonels as $key => $perssonel)
                <tr>
                        <input type="hidden" name="perssonel_id[]" value="{{ $perssonel->id }}">
                        <td>
                            <small>{{ $perssonel->first_name }}</small>
                        </td>
                        <td>
                            <small>{{ $perssonel->last_name }}</small>
                        </td>
                        <td class="d-flex align-items-center">
                            <input type="number" name="amount[{{ $key }}]" value="{{ old("amount.$key") }}" class="form-control custom-focus url @error("amount.$perssonel->id") is-invalid @enderror mr-2 currency-input"
                                style="width:10rem">
                            <div style="direction: ltr"></div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary">ثبت</button>
    </form>
@endsection

@section('script')
    <script src="{{ asset('assets/admin/js/custom.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/jalalidatepicker/persian-date.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/jalalidatepicker/persian-datepicker.min.js') }}"></script>

    <script>
        const salaryForm = document.querySelector('#salaryForm');
        const currencies = document.querySelectorAll('.currency-input');

        salaryForm.addEventListener('submit' , (e) => {
            e.preventDefault();
            currencies.forEach(curr => {
                if (!curr.value) {
                    curr.parentElement.parentElement.remove();
                }
            });
            salaryForm.submit();
        });
    </script>

    <script>
        const currencyInputs = document.querySelectorAll('.currency-input');

        currencyInputs.forEach(currencyInput => {
            currencyInput.addEventListener('keyup', (e) => {
                let input = e.target;
                let currencyLength = e.target.value.length;
                if (currencyLength > 15)
                    input.nextElementSibling.innerHTML = `!!!`
                else if (currencyLength >= 10)
                    input.nextElementSibling.innerHTML = `میلیار ریال`
                else if (currencyLength >= 7)
                    input.nextElementSibling.innerHTML = `میلیون ریال`
                else if (currencyLength >= 4)
                    input.nextElementSibling.innerHTML = `هزار ریال`
                else
                    input.nextElementSibling.innerHTML = `ریال`
            })
        });
    </script>
@endsection
