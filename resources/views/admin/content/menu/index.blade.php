@extends('admin.layouts.app', ['title' => 'همه منو ها'])

@section('content')
    <div class="row justify-content-center">
        <div class="col">
            <h2 class="h3 mb-0 page-title">منو ها</h2>
        </div>
        <div class="col-auto">
            <a href="{{ route('admin.content.menus.create') }}" type="button" class="btn btn-primary px-4">ایجاد</a>
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
                                            placeholder="منویی را جستجو جو کنید ...">

                                        <div class="ml-3 mt-2 custom-control custom-checkbox ">
                                            <input type="checkbox" class="custom-control-input  " id="19">
                                            <label class="custom-control-label" for="19">پیش نویس ها</label>
                                        </div>

                                    </div>
                                    <th>#</th>
                                    <th>عناوین</th>
                                    <th>دسته والد</th>
                                    <th>وضعیت نمایش</th>
                                    <th>عملیات</th>
                                    </tr>
                                </thead>
                                @forelse($menus as $menu)  
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <small>{{ Str::limit($menu->title, 60, '...') }}</small>
                                    </td>
                                    <td>{{ $menu->parent_menu }}</td>
                                    <td>
                                        <div class="custom-control item-danger custom-checkbox align-items-center">
                                            <input type="checkbox" @checked($menu->status)
                                                class="custom-control-input item-success align-items-center" id="place-{{ $menu->id }}-status">
                                            <label class="custom-control-label align-items-center" for="place-{{ $menu->id }}-status"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.content.menus.edit' , $menu->id) }}" class="text-decoration-none text-primary mr-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.content.menus.destroy' , $menu->id) }}" class="d-inline" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" x-data="{{ $menu->id }}" class="delete border-none bg-transparent text-decoration-none text-danger mr-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                </svg>
                                            </a>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                    <p class="text-center text-muted">هیچ منویی وجود ندارد.</p>
                                @endforelse
                            </table>
                            <section class="d-flex justify-content-center">
                                {{ $menus->render() }}
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