<div class="md:flex hidden h-auto p-4  bg-black">
    <div class="container flex flex-wrap items-center justify-between mx-auto">
        <span class="text-white z-50 mr-2 font-bold text-center items-center">
            تیتر جدید ترین خبر : <span class="font-normal text-sm">
                <div id="featured-slider" class="mt-2 text-right ">
                    <div id="slider" class="ml-7">
                        @foreach ($latestNewsHeader as $news )
                        <div class="slide">
                            <a href="{{ $news->publicPath() }}">{{ Str::limit($news->title, 70,'...')  }}</a>
                        </div>
                        @endforeach

                    </div>
                </div>
            </span>
        </span>
        <span style="font-family: iransans" class="text-white ml-2  items-end">
            {{ jalaliDate(date('Y-m-d')) }}
        </span>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
// BLOG TEXT SCRİPT
$(document).ready( function() {
    var i = 0;
    var tumyukseklik = 0;
    var yukseklik = $('#slider .slide').height();
    $('#slider').css('height', ($('#slider .slide').length * yukseklik));
    function animasyon(px){
        $('#slider').stop(false, false).animate({
            top: -px
        }, 300);
    }

    $('#sayfalama a').click(function(){
        var index = $(this).index();
        pozisyon = index * yukseklik;
        animasyon(pozisyon);
        if(index == $('#slider .slide').length - 1){
            i = 0;
        }else{
            i = index + 1;
        }
        return false;
    });

    var zamanlayici = setInterval(function() {
        tumyukseklik = i * yukseklik;
        if(i == $('#slider .slide').length - 1){
            i = -1;
        }
        animasyon(tumyukseklik);
        i++;
    }, 3000);
});
</script>

