@if(session('toast-success'))
<script>
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
</script>
@endif
