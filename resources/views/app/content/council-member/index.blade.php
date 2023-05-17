@extends('app.layouts.app', ['title' => 'شهرداری لاهیجان | اعضا شورا'])


@section('content')
    <section class="container mt-5 min-h-screen">

        <div class="container my-7">
            <p class="text-gray-800 text-xl text-center underline font-bold">اعضاء شورای اسلامی شهر لاهیجان</p>
        </div>

        <div class="flex justify-center items-center">
            @foreach($bossCouncil as $boss)
            <div class="mt-5 group border-2 hover:border-gray-200 border-green-500 group rounded-lg  transition duration-500 ease-in-out transform hover:-translate-y-1 hover:shadow-lg">
                <img src="{{ asset($boss->image) }}" class="object-cover rounded-t-lg w-60 h-[270px] " alt="">
                <div class="flex justify-center w-full items-center group-hover:bg-green-400 w-40 h-14 bg-gray-200 rounded-b-lg transition duration-500 ease-in-out transform">
                       <div>
                           <div class="flex group-hover:text-white text-md font-bold justify-center items-center transition duration-500 ease-in-out transform">
                               <span>{{ $boss->full_name }}</span>
                           </div>
                           <div class="flex font-bold group-hover:text-white text-md justify-center transition duration-500 ease-in-out transform">
                               <span>{{ App\Models\Content\CouncilMember::REQUEST_TYPES[(int) $boss->type]}} </span>
                           </div>
                       </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="grid grid-cols-12 mt-10 gap-2">
            @foreach($councilMembers as $councilMember)
                <div class="flex justify-center col-span-12 sm:col-span-6 md:col-span-4 lg:col-span-4 px-5">
                    <div class="mt-5 group border-2 hover:border-gray-200 border-green-500 group rounded-lg  transition duration-500 ease-in-out transform hover:-translate-y-1 hover:shadow-lg">
                        <img src="{{ asset($councilMember->image) }}" class="object-cover rounded-t-lg w-60 h-[270px] " alt="">
                        <div class="flex justify-center w-full items-center group-hover:bg-green-400 w-40 h-14 bg-gray-200 rounded-b-lg transition duration-500 ease-in-out transform">
                            <div>
                                <div class="flex group-hover:text-white text-md font-bold justify-center items-center transition duration-500 ease-in-out transform">
                                    <span>{{ $councilMember->full_name }}</span>
                                </div>
                                <div class="flex font-bold group-hover:text-white text-md justify-center transition duration-500 ease-in-out transform">
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

