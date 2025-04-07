@extends('components.app')
@section('title', 'Posts')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-end">
                    <button class="btn btn-success mb-2" data-bs-toggle="modal" data-bs-target="#ajaxModal">Create Post</button>
                </div>
            <table class="table table-bordered border-primary data-table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Images</th>
                        <th scope="col">Handle</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                    </tr>
                    <tr>
                    <th scope="row">3</th>
                    <td colspan="2">Larry the Bird</td>
                    <td>@twitter</td>
                    </tr> -->
                </tbody>
            </table>

            <div class="modal fade" id="ajaxModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="postForm" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" name="title" id="title" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <input type="text" name="description" class="form-control" id="description">
                            </div>
                            <div class="mb-3">
                                <label for="images" class="form-label">Images</label>
                                <input type="file" name="files[]" multiple class="form-control" id="images">
                            </div>
                            <div class="mb-3">
                            <select class="form-select form-select-lg mb-3" name="status" aria-label=".form-select-lg example">
                                <option selected>Status</option>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                            </div>
                            <button type="submit" class="btn btn-primary" value="create-post" name="submit">Submit</button>
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
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        })
        var table = $('.data-table').DataTable({
                processing:true,
                serverSide:true,
                ajax:"{{ route('posts.index') }}",
                columns:[
                    {data:'id', name: 'id'},
                    {data:'title', name:"title"},
                    {data:'description', name:"description"},
                    {data:'images', name:"images"},
                    {data:'status', name:"status"},
                    {data:'action', name:"action", orderable:false, searchable:false}
                ]
            });
            $(document).ready(function(){

        
      
        });
           
    </script>
@endsection