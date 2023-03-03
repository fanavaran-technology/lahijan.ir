@extends('errors.layouts.app' )

@section('title' , 'صفحه مورد نظر یافت نشد'))

@section('content')
<selection class="flex min-h-screen justify-center">
    <section class="flex flex-col justify-center items-center">
        <h2 class="text-black text-4xl">404</h2>
        <h2 class="text-black text-3xl mt-10">صفحه مورد نظر یافت نشد!</h2>
        <h2 class="text-gray-600 text-lg mt-7">احتمالا صفحه مورد نظر شما حذف یا تغییر نام پیدا کرده است.</h2>
        <a href="{{ route('home') }}"
            class="bg-blue-500 hover:bg-green-500 cursor-pointer bg-transparent text-black border-2 border-green-500 font-bold py-2 px-4 rounded mt-7">
            بازگشت به صفحه اصلی
        </a>
    </section>
</selection>
@endsection
