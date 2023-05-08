
@foreach($bannerTheater as $theater)
<section class="">
    <a href="{{ route('theaters.index') }}">
        <img class="w-full md:h-[200px] h-[80px] object-cover rounded-lg" src="{{ asset($theater->image) }}" alt="">
    </a>
</section>
@endforeach


