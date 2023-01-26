@extends('admin.layouts.app', ['title' => 'همه اسلایدر ها'])

@section('content')
    <div class="row justify-content-center">
        <div class="col">
            <h2 class="h3 mb-0 page-title">اسلایدر</h2>
        </div>
        <div class="col-auto">
            <a href="{{ route('admin.content.sliders.create') }}" type="button" class="btn btn-primary px-4">ایجاد</a>
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
                                        <a class="col-md-3  type="text">همه اسلایدر ها</a>
                                    </div>
                                    <th>#</th>
                                    <th>عناوین</th>
                                    <th>وضعیت انتشار</th>
                                    <th>فعال / غیرفعال</th>
                                    <th>تاریخ انتشار</th>
                                    <th>عملیات</th>
                                    </tr>
                                </thead>
                                @forelse($sliders as $slider)    
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <small>{{ Str::limit($slider->alt, 60, '...') }}</small>
                                    </td>
                                    <td>
                                        انتشار شده
                                    </td>
                                    <td>
                                        <label>
                                            <input id="{{ $slider->id }}" onchange="changeStatus({{ $slider->id }})" data-url="{{ route('admin.content.sliders.status', $slider->id) }}" type="checkbox" @if ($slider->status === 1)
                                            checked
                                            @endif>
                                        </label>
                                    </td>
                                    <td>{{ $slider->published_at }}</td>
                                    <td>
                                        <a href="#" class="text-decoration-none text-danger"><i
                                                class="fe fe-x-circle fe-24 mr-1"></i></a>
                                                
                                        <a href="{{ route('admin.content.sliders.edit' , $slider->id) }}" class="text-decoration-none text-success"><i
                                                class="fe fe-edit fe-24 mr-1"></i></a>

                                        <a href="#" class="text-decoration-none text-primary-light"><i
                                                class="fe fe-eye fe-24 mr-1"></i></a>
                                    </td>
                                </tr>
                                @empty
                                    <p class="text-center text-muted">هیچ خبری وجود ندارد.</p>
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

<script type="text/javascript">

    function changeStatus(id){
        var element = $("#" + id)
        var url = element.attr('data-url')
        var elementValue = !element.prop('checked');

        $.ajax({
            url : url,
            type : "GET",
            success : function(response){
                if(response.status){
                    if(response.checked){
                        element.prop('checked', true);
                        successToast('بنر  با موفقیت فعال شد')
                    }
                    else{
                        element.prop('checked', false);
                        successToast('بنر  با موفقیت غیر فعال شد')
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

        function successToast(message){

            var successToastTag = '<section class="toast" data-delay="5000">\n' +
                '<section class="toast-body py-3 d-flex bg-success text-white">\n' +
                    '<strong class="ml-auto">' + message + '</strong>\n' +
                    '<button type="button" class="mr-2 close" data-dismiss="toast" aria-label="Close">\n' +
                        '<span aria-hidden="true">&times;</span>\n' +
                        '</button>\n' +
                        '</section>\n' +
                        '</section>';

                        $('.toast-wrapper').append(successToastTag);
                        $('.toast').toast('show').delay(5500).queue(function() {
                            $(this).remove();
                        })
        }

        function errorToast(message){

            var errorToastTag = '<section class="toast" data-delay="5000">\n' +
                '<section class="toast-body py-3 d-flex bg-danger text-white">\n' +
                    '<strong class="ml-auto">' + message + '</strong>\n' +
                    '<button type="button" class="mr-2 close" data-dismiss="toast" aria-label="Close">\n' +
                        '<span aria-hidden="true">&times;</span>\n' +
                        '</button>\n' +
                        '</section>\n' +
                        '</section>';

                        $('.toast-wrapper').append(errorToastTag);
                        $('.toast').toast('show').delay(5500).queue(function() {
                            $(this).remove();
                        })
        }
    }
</script>

@endsection
