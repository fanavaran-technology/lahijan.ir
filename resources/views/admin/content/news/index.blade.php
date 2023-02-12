@extends('admin.layouts.app', ['title' => 'همه خبر ها'])

@section('content')
    <div class="row justify-content-center">
        <div class="col">
            <h2 class="h3 mb-0 page-title">اخبار
                <span class="text-sm text-muted">({{ $allNews->total() }})</span>
            </h2>
        </div>
        @can('create_news')
            <div class="col-auto">
                <a href="{{ route('admin.content.news.create') }}" type="button" class="btn btn-primary px-4">ایجاد</a>
            </div>
        @endcan
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
                                        <div class="ml-3 mt-2 custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" onclick="filterAction(this)"
                                                data-filter="firestation"
                                                data-action="{{ request()->fullUrlWithQuery(['firestation' => 1]) }}"
                                                @checked(request('firestation') == 1) id="firestation">
                                            <label class="custom-control-label" for="firestation">اخبار آتش نشانی</label>
                                        </div>
                                        <div class="ml-3 mt-2 custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" onclick="filterAction(this)"
                                                data-filter="draft"
                                                data-action="{{ request()->fullUrlWithQuery(['draft' => 1]) }}"
                                                @checked(request('draft') == 1) id="draft">
                                            <label class="custom-control-label" for="draft">پیش نویس ها</label>
                                        </div>
                                        <div class="ml-3 mt-2 custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" onclick="filterAction(this)"
                                                data-filter="status"
                                                data-action="{{ request()->fullUrlWithQuery(['status' => 1]) }}"
                                                @checked(request('status') == 1) id="status">
                                            <label class="custom-control-label" for="status">منتشر شده ها</label>
                                        </div>
                                        <div class="ml-3 mt-2 custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" onclick="filterAction(this)"
                                                data-filter="pin"
                                                data-action="{{ request()->fullUrlWithQuery(['pin' => 1]) }}"
                                                @checked(request('pin') == 1) id="pin">
                                            <label class="custom-control-label" for="pin">سنجاق شده ها</label>
                                        </div>
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
                                        @request('draft')
                                            <h5>
                                                <span class="badge bg-light text-dark border mr-2">
                                                    <small>پیش نویس ها</small>
                                                    <svg style="cursor:pointer" class="ml-4" onclick="removeFilter('draft')"
                                                        xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                                        fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                                        <path
                                                            d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
                                                    </svg>
                                                </span>
                                            </h5>
                                        @endrequest
                                        @request('firestation')
                                            <h5>
                                                <span class="badge bg-light text-dark border mr-2">
                                                    <small>اخبار آتش نشانی</small>
                                                    <svg style="cursor:pointer" class="ml-4"
                                                        onclick="removeFilter('firestation')" xmlns="http://www.w3.org/2000/svg"
                                                        width="12" height="12" fill="currentColor" class="bi bi-x-lg"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
                                                    </svg>
                                                </span>
                                            </h5>
                                        @endrequest
                                        @request('status')
                                            <h5>
                                                <span class="badge bg-light text-dark border mr-2">
                                                    <small>منتشر شده ها</small>
                                                    <svg style="cursor:pointer" class="ml-4" onclick="removeFilter('status')"
                                                        xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                                        fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                                        <path
                                                            d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
                                                    </svg>
                                                </span>
                                            </h5>
                                        @endrequest
                                        @request('pin')
                                            <h5>
                                                <span class="badge bg-light text-dark border mr-2">
                                                    <small>سنجاق شده ها</small>
                                                    <svg style="cursor:pointer" class="ml-4" onclick="removeFilter('pin')"
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
                                    <th>عناوین</th>
                                    <th>پیش نویس</th>
                                    <th>سنجاق شده</th>
                                    <th>وضعیت انتشار</th>
                                    <th>عملیات</th>
                                    </tr>
                                </thead>
                                @forelse($allNews as $news)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <small>{{ Str::limit($news->title, 60, '...') }}</small>
                                        </td>
                                        <td>
                                            <div class="custom-control item-danger custom-checkbox align-items-center">
                                                <input type="checkbox" @checked($news->is_draft)
                                                    class="custom-control-input item-success align-items-center"
                                                    id="news-{{ $news->id }}-draft">
                                                <label class="custom-control-label align-items-center"
                                                    for="news-{{ $news->id }}-draft"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-control item-danger custom-checkbox align-items-center">
                                                <input type="checkbox" @checked($news->is_pined)
                                                    class="custom-control-input item-success align-items-center"
                                                    id="news-{{ $news->id }}-pined">
                                                <label class="custom-control-label align-items-center"
                                                    for="news-{{ $news->id }}-pined"></label>
                                            </div>
                                        </td>

                                        <td>{{ $news->publishStatus }}</td>
                                        <td class="flex">
                                            <button class="btn btn-sm dropdown-toggle more-horizontal justify-center"
                                                type="button" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <span class="text-muted sr-only">Action</span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="text-decoration-none p-3" title="گالری"
                                                    href="{{ route('admin.content.news.index-gallery', $news->id) }}">
                                                    <svg fill="#009e0b" height="26px" width="26px" version="1.1"
                                                        id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512"
                                                        xml:space="preserve" stroke="#009e0b">
                                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                            stroke-linejoin="round"></g>
                                                        <g id="SVGRepo_iconCarrier">
                                                            <g>
                                                                <g>
                                                                    <path
                                                                        d="M345.089,459.056H48.407c-17.432,0-31.614-14.182-31.614-31.615V84.558c0-17.433,14.182-31.615,31.614-31.615h56.61 c4.638,0,8.396-3.759,8.396-8.396s-3.758-8.396-8.396-8.396h-56.61C21.715,36.151,0,57.867,0,84.558v342.883 c0,26.693,21.715,48.408,48.407,48.408h296.683c4.638,0,8.396-3.759,8.396-8.396S349.727,459.056,345.089,459.056z">
                                                                    </path>
                                                                </g>
                                                            </g>
                                                            <g>
                                                                <g>
                                                                    <path
                                                                        d="M463.593,36.15H136.026c-4.638,0-8.396,3.759-8.396,8.396s3.758,8.397,8.396,8.397h327.568 c17.432,0,31.614,14.182,31.614,31.615v342.883c0,17.433-14.182,31.615-31.614,31.615h-84.919c-4.638,0-8.396,3.759-8.396,8.396 s3.758,8.396,8.396,8.396h84.919c26.692,0,48.407-21.715,48.407-48.408V84.558C512,57.867,490.285,36.15,463.593,36.15z">
                                                                    </path>
                                                                </g>
                                                            </g>
                                                            <g>
                                                                <g>
                                                                    <path
                                                                        d="M440.507,73.792H71.494c-18.668,0-33.854,15.186-33.854,33.854v54.07c-0.003,0.113-0.001,0.225,0,0.338v242.3 c0,18.629,15.124,33.788,33.738,33.852c0.038,0,0.077,0.006,0.116,0.006c0.01,0,0.019-0.002,0.029-0.002h123.925 c0.012,0,0.025,0.002,0.036,0.002c0,0,0.018-0.002,0.027-0.002h244.996c18.666-0.001,33.853-15.187,33.853-33.855v-170.35 c0-0.004,0-0.009,0-0.013V107.646C474.36,88.978,459.173,73.792,440.507,73.792z M66.128,420.538 c-6.784-2.257-11.694-8.653-11.694-16.184v-61.325c18.11-19.773,40.655-30.34,67.087-31.365c8.115-0.316,15.441,0.357,21.383,1.3 C108.92,342.889,81.362,383.442,66.128,420.538z M54.433,166.28c7.25-4.757,15.615-7.254,24.42-7.254 c19.284,0,36.325,12.292,42.405,30.59c0.798,2.404,2.639,4.318,5.011,5.21c2.369,0.891,5.017,0.667,7.203-0.613 c7.462-4.373,15.988-6.684,24.657-6.684c24.677,0,45.526,18.451,48.494,42.918c0.47,3.878,3.554,6.92,7.439,7.337 c17.43,1.873,31.739,14.426,36.464,30.746c-13.721-0.844-27.871,0.978-42.19,5.526c-16.911,5.371-33.281,14.218-48.647,25.42 c-6.81-1.968-20.807-5.183-38.094-4.616c-18.445,0.606-43.672,5.774-67.161,25.052V166.28H54.433z M457.566,404.354 c0,9.407-7.653,17.061-17.06,17.061H209.175c4.955-8.942,10.609-17.663,16.148-26.175c3.732-5.737,7.593-11.671,11.212-17.63 c2.406-3.964,1.143-9.129-2.82-11.536c-3.963-2.405-9.127-1.144-11.536,2.82c-3.482,5.736-7.27,11.558-10.933,17.188 c-7.342,11.285-14.898,22.911-21.052,35.334H83.971c29.733-68.724,86.451-117.7,129.446-131.356 c25.683-8.157,49.799-6.355,71.844,5.335c-1.611,1.487-3.216,2.99-4.814,4.518c-10.743,10.274-21.354,21.656-31.538,33.832 c-1.16,1.387-2.312,2.78-3.456,4.18c-2.933,3.591-2.4,8.881,1.19,11.814c3.482,2.845,8.905,2.372,11.815-1.19 c1.102-1.349,2.211-2.691,3.331-4.029c9.787-11.701,19.969-22.625,30.264-32.469c11.674-11.164,23.73-21.164,35.833-29.727 c13.364-9.453,27.097-17.377,40.82-23.553c15.048-6.771,30.469-11.614,45.832-14.392c14.154-2.56,28.595-3.411,43.027-2.575 V404.354z M457.566,224.996c-15.437-0.819-30.873,0.12-46.017,2.858c-16.708,3.022-33.44,8.272-49.733,15.604 c-14.707,6.617-29.385,15.082-43.628,25.158c-6.557,4.638-13.093,9.676-19.561,15.062c-9.688-5.821-19.853-9.989-30.359-12.504 c-3.764-24.083-22.254-43.79-46.051-49.046c-6.573-29.706-33.082-51.391-64.09-51.391c-8.467,0-16.835,1.642-24.627,4.796 c-10.411-20.244-31.339-33.299-54.648-33.299c-8.55,0-16.797,1.718-24.42,5.028v-39.615h0.001c0-9.407,7.654-17.061,17.061-17.061 h369.011c9.407,0,17.06,7.654,17.06,17.061V224.996z">
                                                                    </path>
                                                                </g>
                                                            </g>
                                                            <g>
                                                                <g>
                                                                    <path
                                                                        d="M340.64,132.32c-24.442,0-44.328,19.886-44.328,44.328s19.886,44.328,44.328,44.328c24.442,0,44.328-19.886,44.328-44.328 C384.969,152.206,365.083,132.32,340.64,132.32z M340.64,204.185c-15.184,0-27.536-12.353-27.536-27.536 c0.001-15.184,12.353-27.536,27.536-27.536c15.184,0,27.536,12.352,27.536,27.536C368.176,191.832,355.824,204.185,340.64,204.185 z">
                                                                    </path>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </svg>
                                                </a>
                                                <a href="#" class="text-decoration-none text-info mr-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                        fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                        <path
                                                            d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                        <path
                                                            d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                                    </svg>
                                                </a>

                                                @can('edit_news')
                                                    <a href="{{ route('admin.content.news.edit', $news->id) }}"
                                                        class="text-decoration-none text-primary mr-3">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                            fill="currentColor" class="bi bi-pencil-square"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                            <path fill-rule="evenodd"
                                                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                        </svg>
                                                    </a>
                                                @endcan
                                                @can('delete_news')
                                                    <form action="{{ route('admin.content.news.destroy', $news->id) }}"
                                                        class="d-inline" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" x-data="{{ $news->id }}"
                                                            class="delete border-none bg-transparent text-decoration-none text-danger mr-3">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                                height="20" fill="currentColor" class="bi bi-trash"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                                <path fill-rule="evenodd"
                                                                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                                            </svg>
                                                            </a>
                                                    </form>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <p class="text-center text-muted">هیچ خبری وجود ندارد.</p>
                                @endforelse
                            </table>
                            <section class="d-flex justify-content-center">
                                {{ $allNews->render() }}
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
