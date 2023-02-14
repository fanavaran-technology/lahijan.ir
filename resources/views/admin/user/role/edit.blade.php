@extends('admin.layouts.app', ['title' => ' اسلایدر جدید'])

@section('head-tag')
@endsection

@section('content')
    <div class="d-flex justify-content-between">
        <div class="col mb-2">
            <h2 class="h3 mb-0 page-title">ویرایش نقش</h2>
        </div>

        <div class="col-auto mb-3">
            <a href="{{ route('admin.user.roles.index') }}" type="button" class="btn btn-success px-4">بازگشت</a>
        </div>

    </div>
    @if ($errors->any())
        <div class="alert alert-danger d-flex flex-column" role="alert">
            @foreach ($errors->all() as $error)
                <div class="mt-2">{{ $error }}</div>
            @endforeach
        </div>
    @endif
    <form action="{{ route('admin.user.roles.update', $role->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-12 col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <form class="needs-validation" novalidate="">
                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <label for="validationCustom3">عنوان نقش</label>
                                            <input type="text" name="title" placeholder="عنوان نقش را وراد کنید""
                                                class="form-control" id="validationCustom3"
                                                value="{{ old('title', $role->title) }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="validationCustom3">توضیح نقش</label>
                                            <input type="text" name="description" placeholder="توضیح نقش را وراد کنید""
                                                class="form-control" id="validationCustom3"
                                                value="{{ old('description', $role->description) }}">
                                        </div>
                                    </div>
                                    <section class="col-12">
                                        <div class="custom-control custom-checkbox pl-2">
                                            <input type="checkbox" class="custom-control-input" id="select-all">
                                            <label class="custom-control-label" for="select-all">انتخاب همه دسترسی ها</label>
                                        </div>
                                        <section class="row border-top mt-3 py-3">
                                            @php
                                                $rolePermissions = $role->permissions->pluck('id')->toArray();   
                                            @endphp
                                            @foreach ($permissions as $key => $permission)
                                                <section class="col-md-3 mt-2">
                                                    <div class="custom-control custom-checkbox pl-2">
                                                        <input type="checkbox"  @checked(in_array($permission->id , old('permissions' , $rolePermissions) ?? [])) class="custom-control-input permission-check"
                                                            name="permissions[]" value="{{ $permission->id }}"
                                                            id="{{ $permission->id }}">
                                                        <label class="custom-control-label"
                                                            for="{{ $permission->id }}">{{ $permission->title }}</label>
                                                        @error('permissions.'. $key)
                                                            <span class="block text-xs text-red-500 dark:text-red-400">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </section>
                                            @endforeach
                                        </section>
                                    </section>
                                    <button class="btn btn-primary mt-2" type="submit">ثبت کنید</button>
                                </form>
                            </div> <!-- /.card-body -->
                        </div> <!-- /.card -->
                    </div>

                </div> <!-- /. end-section -->
            </div>
        </div> <!-- .row -->
    </form>
@endsection

@section('script')
<script>
    const selectAll = document.querySelector('#select-all');
    selectAll.addEventListener('change' , e => {
        console.log('hi');
        const permissions = document.querySelectorAll('.permission-check');

        if (e.target.checked) {
            permissions.forEach(permission => {
                permission.checked = true;
            });
        } else {
            permissions.forEach(permission => {
                permission.checked = false;
            });
        }
    });
</script>
@endsection
