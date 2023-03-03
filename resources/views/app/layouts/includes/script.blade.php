<script src="https://vjs.zencdn.net/8.0.4/video.min.js"></script>
<!-- flowbit element -->
<script src="{{ asset("assets/app/js/flowbite.min.js") }}"></script>

<!-- tailwind element -->
<script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js"></script>

<!-- odometer -->
<script src="{{ asset("assets/app/js/jquery-3.6.3.min.js") }}"></script>
<script src="{{ asset("assets/app/plugins/appear/appear.js") }}"></script>
<script src="{{ asset("assets/app/plugins/odometer/odometer.min.js") }}"></script>

<!-- swiper -->
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

<script>
    function launch_toast() {
        var x = document.getElementById("toast")
        x.className = "show";
        setTimeout(function () {
            x.className = x.className.replace("show", "");
        }, 5000);
    }
</script>


<script>
    $(document).ready(function () {
        $.ajax({
            url: "https://prayer.aviny.com/api/prayertimes/490",
            dataType: "json",
            type: 'GET',
            success: function (data) {
                $("#div_test").append("اذان صبح: " + data.Imsaak + "<br/>");
                $("#div_tes1").append("طلوع آفتاب: " + data.Sunrise + "<br/>");
                $("#div_test2").append("اذان ظهر: " + data.Noon + "<br/>");
                $("#div_test3").append("غروب خورشید: " + data.Sunset + "<br/>");
                $("#div_test4").append("اذان مغرب: " + data.Maghreb + "<br/>");
                $("#div_test5").append("اوقات به افق: " + data.CityName + "<br/>");

            }
        });
    });
</script>
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


