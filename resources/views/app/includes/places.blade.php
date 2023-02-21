<div class="p-10  flex items-center justify-center flex-wrap gap-3  ">
    <div
        class="grid lg:grid-cols-3 md:grid-cols-2 sm:col-span-2 lg:gap-20 md:gap-x-10 md:gap-y-36 sm:gap-x-20 gap-20">
        @foreach($places as $place)
        <div class='font-yekan col-span-1 flex flex-wrap justify-center  '>
            <div class='flex flex-row  justify-center'>
                <div class='h-[450px] w-80 relative

       '>
                    <input type='checkbox'
                           class='cursor-pointer transition-all duration-100
                appearance-none peer  h-full w-full shadow-[0_0_10px_rgba(0,0,0,0.8)]
          checked:shadow-none rounded-xl
           '/>
                    <div
                        class='image-wrapper absolute w-full h-full top-0 left-0 0
               pointer-events-none   transition-all duration-1000
               overflow-hidden rounded-xl
           '>
                        <div style="background-image: url({{ $place->image}})"
                             class='relative h-full transition-all  duration-700 bg-cover image-wrapper bg-right rounded-xl'>
                        </div>
                    </div>
                    <div
                        class='absolute w-full h-full top-0 pointer-events-none flex flex-col rounded-xl checked:text-black'>
                        <div class='flex flex-row  justify-center w-full h-60  py-12 '>
                            <p class="text-white font-bold text-lg z-50 inline-block opacity-95">---{{ $place->title }}---
                            </p>
                        </div>
                        <div class="flex bg-black/50 h-14 w-72 items-center mt-16">
                            <svg class="text-white mr-3" xmlns="http://www.w3.org/2000/svg" width="18"
                                 height="18" fill="currentColor" class="bi bi-pin-map-fill"
                                 viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                      d="M3.1 11.2a.5.5 0 0 1 .4-.2H6a.5.5 0 0 1 0 1H3.75L1.5 15h13l-2.25-3H10a.5.5 0 0 1 0-1h2.5a.5.5 0 0 1 .4.2l3 4a.5.5 0 0 1-.4.8H.5a.5.5 0 0 1-.4-.8l3-4z"/>
                                <path fill-rule="evenodd"
                                      d="M4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999z"/>
                            </svg>
                            <h2 class='text-gray-100 font-bold text-sm mx-3'>{{$place->location}}</h2>
                        </div>
                    </div>
                    <div
                        class='bg-black/30 h-full w-full absolute top-0 pointer-events-none
           peer-checked:scale-95 ransition-all duration-300 peer-checked:bg-black/0 rounded-xl'>
                    </div>
                    <a href="#"
                       class="flex mt-3 font-bold text-sm text-cyan-700 text-center justify-center">+ اطلاعات کلی
                        ...</a>
                </div>

            </div>

        </div>
        @endforeach


        <!-- end bomm gardy -->
    </div>

</div>
<section class="mt-4 flex  flex-col items-center space-y-2">
    <button
        class="hover:bg-gradient-to-r from-[#58A4C4] to-[#307091] bg-[#307091] w-80 hover:bg-blue-700 text-gray-100 font-bold py-2 px-4 rounded-xl ">
        مناطق گردشگری بیشتر
    </button>
</section>
