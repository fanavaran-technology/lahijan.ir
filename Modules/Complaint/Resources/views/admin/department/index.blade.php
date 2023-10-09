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
                                        <button type="button" data-toggle="modal" data-target="#exampleModalCenter"
                                            class="btn px-4 btn-info">افزودن متصدیان</button>
                                        <a href="{{ route('admin.departements.create') }}" type="button"
                                            class="btn btn-primary px-4">ایجاد</a>
                                    </div>
                                    {{-- user modal start --}}
                                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <form action="{{ route('admin.departements.handler-permission') }}"
                                                method="post" class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">متصدیان شکایت</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="place_birth" class="input-title mr-3">کاربران :</label>
                                                        <div class="row form-check mt-3">
                                                            @foreach ($users as $user)
                                                                <label for="id-{{ $user->id }}" class="col-md-3 mt-3"
                                                                    class="d-flex align-items-center">
                                                                    <input type="checkbox" @checked($user->hasComplaintHandlerPermission())
                                                                        class="mr-2" value="{{ $user->id }}"
                                                                        name="user_id[]" id="id-{{ $user->id }}">
                                                                    <span>{{ $user->full_name }}</span>
                                                                </label>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">انصراف</button>
                                                    <button type="submit" class="btn btn-primary">افزودن به
                                                        متصدیان</button>
                                                </div>
                                        </div>
                                    </div>
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
                url: "admin/departement/edit/:id",
                content: 'ویرایش '
            }],
            deleteForm: {
                action: '/admin/departement/destroy',
                token: "{{ csrf_token() }}"
            }
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
