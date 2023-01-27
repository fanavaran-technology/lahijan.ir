@if(session('toast-warning'))
<script>
new Notify({
    status: 'warning',
    title: 'خطا !',
    text: "{{session('toast-warning')}}",
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
</script>
@endif
