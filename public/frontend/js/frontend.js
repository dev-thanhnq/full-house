$(document).ready(function () {
    $('.header-drop').mouseenter(function () {
        $(this).addClass("open")
    });
    $('.header-drop').mouseleave(function () {
        $(this).removeClass("open")
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(".item-qty").change(function () {
        let id = $(this).attr('data-id');
        let qty = $(this).val();
        $.ajax({
            type: 'PUT',
            url: '/cart/update/' + id,
            data: {
                qty: qty
            },
            success: (res) => {
                if(!res.error){
                    location.reload();
                }
            }
        })
    });
});
