@extends('errors.layouts.app' )

@section('title' , 'خطای سرور داخلی'))

@section('content')
<selection class="flex min-h-screen justify-center">
    <section class="flex flex-col justify-center items-center">
        <h2 class="text-black text-4xl">500</h2>
        <h2 class="text-black text-3xl mt-10">خطای سرور داخلی</h2>
        <a href="{{ route('home') }}" class="bg-blue-500 hover:bg-green-500 cursor-pointer bg-transparent text-black border-2 border-green-500 font-bold py-2 px-4 rounded mt-7">
            بازگشت به صفحه اصلی
        </a>
    </section>
</selection>
@endsection
