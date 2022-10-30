@extends('layout.layout')
@section('main-content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="row mt-4 mr-2">
                <div class="col-md-12 text-right" title="Add New User">
                    <a href='/user/product/create' class='btn-primary btn-sm'>
                        <i class='fa fa-plus' aria-hidden='true'></i>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table id="datatable-products" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Category</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
@endsection
@section('script')
<script>
    $(document).ready(function() {
        var DTable = $("#datatable-products").DataTable({
            searching: true,
            processing: true,
            serverSide: true,
            responsive: true,
            stateSave: true,
            dom: 'frtip',
            ajax: "{{ route('product.list') }}",
            columns: [{
                    "data": 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'quantity',
                    name: 'quantity'
                },
                {
                    data: 'price',
                    name: 'price'
                },
                {
                    data: 'category.name',
                    name: 'category.name'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });
    });
    function deleteProduct(id){
        event.preventDefault();
        let yes = window.confirm('Are you sure to delete?');
        if (yes){
            $.ajax({
                url: `/user/product/${id}`,
                type: 'DELETE',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(result) {
                }
            });
            location.reload();
        }
    }
</script>
@endsection
