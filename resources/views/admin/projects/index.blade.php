@extends('components.app')
@section('title', 'Practice 1')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
            <div class="d-flex justify-content-end">
                <button class="btn btn-success mb-2" data-toggle="modal" data-target="#ajaxModel" id="createNewStaff">+ Create Staff</button>
            </div>

            <table class="table table-bordered data-table">

                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Handle</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="ajaxModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="model-heading">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form id="userForm" name="userForm">
                    @csrf
                    <input type="hidden" name="product_id" id="user_id" >
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" id="userName" placeholder="Kushal">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Email address</label>
                        <input type="email" name="email" class="form-control" id="userEmail" placeholder="name@example.com">
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleFormControlSelect2">Status</label>
                        <select multiple class="form-control" name="status" id="userStatus">
                        <option class="form-control"  value="Active">Active</option>
                        <option class="form-control"  value="Inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="col-sm-offset-2 col-sm-10">
                        
                        <button type="submit" class="btn btn-primary" id="savebtn" value="create">Create</button>
                    </div>
                </form>
                </div>
               
            </div>
        </div>
    </div>
    
    <script>

        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#createNewStaff').click(function(){
            $('#saveBtn').val('create-User');
            $('#userForm').trigger('reset');
            $('#user_id').val('');
            $('#model-heading').html("<i class='fa fa-plus'></i>Create User")
            $('#ajaxModel').modal('show');

        });
        
        var table = $('.data-table').DataTable({
            processing:true,
            serverSide:true,
            ajax:"{{ route('users.index') }}",
            columns:[
                { data:'id', name:'id'},
                { data:'name', name:'name'},
                { data:'email', name:'email'},
                { data:'action', name:'action', orderable:true, searchable:true}
            ]
        });


        $('#userForm').submit(function(e){
            e.preventDefault();
            $('#saveBtn').html('Sending...'); 
            let formData = new FormData(this);

            $.ajax({
                type:'POST',
                url:"{{route('users.store')}}",
                data:formData,
                contentType:false,
                processData:false,
                success:(response) => {
                    $('#saveBtn').html('Submit');
                    $('#userForm').trigger('reset');
                    $('#ajaxModel').modal('hide');
                    table.draw();
                },
                error:function(response){
                    console.log('xhr', xhr);
                }
            });
        })

        $('body').on('click', '.editUser', function(){
            var user_id = $(this).data('id');
            $.get("{{route('users.index')}}" + '/' + user_id + '/edit', function(data){
                $('#model-heading').html('Edit User');
                $('#ajaxModel').modal('show');
                $('#savebtn').html('edit-user');
                $('#user_id').val(data.id);
                $('#userName').val(data.name);
                $('select[name="status"]').val(data.status);
                $('#userEmail').val(data.email);

            });
        });

        $('body').on('click', '.deleteUser', function(){
            
            var id = $(this).data('id');
            confirm('Are you sure want to delete ? ');
            $.ajax({
                type:'DELETE',
                url:"{{route('users.store')}}"+ '/' +id,
                success:function(data){
                    table.draw();
                }
            });
        });
        
    </script>
    @push('scripts')
        <link r3el="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
        <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
        <script src="/vendor/datatables/buttons.server-side.js"></script>
       
    @endpush
@endsection