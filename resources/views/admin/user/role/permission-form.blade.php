@extends('admin.layouts.app', ['title' => ' اسلایدر جدید'])

@section('head-tag')

@endsection

@section('content')
    <div class="d-flex justify-content-between">
        <div class="col mb-2">
            <h2 class="h3 mb-0 page-title"> دسترسی ها</h2>
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
    <form action="{{ route('admin.user.roles.permission-update' , $role->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-12 col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <strong>نام نقش : {{ $role->title }}</strong>
                                <form class="needs-validation" novalidate="">
                                    <section class="col-12">
                                      <section class="row border-top mt-3 py-3">
                                        @php
                                            $rolePermissionArray = $role->permissions->pluck('id')->toArray();
                                        @endphp
                                        @foreach ($permissions as $title => $permission)
                                        <section class="col-md-3">  
                                            <div class="custom-control custom-checkbox pl-2  pt-3">
                                                <input type="checkbox" class="custom-control-input" name="permissions[]"
                                                 value="{{ $permission->id }}" id="{{ $permission->id }}" @if (in_array($permission->id, $rolePermissionArray))
                                                     checked
                                                 @endif>
                                                <label class="custom-control-label" for="{{ $permission->id }}">{{ $permission->title }}</label>
                                            </div>                                
                                          </section>
                                        @endforeach
                                      </section>
                                  </section>

                                    <button class="btn btn-primary" type="submit">ثبت کنید</button>
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
@endsection
