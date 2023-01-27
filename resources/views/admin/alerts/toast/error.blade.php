@if(session('toast-error'))
<script>
new Notify({
    status: 'error',
    title: 'خطا !',
    text: "{{session('toast-error')}}",
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
