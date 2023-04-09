@extends('app.clarification.layouts.app', ['title' => 'سامانه شفاف سازی - مناقصه و مزایده'])

@section('head-tag')
    <link rel="stylesheet" href="{{ asset('assets/app/plugins/datepicker/datepicker.min.css') }}">
@endsection


@section('content')
   <section class="min-h-screen px-20 py-10 ">
       <div class="container my-7">
           <p class="text-gray-800 text-xl text-center underline font-bold">مناقصه و مزایده</p>
       </div>
         <!-- news -->
       <section class="grid grid-cols-12 gap-6">
           @foreach ($allNews as $news)
               <section
                   class="col-span-12 sm:col-span-6 lg:col-span-4 rounded-lg flex justify-between flex-col {{ $news->is_pined ? 'relative bg-blue-50 border border-blue-400 skew-100' : 'bg-white' }} p-3 sm:p-4 md:p-6 shadow transition-all hover:shadow-lg mt-4">
                   @if ($news->is_pined)
                       <section class="absolute top-3 right-3 z-40">
                           <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-10 h-10 text-blue-600 border border-blue-600 skew-x-2 bg-white bg-opacity-75 rounded-full p-1"
                                fill="currentColor" class="bi bi-pin-angle" viewBox="0 0 16 16">
                               <path
                                   d="M9.828.722a.5.5 0 0 1 .354.146l4.95 4.95a.5.5 0 0 1 0 .707c-.48.48-1.072.588-1.503.588-.177 0-.335-.018-.46-.039l-3.134 3.134a5.927 5.927 0 0 1 .16 1.013c.046.702-.032 1.687-.72 2.375a.5.5 0 0 1-.707 0l-2.829-2.828-3.182 3.182c-.195.195-1.219.902-1.414.707-.195-.195.512-1.22.707-1.414l3.182-3.182-2.828-2.829a.5.5 0 0 1 0-.707c.688-.688 1.673-.767 2.375-.72a5.922 5.922 0 0 1 1.013.16l3.134-3.133a2.772 2.772 0 0 1-.04-.461c0-.43.108-1.022.589-1.503a.5.5 0 0 1 .353-.146zm.122 2.112v-.002.002zm0-.002v.002a.5.5 0 0 1-.122.51L6.293 6.878a.5.5 0 0 1-.511.12H5.78l-.014-.004a4.507 4.507 0 0 0-.288-.076 4.922 4.922 0 0 0-.765-.116c-.422-.028-.836.008-1.175.15l5.51 5.509c.141-.34.177-.753.149-1.175a4.924 4.924 0 0 0-.192-1.054l-.004-.013v-.001a.5.5 0 0 1 .12-.512l3.536-3.535a.5.5 0 0 1 .532-.115l.096.022c.087.017.208.034.344.034.114 0 .23-.011.343-.04L9.927 2.028c-.029.113-.04.23-.04.343a1.779 1.779 0 0 0 .062.46z"/>
                           </svg>
                       </section>
                   @endif
                   <a href="{{ $news->publicPath() }}" class="relative">
                       <img class="rounded-lg w-full h-44 object-cover" src="{{ asset($news->image) }}"
                            alt="{{ $news->title }}"/>
                       <h5 class="text-gray-900 text-base md:text-base lg:text-lg font-medium my-4">
                           {{ Str::limit($news->title, 100, '...') }}
                       </h5>
                       @if ($news->video)
                           <div
                               class="text-xs px-1 bg-indigo-400 text-gray-100 py-0.5 rounded absolute top-2 left-2 space-x-1 space-x-reverse flex">
                               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                   <path stroke-linecap="round"
                                         d="M15.75 10.5l4.72-4.72a.75.75 0 011.28.53v11.38a.75.75 0 01-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25h-9A2.25 2.25 0 002.25 7.5v9a2.25 2.25 0 002.25 2.25z" />
                               </svg>
                               <span>+ ویدئو</span>
                           </div>
                       @endif
                   </a>
                   <section class="flex justify-between items-center">
                       <div class="flex flex-col sm:flex-row justify-center items-center sm:space-x-4">
                           <img class="w-10 h-10 rounded-full object-cover"
                                src="{{ asset($news->user->profile_image) }}" alt="">
                           <div class="font-medium">
                               <div class="text-xs sm:text-sm text-gray-600 mx-2 text-center">
                                   {{ $news->user->full_name }}
                               </div>
                               <div class="text-gray-500 text-xs mx-2 font-sans">{{ jalaliDate($news->created_at, '%d %B، %Y') }}
                               </div>
                           </div>
                       </div>
                       <a href="{{ $news->publicPath() }}" class="flex items-center">
                            <span
                                class="text-green-600 text-sm sm:text-base transition-all hover:text-green-700 hover:mx-2">بیشتر
                                بخوانید</span>
                           <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mt-1     text-blue-500">
                               <path stroke-linecap="round" stroke-linejoin="round"
                                     d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18"/>
                           </svg>
                       </a>
                   </section>
                   </div>
               </section>

           @endforeach

       </section>
       <section class="overflow-x-hidden mt-10 flex justify-center">
           {{ $allNews->appends($_GET)->render('vendor.pagination.tailwind') }}
       </section>
   </section>

   <main>
       <div id="container" class="container">
       </div>
   </main>
   </section>

@endsection

@section('script')
    <script>
        new Viewer(document.getElementById('images'));
    </script>


@endsection


