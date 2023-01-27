
<script>
    $(document).ready(function () {
        let element = $('.delete');

        element.on('click', function (e) {
            e.preventDefault();
            const form = $(this).parent();
            $.confirm({
                title: 'تایید کنید',
                content: 'آیتم انتخاب شده حذف شود ؟!',
                autoClose: 'cancelAction|8000',
                theme: 'bootstrap',
                type: 'red',
                buttons: {
                    deleteUser: {
                        text: 'بله ، حذف شود',
                        btnClass : 'btn-danger',
                        action: function () {
                            form.submit();
                        }
                    },
                    cancelAction: {
                        text: 'نه منصرف شدم',
                        action : function() {
                            new Notify({
                                status: 'error',
                                title: 'انصراف',
                                text: "درخواست حذف لغو شد",
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
                        }
                    }
                }
            }); 
        })
    })

</script>