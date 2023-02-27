@extends('app.clarification.layouts.app', ['title' => $contract->title])

@section('content')
    <div class="container mt-14">
        <p class="text-gray-800 text-xl font-bold">{{ $contract->title }}</p>
        <p class="text-center mt-4 text-gray-600">{{ $contract->description }}</p>
    </div>

    <div class="min-h-screen">
        <div class="relative container mt-6 overflow-x-auto sm:rounded-lg space-x-4 space-x-reverse">
            <span class="font-bold"> تاریخ قرار داد : &nbsp;</span>{{ jalaliDate($contract->contract_date ) }}
            <span class="font-bold"> پیمانکار : &nbsp;</span>{{ $contract->contractor }}
        </div>
        <div class="container mt-8 mb-16">
            {!! $contract->detail !!}
        </div>
    </div>
@endsection
