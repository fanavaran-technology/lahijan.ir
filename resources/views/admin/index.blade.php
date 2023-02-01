@extends('admin.layouts.app' , ['title' => 'داشبورد'])

@section('content')
<div class="row justify-content-center">
    <div class="col-12">
        <div class="row align-items-center mb-2">
            <div class="col">
                <h2 class="h5 page-title font-weight-bold">{{ auth()->user()->full_name }} خوش اومدی!</h2>
            </div>
        </div>


        <div class="row">

            <div class="col-md-12 col-lg-12">

            </div> <!-- Striped rows -->
        </div> <!-- .row-->
    </div> <!-- .col-12 -->
</div>
@endsection