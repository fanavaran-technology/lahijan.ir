@extends('admin.layouts.app', ['title' => 'شکایات'])

@section('head-tag')
    <script src="{{ asset('assets/admin/plugins/cookup/cookup.js') }}"></script>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col">
            <h2 class="h3 mb-0 page-title">شکایات
            </h2>
        </div>
        <div class="col-12">
            <div class="row my-4">
                <!-- Small table -->
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="cookup-listens">
                                <div class="row py-2 d-flex justify-content-center">
                                    <input name="search" autocomplete="off"
                                        oninput="cookUp({'url' : requestUrl, 'params': {search: this.value} }, show)"
                                        class="col-md-4 form-control custom-focus form-group" type="text"
                                        placeholder="جستجو کنید ...">
                                </div>
                                <div class="form-row flex justify-content-center flex-wrap mb-4">
                                    <div class="ml-3 mt-2 custom-control custom-checkbox">
                                        <input type="radio" name="filter" class="custom-control-input"
                                            data-params='{"filter": ""}' id="all-complaints">
                                        <label class="custom-control-label" for="all-complaints">همه شکایات </label>
                                        <span class="badge badge-pill badge-info">{{ $complaintsCount['all'] }}</span>
                                    </div>
                                    <div class="ml-3 mt-2 custom-control custom-checkbox">
                                        <input type="radio" checked name="filter" class="custom-control-input"
                                            data-params='{"filter": "not-referenced-complaints"}'
                                            id="not-referenced-complaints">
                                        <label class="custom-control-label" for="not-referenced-complaints">شکایات ارجاع
                                            نشده</label>
                                        <span class="badge badge-pill badge-danger">{{ $complaintsCount['notReferenced'] }}</span>
                                            
                                    </div>
                                    <div class="ml-3 mt-2 custom-control custom-checkbox">
                                        <input type="radio" name="filter" class="custom-control-input"
                                            data-params='{"filter": "referenced-complaints"}' id="referenced-complaints">
                                        <label class="custom-control-label" for="referenced-complaints">شکایات ارجاع
                                            شده</label>
                                        <span class="badge badge-pill badge-warning">{{ $complaintsCount['referenced'] }}</span>

                                    </div>
                                    <div class="ml-3 mt-2 custom-control custom-checkbox">
                                        <input type="radio" name="filter" class="custom-control-input"
                                            data-params='{"filter": "waiting-answer"}' id="waiting-answer">
                                        <label class="custom-control-label" for="waiting-answer">در انتظار پاسخ
                                        </label>
                                        <span class="badge badge-pill badge-primary">{{ $complaintsCount['waitingAnswer'] }}</span>
                                    </div>
                                    <div class="ml-3 mt-2 custom-control custom-checkbox">
                                        <input type="radio" name="filter" class="custom-control-input"
                                            data-params='{"filter": "invalid-complaints"}' id="invalid-complaints">
                                        <label class="custom-control-label" for="invalid-complaints">شکایات برگشتی
                                        </label>
                                        <span class="badge badge-pill badge-danger">{{ $complaintsCount['invalids'] }}</span>
                                    </div>
                                    <div class="ml-3 mt-2 custom-control custom-checkbox">
                                        <input type="radio" name="filter" class="custom-control-input"
                                            data-params='{"filter": "answered-complaints"}' id="answered-complaints">
                                        <label class="custom-control-label" for="answered-complaints">شکایات بررسی
                                            شده</label>
                                        <span class="badge badge-pill badge-success">{{ $complaintsCount['answered'] }}</span>
                                    </div>
                                </div>
                            </div>
                            <!-- table -->
                            <table class="table table-striped" id="table-id">
                                <thead>
                                    <th>#</th>
                                    <th>نام شاکی</th>
                                    <th>عنوان شکایت</th>
                                    <th>پاسخ دهنده</th>
                                    <th>وضعیت</th>
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
@endsection


@section('script')

    <script>
        var requestUrl = "{{ route('admin.complaints.fetch') }}";

        var request = {
            url: requestUrl,
            params: {
                filter: 'not-referenced-complaints'
            }
        }

        var show = {
            dataKeys: ['full_name', 'subject', 'reference' ,'status_label'],
            links: [
                {
                    'url' : "admin/complaints/:id",
                    'content': 'جزئیات '
                }
            ]
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
