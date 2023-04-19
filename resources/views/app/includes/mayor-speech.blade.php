
@foreach($mayorSpeech as $mayor)
    <section class="md:px-[180px] px-20 pb-10">
        <div class="rounded-md bg-white border border-green-500 h-60  mt-12 border-gray-800 shadow-sm transition duration-500 ease-in-out transform hover:-translate-y-1 hover:shadow-lg">
            <div class="lg:flex px-4 leading-none max-w-4xl">
                <div class="flex-none ">
                    <img src="{{ asset($mayor->image) }}" alt="pic"
                         class="h-60 w-[190px] rounded-md transform -translate-y-5 border-2 object-cover border-gray-200 shadow-lg" />
                </div>
                <div class="flex-col md:mr-4 mr-1 pb-5 text-gray-300">
                    <p class="md:pt-4 pt-1 md:text-2xl text-gray-700 text-center flex font-bold mr-3 md:mt-9">سخن شهردار :
                        {{$mayor->full_name}}</p>
                    <p class=" md:block font-bold text-gray-600 px-4 my-4 text-xl mt-7">{{ $mayor->description }}</p>
                </div>
            </div>
        </div>
    </section>
@endforeach


