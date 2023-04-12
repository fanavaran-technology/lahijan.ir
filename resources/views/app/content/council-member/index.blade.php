@extends('app.layouts.app', ['title' => 'شهرداری لاهیجان | اعضا شورا'])


@section('content')
    <section class="container mt-5 min-h-screen">

        <div class="container my-7">
            <p class="text-gray-800 text-xl text-center underline font-bold">اعضاء شورای اسلامی شهر لاهیجان</p>
        </div>

        <div class="flex justify-center items-center">
            @foreach($bossCouncil as $boss)
            <div class="mt-5 group bg-gray-200 rounded-md  transition duration-500 ease-in-out transform hover:-translate-y-1 hover:shadow-lg">
                <img src="{{ asset($boss->image) }}" class="object-cover rounded-t-lg border w-40 h-[200px]" alt="">
                <div class="flex justify-center items-center w-40 h-14 bg-gray-200 rounded-b-lg">
                       <div>
                           <div class="flex justify-center">
                               <span>{{ $boss->full_name }}</span>
                           </div>
                           <div class="flex justify-center">
                               <span>{{ App\Models\Content\CouncilMember::REQUEST_TYPES[(int) $boss->type]}} </span>
                           </div>
                       </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="grid grid-cols-12 mt-10 gap-5">
            @foreach($councilMembers as $councilMember)
                <div class="flex justify-center col-span-6 sm:col-span-6 md:col-span-4 lg:col-span-2 px-10">
                    <div class="mt-5 group bg-transparent rounded-md transition duration-500 ease-in-out transform hover:-translate-y-1 hover:shadow-lg">
                        <img src="{{ asset($councilMember->image) }}" class="object-cover rounded-t-lg border w-40 h-[200px]" alt="">
                        <div class="flex justify-center items-center w-40 h-14 bg-gray-200 rounded-b-lg">
                            <div>
                                <div class="flex justify-center">
                                    <span>{{ $councilMember->full_name }} </span>
                                </div>
                                <div class="flex justify-center">
                                    <span>{{ App\Models\Content\CouncilMember::REQUEST_TYPES[(int) $councilMember->type]}} </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>



    </section>
@endsection

@section('script')
    <script src="{{ asset('assets/app/plugins/datepicker/datepicker.min.js') }}"></script>
    <script>
        jalaliDatepicker.startWatch({
            maxDate: 'today',
            selector: ".datepicker",
            time: false
        });
    </script>

@endsection
