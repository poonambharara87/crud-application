@extends('components.app')
@section('title', 'Brand List')
@section('content')

    <div class="container">
        <div class="card">
            <div class="card-body">
            <div class="d-flex justify-content-end mb-2">
                <button class="btn btn-success" id="createBrand" data-toggle="modal" data-target="#ajaxModel">Create Brand</button>
            </div>
            <table class="table table-bordered data-table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Detail</th>
                    <th scope="col">Handle</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
                </table>


                <div class="modal fade" id="ajaxModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalHeading">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="test_delete">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <form id="brandForm" name="brandForm">
                            @csrf
                            <input type="hidden" name="brand_id" id="brandId" value="">
                            <div class="form-group">
                                <label >Name</label>
                                <input type="text" class="form-control" id="brandName" value="" name="brand_name"  placeholder="name">
                            </div>
                            <div class="form-group">
                                <label>Detail</label>
                                <input type="text" class="form-control" id="brandDetail" value="" name="brand_detail" placeholder="name@example.com">
                            </div>
                            <div class="form-group">
                                <label >Status</label>
                                <select class="form-control" id="brandStatus" name="brand_status" >
                                <option class="form-control" value="Active">Active</option>
                                <option class="form-control"  value="Inactive">Inactive</option>
                                </select>
                            </div>
                            
                            <div class="col-sm-10">
                                <button type="submit" id="saveBtn" class="btn btn-success" value="create Brand">Create</button>
                            </div>
                            </form>
                        </div>
                       
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

        var table = $('.data-table').DataTable({
            processing:true,
            serverSide:true,
            ajax:"{{ route('brands.index') }}",
            columns:[
                {data:'id', name:'id'},
                {data:'name', name:'name'},
                {data:'detail', name:'detail'},
                {data:'action', name:'action', orderable:false, searchable:false},
            ]
        });


        $('#brandForm').submit(function(e){
            e.preventDefault();
            $('#modal-heading').html('Create Brand');
            $('#saveBtn').val('submit');
            $('#ajaxModel').modal('show');
            
            $('#brand-id').val('');

            let formData = new FormData(this);
            $.ajax({
                type:'POST',
                url:"{{ route('brands.store') }}",
                data: formData,
                processData:false,
                contentType:false,
                success:(response) => {
                    $('#saveBtn').html('Submit');
                    $('#ajaxModel').modal('hide');
                    $('#brandForm').trigger('reset');
                
                   
                    table.draw();
                },
                error:function(response){
                    // $('#')
                    console.log('response', response);
                }
            })
        });

        $('body').on('click', '.editBrand', function(e){
            e.preventDefault();
            var id = $(this).data('id');
            
            $.get("{{route('brands.index')}}" +'/' + id + '/edit', function(data){
                if (Array.isArray(data) && data.length > 0) {
                    let brand = data[0];
                // console.log('data', data)
                    $('#modalHeading').html('Edit Brand');
                    $('#ajaxModel').modal('show');
                    $('#saveBtn').html('edit-brand');
                    $('#brandId').val(brand.id);
                    $('#brandName').val(brand.name);
                    $('#brandDetail').val(brand.detail);
                    $('#brandStatus').val(brand.status);
                }
            });
        })

        $('body').on('click', '.deleteBrand', function(e){
            var id = $(this).data('id');
            
            confirm('Are you sure you want to delete')
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('brands.store') }}"+'/'+id,
                    success:function (data) {
                        table.draw();
                    },
                    error:function(data){
                        console.log('data', data);
                    }
                
            })
            
         
        });
        
    </script>
@endsection