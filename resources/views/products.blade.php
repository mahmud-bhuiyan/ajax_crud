@include('layout.header')

<div class="container my-5">
    <div class="table-responsive">
        <div class="d-flex justify-content-between">
            <h2>List of users</h2>
            <a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">A</a>
        </div>
        {{-- search --}}
        <input type="text" name="search" id="search" class="mt-3 form-control" placeholder="Seach here">
        <div class="table-data">
            <table
                class="table table-primary table-striped table-hover table-bordered text-center caption-top align-middle">
                <caption class="text-center" style="font-size: 25px;">List of users</caption>
                <thead class="table-info align-middle">
                    <tr>
                        <th style="width: 5%;">SL</th>
                        <th style="width: 20%;">Name</th>
                        <th style="width: 10%;">Price</th>
                        <th style="width: 20%;">Created At</th>
                        <th style="width: 20%;">Updated At</th>
                        <th style="width: 20%;">Action</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($products as $key => $product)
                        <tr>
                            <th>{{ $key + 1 }}</th>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->created_at->format('d-M-y h:i A') }}</td>
                            <td>{{ $product->updated_at->format('d-M-y h:i A') }}</td>
                            <td>
                                <a href="" class="btn btn-sm btn-primary update_product_form"
                                    data-bs-toggle="modal" data-bs-target="#updateProductModal"
                                    data-id="{{ $product->id }}" data-name="{{ $product->name }}"
                                    data-price="{{ $product->price }}"><i class="fa-regular fa-pen-to-square"></i></a>

                                <a href="" class="btn btn-sm btn-danger delete_product"
                                    data-id="{{ $product->id }}"><i class="fa-regular fa-trash-can"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="table-paginator container p-0 m-0">
                {!! $products->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
</div>

@include('product_add')
@include('product_update')
@include('product_js')
@include('layout.footer')
