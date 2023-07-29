@extends('app.clarification.layouts.app', ['title' => $salarySubject->title])

@section('content')
    <div class="container mt-14">
        <p class="text-gray-800 text-xl text-center underline font-bold">{{ $salarySubject->title }}</p>
        <p class="text-center mt-4 text-gray-600">{{ $salarySubject->description }}</p>
    </div>

    <div class="min-h-screen">
        <div class="relative container mt-16 overflow-x-auto sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 ">
                <thead class="text-xs text-center text-gray-700 uppercase bg-gray-50 border-b border-gray-500">
                    <tr>
                        <th scope="col " class="px-6 py-3">
                            نام
                        </th>
                        <th scope="col" class="px-6 py-3">
                            نام خانوادگی
                        </th>
                        <th scope="col" class="px-6 py-3">
                            تاریخ استخدام
                        </th>
                        <th scope="col" class="px-6 py-3">
                             حقوق دریافتی (ریال)
                        </th>

                    </tr>
                </thead>
                <tbody>
                    @forelse ($perssonelSalaries as $salary)
                        <tr class="bg-white border-b">
                            <td class="px-6 py-4 text-center">
                                {{ $salary->first_name }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ $salary->last_name }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ jalaliDate($salary->employment, '%d %B، %Y') }}
                            </td>
                            <td class="px-6 py-4 text-center font-sans">
                                {{ $salary->pivot->amount }} ریال
                            </td>
                        </tr>
                    @empty
                        <tr>
                            هیچ اطلاعاتی ثبت نشده است
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <section class="overflow-x-hidden mt-10 flex justify-center">
                {{ $perssonelSalaries->appends($_GET)->render('vendor.pagination.tailwind') }}
            </section>
        </div>
    </div>
@endsection
