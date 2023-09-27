@extends('admin.layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col">
            <h2 class="h3 mb-0 page-title">تمام دپارتمان ها
            </h2>
        </div>
        <div class="col-auto">
            <a href="{{ route('admin.departements.create') }}" type="button" class="btn btn-primary px-4">ایجاد</a>
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
                                    <form action="">
                                        <input name="search" class="col-md-3 form-control custom-focus form-group"
                                               type="text" placeholder="عنوان را جستجو و enter کنید">
                                    </form>

                                </div>
                                <div class="row w-100 mb-4 ml-1">
                                    @request('search')
                                    <h5>
                                                <span class="badge bg-light text-dark border mr-2">
                                                    جستجو : {{ request('search') }}
                                                    <svg style="cursor:pointer" class="ml-4" onclick="removeFilter('search')"
                                                         xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                                         fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                                        <path
                                                            d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
                                                    </svg>
                                                </span>
                                    </h5>
                                    @endrequest
                                </div>
                                <th>#</th>
                                <th>نام و نام خانوادگی</th>
                                <th>عنوان شکایت</th>
                                <th>عملیات</th>
                                </tr>
                                </thead>
                                @forelse($departements as $departement)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            {{ $departement->title }}
                                        </td>
                                        <td>
                                            {{ $departement->description }}
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.departements.edit' , $departement->id) }}" class="text-decoration-none text-info mr-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"></path>
                                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"></path>
                                                </svg>
                                            </a>
                                            <form
                                                action=""
                                                class="d-inline" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" x-data=""
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
                                    <p class="text-center text-muted">هیچ پیامی وجود ندارد.</p>
                                @endforelse
                            </table>
                            <section class="d-flex justify-content-center">
                                {{ $departements->appends($_GET)->render() }}
                            </section>
                        </div>
                    </div> <!-- simple table -->
                </div> <!-- end section -->
            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div>
@endsection

