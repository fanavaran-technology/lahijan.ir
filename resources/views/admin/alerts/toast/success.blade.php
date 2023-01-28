@if(session('toast-success'))
{{-- <script>
new Notify({
    status: 'success',
    title: 'موفقیت آمیز !',
    text: "{{session('toast-success')}}",
    effect: 'slide',
    speed: 300,
    customClass: null,
    customIcon: null,
    showIcon: true,
    showCloseButton: true,
    autoclose: true,
    autotimeout: 3000,
    gap: 20,
    speed: 700,
    distance: 20,
    type: 1,
    position: 'left top'
})
</script> --}}

<section class="toast" data-delay="5000">

    <section class="toast-body py-3 d-flex bg-success text-white">
        <strong class="ml-auto">{{ session('toast-success') }}</strong>
        <button type="button" class="mr-2 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
    </section>
</section>

<script>
    $(document).ready(function () {
        $('.toast').toast('show');
    })
</script>

@endif
