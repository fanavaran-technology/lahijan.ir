@extends('admin.layouts.app')

@section('content')
<div style="display: flex; flex-direction:column; justify-content: center; height: 60vh;">
    <div class="text-secondary text-center">
        لطفا قبل از ادامه شماره تلفن خود را وارد نمایید
    </div>

    <form method="POST" action="{{ route('confirm-mobile.store') }}">
        @csrf

        <!-- mobile -->
        <div class="form-group col-12 col-md-6 mx-auto mt-5">
            <label for="mobile">شماره تلفن</label>

            <input  id="mobile" class="form-control custom-focus form-control-lg"
                            type="text"
                            name="mobile"
                            dir="ltr"
                            placeholder="شماره تلفن را وارد کنید"
                            required autocomplete="current-mobile" />

            @error('mobile')
                <span class="erorr">{{ $message }}</span>
            @enderror
            
        </div>
        <div class="d-flex justify-content-center mt-4">
            <button type="submit" class="btn btn-primary btn-lg">تایید</button>
        </div>
    </form>
</div>
@endsection