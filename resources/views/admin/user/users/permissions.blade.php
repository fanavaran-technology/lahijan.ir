@extends('admin.layouts.app', ['title' => 'ایجاد کاربر'])
<!-- Styles -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
<!-- Or for RTL support -->
<link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />
@section('content')
    <div class="row d-flex justify-content-between">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h3 mb-0 section-heading">دسترسی ها </h2>
        </div>
        <div class="col-auto mb-3">
            <a href="{{ route('admin.user.users.index') }}" type="button" class="btn btn-success px-4">بازگشت</a>
        </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger d-flex flex-column" role="alert">
            @foreach ($errors->all() as $error)
                <div class="mt-2">{{ $error }}</div>
            @endforeach
        </div>
    @endif
    <form action="{{ route('admin.user.users.permissions.store' , $user->id) }}" method="post" enctype="multipart/form-data" id="form">
        @csrf
        <div class="card-body">
                
            <div class="form-row">
              <div class="col-md-12 mb-3">
                <label for="validationCustom3">دسترسی کاربر</label>
                <select class="form-select text-right" dir="rtl" name="permissions[]" id="multiple-select-field-first" data-placeholder="دسترسی را انتخاب کنید" multiple>
                    @foreach ($permissions as $permission)
                    <option value="{{ $permission->id }}"
                        @foreach ($user->permissions as $user_permission)
                    @if ($user_permission->id === $permission->id)
                    selected
                    @endif
                     @endforeach>
                        {{ $permission->key }}</option>
                @endforeach
                </select>               
              </div>

             
            </div> <!-- /.form-row -->
          <!-- /.form-row -->
           
            <button class="btn btn-primary" type="submit">ثبت کنید</button>
          
        </div>
 
    </form>
@endsection

@section('script')
    <script src="{{ asset('assets/admin/js/custom.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>

    <script>
        $('#multiple-select-field-first').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            closeOnSelect: false,
        });
    </script>

    

@endsection
