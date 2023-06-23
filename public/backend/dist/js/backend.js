$(document).ready(function () {
    console.log('abc');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#productsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/admin/products/get-data',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'category_id', name: 'category_id' },
            { data: 'image', name: 'image' },
            { data: 'origin_price', name: 'origin_price' },
            { data: 'sale_price', name: 'sale_price' },
            { data: 'discount_percent', name: 'discount_percent' },
            { data: 'content', name: 'content' },
            { data: 'action' },
        ]
    })
    $('#productsTable').on('click', '.btn-delete', function (e) {
        // e.preventDefault();
        var id = $(this).attr('data-id');
        $.ajax({
            type: 'delete',
            url: '/admin/products/' + id + '/delete',
            success: function (res) {
                if (!res.error) {
                    $('#productsTable').DataTable().ajax.reload();
                    toastr.success(res.message);
                }
            }
        })
    });
});
