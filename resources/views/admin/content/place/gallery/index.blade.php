@extends('admin.layouts.app', ['title' => 'همه اماکن گردشگری'])
{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}

@section('content')
    <div class="row justify-content-center">
        <div class="col">
            <h2 class="h3 mb-0 page-title">اماکن گردشگری</h2>
        </div>
        
            <div class="ml-5">
                <button data-toggle="modal" data-target="#exampleModalCenter" type="button" class="btn btn-primary px-4">ایجاد</a>
            </div>

            <div class="col-auto ">
                <a href="{{ route('admin.content.places.index') }}" class="btn btn-success px-4">بازگشت</a>
            </div>
        
   
        <div class="col-12">
            @if ($errors->any())
            <div class="alert alert-danger d-flex flex-column mt-2" role="alert">
                @foreach ($errors->all() as $error)
                    <div class="mt-2">{{ $error }}</div>
                @endforeach
            </div>
        @endif

            <div class="row my-4">
                <!-- Small table -->
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-body table-responsive">
                            <!-- table -->
                            <table class="table table-striped" id="table-id">
                                <thead>
                                    <div class="form-row py-2">
                                        <h6 class="font-bold">گالری تصاویر مکان گردشگری {{ $place->title }}</h6>
                                    </div>
                                    <th>#</th>
                                    <th>alt تصویر</th>
                                    <th>عکس</th>
                                    <th>عملیات</th>
                                    </tr>
                                </thead>
                                {{-- {{ dd($place->gallerizable) }} --}}

                                @forelse($place->gallerizable as $image)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <small>{{ $image->alt }}</small>
                                        </td>
                                        <td>
                                            <img src="{{ asset($image->image) }}" alt="{{ $image->alt }}" class="rounded-lg" height="70" width="120">
                                        </td>
                                        <td>

                                    
                                        <form action="{{ route('admin.content.places.destroy-gallery', $image->id) }}" class="d-inline" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" x-data="{{ $image->id }}" class="delete border-none bg-transparent text-decoration-none text-danger mr-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                </svg>
                                            </a>
                                        </form>
                                    </td>
                                    </tr>
                                @empty
                                    <p class="text-center text-muted">هیچ عکسی وجود ندارد.</p>
                                @endforelse
                            </table>


                        </div>
                    </div> <!-- simple table -->
                </div> <!-- end section -->
            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">تصویر خود را ایجاد کنید</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.content.places.create-gallery', $place->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="simpleinput">alt عکس</label>
                            <input name="alt" type="text" id="simpleinput" class="form-control">
                        </div>

                        <label for="simpleinput">آپلود تصویر</label>
                        <div class="form-group inputDnD">
                            <input type="file" class="form-control-file" name="image" id="inputFile"
                                onchange="readUrl(this)" data-title="کلیک کنید یا تصویر را بکشید">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary">Save changes</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

  
@endsection


@section('script')
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> --}}

    <script src="{{ asset('assets/admin/js/custom.js') }}"></script>


    @include('admin.alerts.confirm')
@endsection
