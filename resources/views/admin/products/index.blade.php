@extends('components.app')
        @section('title', 'Product List')
        @section('content')
        
        <button class="addButton" id="addProducts">Add Product</button>
        <table class="table position-relative " >
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Image</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            @if(isset($products) && $products->count() > 0)
                
                @foreach($products as $product)
                    <tr >
                        <td scope="row" >{{$product->id}}</td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->status}}</td>
                        <td><img  width="50px" src="https://www.google.com/logos/doodles/2025/nowruz-2025-6753651837110627-2x.png" alt="image"></td>
                        <td>
                            <form action="{{route('products.destroy', $product->id)}}" method="POST">
                                <!-- <a class="btn btn-info btn-sm" id="showProduct" data-showid="{{$product->id}}" href=""><i class="fa-solid fa-list"></i> Show</a> -->
                                <a class="btn btn-primary btn-sm" id="editProduct" data-id="{{$product->id}}" href="#"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm delete-btn" data-id="{{$product->id}}"><i class="fa-solid fa-trash"></i> Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach 
                
            @endif
            </tbody>
            <div class="modal w-25 p-3 position-absolute  top-0 start-50 translate-middle-x"  style="background-color: #eee;" id="product_Form">
                <form action="" id="ajaxForm" enctype="multipart/form-data">
                    @csrf   
                    <input type="hidden" name="product_id" value="{{($product->id ?? '') }}" id="productId">
                    <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>
                    <h4 class="text-center mb-4" id="product_heading">Add Product</h1>
                    
                    <div class="mb-3">
                        <label for="name">Name</label>
                        <input type="name" name="product_name" id="productName" class="form-control"  aria-describedby="nameHelp">
                    </div>
                   
                    <div class="mb-3">
                        <label for="name">Choose Profile</label>
                        <input type="file" name="files[]" multiple id="productImages" class="form-control" aria-describedby="nameHelp">
                        <div id="imageContainer">
                            <!-- Images will be appended here -->
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <select class="form-select" name="category" id="productCategory" aria-label="Default select example">
                            <option >Open this select menu</option>
                            @if(isset($categories) && $categories->count() > 0)
                                
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <select class="form-select" name="status" id="productStatus" aria-label="Default select example">
                            <option >Status</option>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
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
            $('#addProducts').click(function(){         
                $('#product_Form').toggle('slow');
                $('#product_heading').text('Add Product');
            });
                   
                $('#ajaxForm').submit(function(e){
                    e.preventDefault();
                    let formData = new FormData(this);

                    $.ajax({
                        type:'POST',
                        url: "{{route('products.store')}}",
                        data: formData,
                        contentType:false,
                        processType:false,
                        success:(response) => {
                            alert('submitted');
                        }
                });  
            });

          

        
            

            $(document).on('click', '#editProduct', function(e) {
                e.preventDefault();
                
                var id = $(this).data('id');
              
                getRecord(id);
                $('#product_Form').toggle('slow');
                $('#product_heading').text('Edit Product');
               
            });


            function getRecord(id){
                $.get("/products/" + id + "/edit", function(data) {

                    $('#product_id').val(data.id);
                    // productName productImages productCategory productStatus
                    $('#productName').val(data.name);
                    
                    const imageContainer = $("#imageContainer");
                    var images = data.images; 
                    
                    for (let i = 0; i < images.length; i++) {
                        
                        const img = $("<img>").attr("src", `{{ asset('/uploads/')}}`+'/'+images[i].name);
                        imageContainer.append(img);
                    }

                    $('select[name="category"]').val(data.category_id);
                    $('select[name="status"]').val(data.status);
                    $('#product_heading').text('Edit Product');
                    $('#add_product').show(); // Show modal
                });
            }
        });


        document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                let productId = this.getAttribute('data-id');
                if (confirm("Are you sure you want to delete this product?")) {
                    document.getElementById(`deleteForm-${productId}`).submit();
                }
            });
        });
    });
        </script>
        @endsection

    