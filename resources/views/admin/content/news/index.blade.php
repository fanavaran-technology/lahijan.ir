@extends('admin.layouts.app', ['title' => 'همه خبر ها'])

@section('content')
    <div class="row justify-content-center">
        <div class="col">
            <h2 class="h3 mb-0 page-title">اخبار</h2>
        </div>
        <div class="col-auto">
            <a href="{{ route('admin.content.news.create') }}" type="button" class="btn btn-primary px-4">ایجاد</a>
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
                                            placeholder="خبر خود را جستو جو کنید ...">
                                        {{-- <div class="d-flex col-md-4">
                                            <input class=" ml-2 form-control form-group text-center" type="text"
                                                name="daterange" />
                                            <button type="button" class="ml-1 mt-0 btn btn-primary"
                                                style="height: 35px;">فیلتر</button>
                                        </div>

                                        <select class="col-md-1  ml-2 form-control" name="state" id="maxRows">
                                            <option value="5">5</option>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                            <option value="20">20</option>
                                            <option value="50">50</option>
                                            <option value="70">70</option>
                                            <option value="100">100</option>
                                            <option value="5000">نمایش تمام سطر ها</option>

                                        </select> --}}

                                        <div class="ml-3 mt-2 custom-control custom-checkbox ">
                                            <input type="checkbox" class="custom-control-input  " id="10">
                                            <label class="custom-control-label" for="10">اخبار آتش نشانی</label>
                                        </div>

                                        <div class="ml-3 mt-2 custom-control custom-checkbox ">
                                            <input type="checkbox" class="custom-control-input  " id="19">
                                            <label class="custom-control-label" for="19">پیش نویس ها</label>
                                        </div>

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
                                            <input type="checkbox"
                                                class="custom-control-input item-success align-items-center" id="news-{{ $news->id }}-draft">
                                            <label class="custom-control-label align-items-center" for="news-{{ $news->id }}-draft"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="custom-control item-danger custom-checkbox align-items-center">
                                            <input type="checkbox"
                                                class="custom-control-input item-success align-items-center" id="news-{{ $news->id }}-pined">
                                            <label class="custom-control-label align-items-center" for="news-{{ $news->id }}-pined"></label>
                                        </div>
                                    </td>
                                    <td>{{ $news->published_at }}</td>
                                    <td>
                                        <a href="#" class="text-decoration-none text-danger"><i
                                                class="fe fe-x-circle fe-24 mr-1"></i></a>
                                        <a href="#" class="text-decoration-none text-success"><i
                                                class="fe fe-edit fe-24 mr-1"></i></a>
                                        <a href="#" class="text-decoration-none text-primary-light"><i
                                                class="fe fe-eye fe-24 mr-1"></i></a>
                                    </td>
                                </tr>
                                @empty
                                    <p class="text-center text-muted">هیچ خبری وجود ندارد.</p>
                                @endforelse
                            
                            </table>

                            <!-- <nav aria-label="Table Paging" class="mb-0 text-muted">
                    <ul class="pagination  justify-content-center mb-0">
                      <li class="page-item" data-page="prev"><span> < <span class="sr-only">(current)</span></span></li>
                      <li class="page-item" data-page="next" id="prev"><span> > <span class="sr-only">(current)</span></span></li>
                    </ul>
                  </nav> -->
                        </div>
                    </div> <!-- simple table -->
                </div> <!-- end section -->
            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div>
@endsection
