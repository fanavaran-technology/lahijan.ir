@foreach ($mayorSpeech as $mayor)
    <div id="mayor" style="margin-top: 3rem !important">
        <div
        class="rounded-md border bg-gradient-to-r bg-white  border-indigo-500 border-dotted shadow-sm transition duration-500 ease-in-out transform hover:-translate-x-0.5 hover:shadow-md">
        <div class="px-4 leading-none">
            <div class="w-full flex justify-center my-4">
                <img src="{{ asset($mayor->image) }}" alt="pic"
                    class="h-44 w-44 rounded-full border-2 object-cover border-gray-200 shadow-lg" />
            </div>
            <div class="flex-col w-full  mr-1 pb-5 text-gray-300 text-center mt-4">
                <div class="text-indigo-500 text-xl md:text-2xl lg:text-3xl">سخن شهردار</div>
                <div class="md:pt-4 pt-1 md:text-2xl text-gray-700 text-center font-bold mt-3">
                    {{ $mayor->full_name }}</div>
                <p class=" text-justify leading-6 text-gray-600 px-4 my-4 text-sm text-md mt-7">
                    {{ $mayor->description }}</p>
            </div>
        </div>
    </div>
    </div>
@endforeach
