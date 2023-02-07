@extends('admin.layouts.app', ['title' => 'همه کاربران'])

@section('content')
    <div class="row justify-content-center">
        <div class="col">
            <h2 class="h3 mb-0 page-title">کاربران</h2>
        </div>
        <div class="col-auto">
            <a href="{{ route('admin.user.users.create') }}" type="button" class="btn btn-primary px-4">ایجاد</a>
        </div>
        <div class="col-12">

            <div class="row my-4">
                <!-- Small table -->
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-body table-responsive">
                            <!-- table -->
                            <table class="table table-striped" id="table-id">
                                <thead>
                                    <div class="form-row py-2">
                                        <input class="col-md-3 form-control form-group" type="text"
                                            placeholder="نام کاربر را جستجو جو کنید ...">

                                        <div class="ml-3 mt-2 custom-control custom-checkbox ">
                                            <input type="checkbox" class="custom-control-input  " id="block_users">
                                            <label class="custom-control-label" for="block_users">کاربران مسدود شده</label>
                                        </div>
                                        <div class="ml-3 mt-2 custom-control custom-checkbox ">
                                            <input type="checkbox" class="custom-control-input  " id="personnel">
                                            <label class="custom-control-label" for="personnel">پرسنل</label>
                                        </div>

                                    </div>
                                    <th>#</th>
                                    <th>نام کاربر</th>
                                    <th>مسدود است</th>
                                    <th>نقش</th>
                                    <th>دسترسی</th>
                                    <th>نقش / دسترسی</th>
                                    <th>عملیات</th>
                                    </tr>
                                </thead>
                                @forelse($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <small>{{ $user->full_name }}</small>
                                        </td>
                                        <td>
                                            <div class="custom-control item-danger custom-checkbox align-items-center">
                                                <input type="checkbox" @checked($user->is_block)
                                                    class="custom-control-input item-success align-items-center"
                                                    id="user-{{ $user->id }}-status">
                                                <label class="custom-control-label align-items-center"
                                                    for="user-{{ $user->id }}-status"></label>
                                            </div>
                                        </td>
                                        <td>
                                            @forelse ($user->roles as $role)
                                                <div>
                                                    {{ $role->title }}
                                                </div>
                                            @empty
                                                <small class="text-danger">نقشی یافت نشد</small>
                                            @endforelse
                                        </td>
                                        <td>
                                            @forelse ($user->permissions as $permission)
                                                <div>
                                                    {{ $permission->key }}
                                                </div>
                                            @empty
                                                <small class="text-danger">دسترسی یافت نشد</small>
                                            @endforelse
                                        </td>
                                        <td>
                                            {{-- <a href="{{ route('admin.user.uesrs.roles' , $user->id) }}" type="button" class="btn btn-warning text-dark">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
                                                    <path
                                                        d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z">
                                                    </path>
                                                    <path fill-rule="evenodd"
                                                        d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z">
                                                    </path>
                                                </svg>
                                                نقش
                                            </a> --}}
                                            <a href="{{ route('admin.user.uesrs.permissions' , $user->id) }}" type="button" class="btn btn-success text-white">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-universal-access-circle"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M8 4.143A1.071 1.071 0 1 0 8 2a1.071 1.071 0 0 0 0 2.143Zm-4.668 1.47 3.24.316v2.5l-.323 4.585A.383.383 0 0 0 7 13.14l.826-4.017c.045-.18.301-.18.346 0L9 13.139a.383.383 0 0 0 .752-.125L9.43 8.43v-2.5l3.239-.316a.38.38 0 0 0-.047-.756H3.379a.38.38 0 0 0-.047.756Z">
                                                    </path>
                                                    <path
                                                        d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0ZM1 8a7 7 0 1 1 14 0A7 7 0 0 1 1 8Z">
                                                    </path>
                                                </svg>
                                                دسترسی
                                            </a>
                                        </td>
                                        <td>
                                            <a href="#" class="text-decoration-none text-info mr-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                    <path
                                                        d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                    <path
                                                        d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                                </svg>
                                            </a>
                                            <a href="{{ route('admin.user.users.edit', $user->id) }}"
                                                class="text-decoration-none text-primary mr-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path
                                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                    <path fill-rule="evenodd"
                                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                </svg>
                                            </a>
                                            <form action="{{ route('admin.user.users.destroy', $user->id) }}"
                                                class="d-inline" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" x-data="{{ $user->id }}"
                                                    class="delete border-none bg-transparent text-decoration-none text-danger mr-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                        fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                        <path
                                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                        <path fill-rule="evenodd"
                                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                                    </svg>
                                                    </a>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <p class="text-center text-muted">هیچ کاربری وجود ندارد.</p>
                                @endforelse
                            </table>
                            <section class="d-flex justify-content-center">
                                {{ $users->render() }}
                            </section>
                        </div>
                    </div> <!-- simple table -->
                </div> <!-- end section -->
            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div>
@endsection


@section('script')
    @include('admin.alerts.confirm')
@endsection
