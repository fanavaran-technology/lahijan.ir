@extends('admin.layouts.app' , ['title' => 'داشبورد'])

@section('content')
<div class="row justify-content-center">
    <div class="col-12">
        <div class="row align-items-center mb-2">
            <div class="col">
                <h2 class="h5 page-title font-weight-bold">خوش آمدید!</h2>
            </div>
        </div>


        <div class="row">

            <div class="col-md-12 col-lg-12">
                <div class="card shadow">
                    <div class="card-header">
                        <strong class="card-title">آخرین اخبار</strong>
                        <a class="float-right small text-muted" href="#!">نمایش همه</a>
                    </div>
                    <div class="card-body my-n2 table-responsive">
                        <table class="table   table-hover table-borderless"
                            style="overflow-x: scroll; white-space: nowrap;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th class="w-25">عنوان</th>
                                    <th>تاریخ</th>
                                    <th>تعداد بازدید</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>2474</td>
                                    <th> بافت های تاریخی و فرسوده یکی از مهم ترین مباحث مدیریت شهری است
                                    </th>
                                    <td>۱۴۰۱/۱۰/۱۵</td>
                                    <td>۱۵</td>
                                    <td>
                                        <a href="#" class="text-decoration-none text-danger"><i
                                                class="fe fe-x-circle fe-24"></i></a>
                                        <a href="#" class="text-decoration-none text-success"><i
                                                class="fe fe-edit fe-24"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- Striped rows -->
        </div> <!-- .row-->
    </div> <!-- .col-12 -->
</div>
@endsection