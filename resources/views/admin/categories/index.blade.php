@extends('components.app')
@section('title', 'Category List')
@section('content')
 

    <div class="container">
        <div class="card mt-5">
            <h3 class="card-header p-3">DataTabels</h3>
            <div class="card-body">
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th width="100px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function () {
                
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('categories') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                error: function (xhr, error, thrown) {
                    console.error('Error in DataTables AJAX:', xhr.responseText);
                }
            });
                
        });
    </script>
@endsection