@extends('admin.layouts.app', ['title' => 'همه کارکنان'])

@section('content')
    <div class="row justify-content-center">
        <div class="col">
            <h2 class="h3 mb-0 page-title">همه کارکنان
                <span class="text-sm text-muted">({{ $perssonels->total() }})</span>
            </h2>
        </div>
        {{-- @can('create_perssonels') --}}
        <div class="col-auto">
            <a href="{{ route('admin.clarification.perssonels.create') }}" type="button" class="btn btn-primary px-4">ایجاد</a>
{{--                            <form action="{{ route('admin.clarification.file-import') }}" method="POST" enctype="multipart/form-data">--}}
{{--                                @csrf--}}
{{--                                <div class="form-group mb-4" style="max-width: 500px; margin: 0 auto;">--}}
{{--                                    <div class="custom-file text-left">--}}
{{--                                        <input type="file" name="file" class="custom-file-input" id="customFile">--}}
{{--                                        <label class="custom-file-label" for="customFile">Choose file</label>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <button class="btn btn-primary">Import data</button>--}}
{{--                            </form>--}}
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter">
                ایجاد کارمند با فایل اکسل
            </button>

            <!-- Modal -->

                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                     aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">اضافه کردن کاربر</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('admin.clarification.file-import') }}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="custom-file text-left">
                                        <input type="file" name="file" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                                    <button class="btn btn-primary">اضافه کردن کارمند</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        </div>

        {{-- @endcan --}}
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
                                    <form action="">
                                        <input name="search" class="col-md-3 form-control custom-focus form-group"
                                               type="text" placeholder="نام کارمند را جستجو و enter کنید">
                                    </form>
                                    <div class="ml-3 mt-2 custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" onclick="filterAction(this)"
                                               data-filter="is_disable"
                                               data-action="{{ request()->fullUrlWithQuery(['is_disable' => 1]) }}"
                                               @checked(request('is_disable') == 1) id="is_disable">
                                        <label class="custom-control-label" for="is_disable">کارکنان غیرفعال</label>
                                    </div>
                                </div>
                                <div class="row w-100 mb-4 ml-1">
                                    @request('search')
                                    <h5>
                                                <span class="badge bg-light text-dark border mr-2">
                                                    جستجو : {{ request('search') }}
                                                    <svg style="cursor:pointer" class="ml-4"
                                                         onclick="removeFilter('search')"
                                                         xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                                         fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                                        <path
                                                            d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                                                    </svg>
                                                </span>
                                    </h5>
                                    @endrequest
                                    @request('is_disable')
                                    <h5>
                                                <span class="badge bg-light text-dark border mr-2">
                                                    <small>کارکنان غیرفعال</small>
                                                    <svg style="cursor:pointer" class="ml-4"
                                                         onclick="removeFilter('status')"
                                                         xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                                         fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                                        <path
                                                            d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                                                    </svg>
                                                </span>
                                    </h5>
                                    @endrequest
                                </div>
                                <th>#</th>
                                <th>نام و نام خانوادگی</th>
                                <th>غیر فعال است</th>
                                <th>عملیات</th>
                                </tr>
                                </thead>
                                @forelse($perssonels as $perssonel)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <small>{{ $perssonel->full_name }}</small>
                                        </td>
                                        <td>
                                            {{-- @can('edit_slider') --}}
                                            <label>
                                                <input id="{{ $perssonel->id }}"
                                                       onchange="changeStatus({{ $perssonel->id }})"
                                                       data-url="{{ route('admin.clarification.perssonels.disable', $perssonel->id) }}"
                                                       type="checkbox" @checked($perssonel->is_disable)>
                                            </label>
                                            {{-- @endcan --}}
                                        </td>
                                        <td>
                                            {{-- @can('edit_perssonels') --}}
                                            <a href="{{ route('admin.clarification.perssonels.edit', $perssonel->id) }}"
                                               class="text-decoration-none text-primary mr-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                     fill="currentColor" class="bi bi-pencil-square"
                                                     viewBox="0 0 16 16">
                                                    <path
                                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                    <path fill-rule="evenodd"
                                                          d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                </svg>
                                            </a>
                                            {{-- @endcan --}}
                                            {{-- @can('delete_perssonels') --}}
                                            <form
                                                action="{{ route('admin.clarification.perssonels.destroy', $perssonel->id) }}"
                                                class="d-inline" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" x-data="{{ $perssonel->id }}"
                                                        class="delete border-none bg-transparent text-decoration-none text-danger mr-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                         fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                        <path
                                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                        <path fill-rule="evenodd"
                                                              d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                    </svg>
                                                    </a>
                                            </form>
                                            {{-- @endcan --}}
                                        </td>
                                    </tr>
                                @empty
                                    <p class="text-center text-muted">هیچ کارمندی وجود ندارد.</p>
                                @endforelse
                            </table>
                            <section class="d-flex justify-content-center">
                                {{ $perssonels->appends($_GET)->render() }}
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

    <script type="text/javascript">
        function changeStatus(id) {
            const element = $("#" + id)
            const url = element.attr('data-url')
            const elementValue = !element.prop('checked');

            $.ajax({
                url: url,
                type: "GET",
                success: function (response) {
                    if (response.status) {
                        if (response.checked) {
                            element.prop('checked', true);
                            successToast('کارمند غیر فعال شد')
                        } else {
                            element.prop('checked', false);
                            successToast('کارمند فعال شد')
                        }
                    } else {
                        element.prop('checked', elementValue);
                        errorToast('مشکلی بوجود امده است')
                    }
                },
                error: function () {
                    element.prop('checked', elementValue);
                    errorToast('ارتباط برقرار نشد')
                }
            });
        }
    </script>
@endsection
