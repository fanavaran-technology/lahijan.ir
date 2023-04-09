@extends('admin.layouts.app', ['title' => 'بنر تئاتر '])

@section('content')
    <div class="row justify-content-center">
        <div class="col">
        </div>

            <div class="col-auto">
                <a href="{{ route('admin.content.theater.index') }}" type="button" class="btn btn-success px-4">بازگشت</a>
            </div>

        <div class="col-12">

            <div class="row my-4">
                <!-- Small table -->
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-body table-responsive">
                            <!-- table -->
                            <table class="table table-striped" id="table-id">
                                    <th>#</th>
                                    <th>alt تصویر</th>
                                    <th>فعال / غیرفعال</th>
                                    <th>عملیات</th>
                                @forelse($bannerTheater as $theater)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <small>{{ $theater->alt}}</small>
                                        </td>
                                        <td>
                                            <label>
                                                <input id="{{ $theater->id }}" onchange="changeStatus({{ $theater->id }})"
                                                    data-url="{{ route('admin.content.banner-theater.status', $theater->id) }}"
                                                    type="checkbox" @if ($theater->status === 1) checked @endif>
                                            </label>
                                        </td>
                                        <td>
                                                <a href="{{ route('admin.content.banner-theater.edit', $theater->id) }}"
                                                    class="text-decoration-none text-primary mr-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                        fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                        <path
                                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                        <path fill-rule="evenodd"
                                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                    </svg>
                                                </a>
                                        </td>
                                    </tr>
                                @empty
                                    <p class="text-center text-muted">هیچ تئاتری وجود ندارد.</p>
                                @endforelse
                            </table>
                        </div>
                    </div> <!-- simple table -->
                </div> <!-- end section -->
            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/admin/js/custom.js') }}"></script>

    <script type="text/javascript">
        function changeStatus(id) {
            var element = $("#" + id)
            var url = element.attr('data-url')
            var elementValue = !element.prop('checked');

            $.ajax({
                url: url,
                type: "GET",
                success: function(response) {
                    if (response.status) {
                        if (response.checked) {
                            element.prop('checked', true);
                            successToast('تئاتر فعال شد')
                        } else {
                            element.prop('checked', false);
                            successToast('تئاتر غیر فعال شد')
                        }
                    } else {
                        element.prop('checked', elementValue);
                        errorToast('مشکلی بوجود امده است')
                    }
                },
                error: function() {
                    element.prop('checked', elementValue);
                    errorToast('ارتباط برقرار نشد')
                }
            });
        }
    </script>

    @include('admin.alerts.confirm')
@endsection
