@extends('components.app')
        @section('title', 'Product List')
        @section('content')
       
        <table class="table position-relative table-striped-columns" >
            <thead>
                <tr>
                    <button class="mb-6 addButton " id="test">Add Product</button>

                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Image</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            @if(isset($products) && $products->count() > 0)
                <tr>
                @foreach($products as $product)
                    <td scope="row" >{{$product->id}}</td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->status}}</td>
                    <td><img  width="50px" src="https://www.google.com/logos/doodles/2025/nowruz-2025-6753651837110627-2x.png" alt="image"></td>
                    <td>
                        <form action="{{route('products.destroy', $product->id)}}" method="POST">
                            <a class="btn btn-info btn-sm" href="{{route('products.show', $product->id)}}"><i class="fa-solid fa-list"></i> Show</a>
                            <a class="btn btn-primary btn-sm" id="editProduct" href="{{route('products.edit', $product->id)}}"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i> Delete</button>
                        </form>
                    </td>
                @endforeach 
                </tr>
            @endif
            </tbody>
            <div class="modal w-25 p-3 position-absolute  top-0 start-50 translate-middle-x"  style="background-color: #eee;" id="add_product">
                <form action="{{route('products.store')}}" method="POST" id="ajaxForm" enctype="multipart/form-data">
                    @csrf   
                    <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>
                    <h4 class="text-center mb-4" data-product_heading="">Add Product</h1>
                    
                    <div class="mb-3">
                        <label for="name">Name</label>
                        <input type="name" name="username" data-name="" class="form-control" id="exampleInputName1" aria-describedby="nameHelp">
                    </div>
                    product_heading, name
                    <div class="mb-3">
                        <label for="name">Choose Profile</label>
                        <input type="file" name="files[]" multiple data-files="" class="form-control" aria-describedby="nameHelp">
                    </div>
                    <div class="mb-3">
                        <select class="form-select" name="category" aria-label="Default select example">
                            <option >Open this select menu</option>
                            @if(isset($categories) && $categories->count() > 0)
                                {{$categories}}
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                         
                    <div class="mb-3">
                        <select class="form-select" name="status" data-status="" aria-label="Default select example">
                            <option >Status</option>
                            <option value="1">Active</option>
                            <option value="2">Inactive</option>
                        </select>
                    </div>
                   
                    
                    <button class="btn btn-success" type="submit">Submit</button>

                </form>
            </div>
        </table>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        
      <script type="text/javascript">
        $(document).ready(function (){
            $('#test').click(function(){
                $('#add_product').toggle('slow');
            });

            $('#ajaxForm').submit(function(e){
                e.preventDefault();
                var url = $(this).attr("action");
                let formData = new FormData(this);

                $.ajax({
                    type:'POST',
                    url:url,
                    data:formData,
                    contentType:false,
                    processData:false,
                    success:(response) => {
                        alert('Form submitted successfully!');
                        console.log('response', response);
                        location.reload();
                    },
                    error:function(response){
                        $('#ajaxForm').find('.print-error-msg').find('ul').html('');
                        $('#ajaxForm').find('.print-error-msg').css('display','block');
                        $.each(response.responseJson.errors, function(key, value){
                            $('#ajaxForm').find('.print-error-msg').find('ul').append('<li>'+value+'</li>')
                        });
                    }
                });
            });

            $('#editProduct').click(function(e){
                $('#add_product').toggle('slow');
                $('$ajaxForm')
            });
        });
        </script>
        @endsection

    