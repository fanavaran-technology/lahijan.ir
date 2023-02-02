@extends('admin.layouts.app', ['title' => 'همه صفحات'])

@section('content')
    <div class="row justify-content-center">
        <div class="col">
            <h2 class="h3 mb-0 page-title">همه صفحات</h2>
        </div>
        <div class="col-auto">
            <a href="{{ route('admin.content.pages.create') }}" type="button" class="btn btn-primary px-4">ایجاد</a>
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
                                            placeholder="مکان گردشگری را جستجو جو کنید ...">
                                    </div>
                                    <th>#</th>
                                    <th>عناوین</th>
                                    <th>وضعیت نمایش</th>
                                    <th> دسترسی سریع</th>
                                    <th>عملیات</th>
                                    </tr>
                                </thead>
                                @forelse($pages as $page)  
                                <tr class="flex item-center">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <small>{{ $page->title }}</small>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" id="{{ $page->id }}" onchange="changeStatus({{ $page->id }})" data-url="{{ route('admin.content.pages.is_draft', $page->id) }}" type="checkbox" @if ($page->is_draft === 1)
                                            checked
                                            @endif>
                                            <label class="custom-control-label" for="{{ $page->id }}"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" id="{{ $page->id }}-access" onchange="changeStatus1({{ $page->id }})" data-url="{{ route('admin.content.pages.is_quick_access', $page->id) }}" type="checkbox" @if ($page->is_quick_access === 1)
                                            checked
                                            @endif>
                                            <label class="custom-control-label" for="{{ $page->id }}-access"></label>
                                        </div>
                                    </td>
                                    
                                    <td>
                                        <a href="#" class="text-decoration-none text-info mr-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                            </svg>
                                        </a>
                                        <a href="{{ route('admin.content.pages.edit' , $page->id) }}" class="text-decoration-none text-primary mr-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.content.pages.destroy' , $page->id) }}" class="d-inline" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" x-data="{{ $page->id }}" class="delete border-none bg-transparent text-decoration-none text-danger mr-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                </svg>
                                            </a>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                    <p class="text-center text-muted">هیچ صفحه ای وجود ندارد.</p>
                                @endforelse
                            </table>
                            <section class="d-flex justify-content-center">
                                {{ $pages->render() }}
                            </section>
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
    function changeStatus(id){
        var element = $("#" + id)
        var url = element.attr('data-url')
        var elementValue = !element.prop('checked');

        $.ajax({
            url : url,
            type : "GET",
            success : function(response){
                if(response.is_draft){
                    if(response.checked){
                        element.prop('checked', true);
                        successToast('صفحه  با موفقیت فعال شد')
                    }
                    else{
                        element.prop('checked', false);
                        successToast('صفحه  با موفقیت غیر فعال شد')
                    }
                }
                else{
                    element.prop('checked', elementValue);
                    errorToast('هنگام ویرایش مشکلی بوجود امده است')
                }
            },
            error : function(){
                element.prop('checked', elementValue);
                errorToast('ارتباط برقرار نشد')
            }
        });
    }
</script>

<script type="text/javascript">
    function changeStatus1(id){
        var element = $("#" + id + '-access')
        var url = element.attr('data-url')
        var elementValue = !element.prop('checked');

        $.ajax({
            url : url,
            type : "GET",
            success : function(response){
                if(response.is_quick_access){
                    if(response.checked){
                        element.prop('checked', true);
                        successToast('دسترسی سریع با موفقیت فعال شد')
                    }
                    else{
                        element.prop('checked', false);
                        successToast('دسترسی سریع با موفقیت غیر فعال شد')
                    }
                }
                else{
                    element.prop('checked', elementValue);
                    errorToast('هنگام ویرایش مشکلی بوجود امده است')
                }
            },
            error : function(){
                element.prop('checked', elementValue);
                errorToast('ارتباط برقرار نشد')
            }
        });
    }
</script>

@include('admin.alerts.confirm')

@endsection