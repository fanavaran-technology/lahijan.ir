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


