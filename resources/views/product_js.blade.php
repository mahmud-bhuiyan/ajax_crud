<script>
    $(document).ready(function() {

        // Add Product Modal Js
        $(document).on('click', '.add_product', function(e) {
            e.preventDefault();
            let name = $('#name').val();
            let price = $('#price').val();
            // console.log(name+price);
            $.ajax({
                url: "{{ route('add.product') }}",
                method: 'post',
                data: {
                    name: name,
                    price: price
                },
                success: function(res) {
                    if (res.status == 'success') {
                        $('#addProductModal').modal('hide');
                        $('#addProductForm')[0].reset();
                        $('.table-data').load(location.href + ' .table-data');
                        // $('.table').load(location.href + ' .table');
                    }
                }
            });
        });

        // Update Product Modal Js
        $(document).on('click', '.update_product_form', function() {

            let id = $(this).data('id');
            let name = $(this).data('name');
            let price = $(this).data('price');

            $('#update_id').val(id);
            $('#update_name').val(name);
            $('#update_price').val(price);

            // update product data
            $(document).on('click', '.update_product', function(e) {
                e.preventDefault();
                let update_id = $('#update_id').val();
                let update_name = $('#update_name').val();
                let update_price = $('#update_price').val();
                // console.log(name+price);

                $.ajax({
                    url: "{{ route('update.product') }}",
                    method: 'post',
                    data: {
                        update_id: update_id,
                        update_name: update_name,
                        update_price: update_price
                    },
                    success: function(res) {
                        if (res.status == 'success') {
                            $('#updateProductModal').modal('hide');
                            $('#updateProductForm')[0].reset();
                            $('.table-data').load(location.href + ' .table-data');
                        }
                    }
                });
            });
        });

        // delete Product Modal Js
        $(document).on('click', '.delete_product', function(e) {
            e.preventDefault();
            let product_id = $(this).data('id');

            if (confirm('Are you sure you want to delete this product?')) {
                $.ajax({
                    url: "{{ route('delete.product') }}",
                    method: 'post',
                    data: {
                        product_id: product_id
                    },
                    success: function(res) {
                        if (res.status == 'success') {
                            $('.table-data').load(location.href + ' .table-data');
                        }
                    }
                });
            }
        });

        // pagination
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1]
            product(page)
        });

        function product(page) {
            $.ajax({
                url: "/pagination/paginate-data?page=" + page,
                success: function(res) {
                    $('.table-data').html(res);
                }
            });
        }

        // product search
        $(document).on('keyup', function(e) {
            e.preventDefault();
            let search_string = $('#search').val();

            $.ajax({
                url: "{{ route('search.product') }}",
                method:'GET',
                data:{search_string:search_string},
                success: function(res) {
                    $('.table-data').html(res);
                }
            });
        });

    });
</script>
