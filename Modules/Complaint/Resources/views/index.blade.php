@extends('admin.layouts.app', ['title' => 'همه پیام های ارسال شده'])

@section('content')
    <div class="row justify-content-center">
        <div class="col">
            <h2 class="h3 mb-0 page-title">شکایات های ارسال شده
            </h2>
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
                                <th>شکایت</th>
                                </tr>
                                </thead>
                                @forelse($complaints as $complaint)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <small>{!! Str::limit($complaint->description, 100, '...') !!}</small>
                                        </td>

                                        <td>


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
                                {{ $complaints->appends($_GET)->render() }}
                            </section>
                        </div>
                    </div> <!-- simple table -->
                </div> <!-- end section -->
            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div>
@endsection

