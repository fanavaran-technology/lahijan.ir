@extends('admin.layouts.app', ['title' => 'دپارتمان ها'])

@section('head-tag')
    <script src="{{ asset('assets/admin/plugins/cookup/cookup.js') }}"></script>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col">
            <h2 class="h3 mb-0 page-title">دپارتمان ها
            </h2>
        </div>
        <div class="col-12">
            <div class="row my-4">
                <!-- Small table -->
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="cookup-listens">
                                <div class="row py-2 d-flex align-items-center px-2">
                                    <input name="search" autocomplete="off"
                                        oninput="cookUp({'url' : requestUrl, 'params': {search: this.value} }, show)"
                                        class="col-md-4 form-control custom-focus form-group" type="text"
                                        placeholder="جستجو کنید ...">
                                    <div class="ml-auto">
                                        <a href="{{ route('admin.departements.create') }}" type="button"
                                            class="btn btn-primary px-4">ایجاد</a>
                                    </div>
                                </div>
                            </div>
                            <!-- table -->
                            <table class="table table-striped" id="table-id">
                                <thead>
                                    <th>#</th>
                                    <th>عنوان</th>
                                    <th>توضیحات</th>
                                    <th>عملیات</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <td colspan="6" class="d-none loading">
                                    <div class="d-flex justify-content-center align-items-center text-primary">
                                        <div class="spinner-border" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                        <div class="ml-2">در حال خواندن اطلاعات ...</div>
                                    </div>
                                </td>
                            </table>
                            <section class="d-flex justify-content-center">
                                <ul class="pagination cookup-listens">

                                </ul>
                            </section>
                        </div>
                    </div> <!-- simple table -->
                </div> <!-- end section -->
            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div>
    @include('admin.alerts.confirm')
@endsection


@section('script')
    <script>
        var requestUrl = "{{ route('admin.departements.fetch') }}";

        var request = {
            url: requestUrl,
            params: {}
        }

        var show = {
            dataKeys: ['title', 'description'],
            links: [{
                'url': "admin/departement/edit/:id",
                'content': 'ویرایش '
            }]
        }

        cookUp(request, show);

        const cookUpElements = document.querySelectorAll('.cookup-listens');

        cookUpElements.forEach(element => {
            element.addEventListener('click', (event) => {
                const item = event.target;
                if (item.hasAttribute('data-params')) {
                    const params = item.getAttribute('data-params');
                    cookUp({
                        url: requestUrl,
                        params: JSON.parse(params)
                    }, show);
                }
            })
        });
    </script>
@endsection
