@extends('layout.master')
@section('page-css')

@endsection
@section('content')
    @include('admin.includes.breadcrumb')
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Books</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{route('product.create')}}" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
                <i class="btn-icon-prepend" data-feather="plus-square"></i>
                Add New
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title"> </h6>
                    <div class="table-responsive">
                        <table id="datatables" class="table">
                            <thead>
                            <tr>
                                <th> SL</th>
                                <th>Title</th>
                                <th>Image</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th class="disabled-sorting text-right">Actions</th>
                            </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page-js')
    <script>
        $(document).ready(function() {
            $('#datatables').DataTable({
                "aLengthMenu": [
                    [10, 30, 50, -1],
                    [10, 30, 50, "All"]
                ],
                "iDisplayLength": 10,
                "language": {
                    search: ""
                },
                processing: true,
                serverSide: true,
                ajax: '{{route('product.data')}}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'title', name: 'title'},
                    {data: 'featured_image_url', name: 'featured_image_url'},
                    {data: 'price', name: 'price'},
                    {data: 'stock', name: 'stock'},
                    {data: 'action', name: 'action'}
                ]
            });
        });

        function deleteData(rowid) {
            let url = '{{ route("product.destroy", ":id") }}';
            url = url.replace(':id', rowid);
            swal.fire({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        axios.delete(url).then(res => {
                            if(res.data == 'success'){
                                swal.fire({
                                    icon: "success",
                                    button: false,
                                    timer: 1000,
                                });
                                $('#datatables').DataTable().ajax.reload( null, false );
                            }
                        });
                    } else {
                        swal("Your imaginary file is safe!");
                    }
                });
        }
    </script>
@endsection