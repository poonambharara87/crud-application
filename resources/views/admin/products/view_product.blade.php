<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Form</title>
  </head>
  <body>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <select class="form-select" id="parentCategory" aria-label="Default select example">
                            <option selected>Open this select Category</option>
                            @foreach($parent_category as $category)
                                <option value="{{ $category->parent_id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                     <div class="col-md-4">
                        <select class="form-select" id="childCategory" aria-label="Default select example">
                            <option selected>Open this select Sub-Category</option>
                           
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-body">
            <button class="addButton btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal" id="addProducts">Add Product</button>
            <table class="table" id="productTable" class="display">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    
                </table>

        </div>

    </div>
            <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="POST" action="{{ route('products.store') }}" id="ProductAdd" enctype="multipart/form-data">
                @csrf

                <!-- Product Name -->
                <div class="mb-3">
                    <label for="name" class="form-label">Product Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter product name" required>
                </div>

                <!-- Category -->
                <div class="mb-3">
                    <label for="category_id" class="form-label">Category</label>
                    <select class="form-select" id="category_id" name="category_id" required>
                        <option value="" selected disabled>-- Select Category --</option>
                        @foreach($parent_category as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Images -->
                <div class="mb-3">
                    <label for="images" class="form-label">Upload Image(s)</label>
                    <input class="form-control" type="file" id="images"  name="files[]" multiple>
                </div>

                <!-- Status -->
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="" selected disabled>-- Select Status --</option>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

            </div>
           
            </div>
        </div>
        </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.min.js" integrity="sha512-bztGAvCE/3+a1Oh0gUro7BHukf6v7zpzrAb3ReWAVrt+bVNNphcl2tDTKCBr5zk7iEDmQ2Bv401fX3jeVXGIcA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
   <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

   <script>

        $(document).ready(function(){

            $('#parentCategory').on('change', function() {
                var parentId = $(this).val();
                $.ajax({
                    url: "{{route('get-categories')}}",
                    type: 'GET',
                    data: { parent_id: parentId },
                    success: function(data) {
                        // Assuming data is an array of child categories
                        let childCategory = $('#childCategory');
                        childCategory.empty(); // Clear previous options
                        if (data.length > 0) {
                            childCategory.append('<option selected>Open this select menu</option>'); // Add default option
                            $.each(data, function(index, category) {
                                childCategory.append('<option value="' + category.id + '">' + category.name + '</option>');
                            });
                        } else {
                            childCategory.append('<option>No child categories available</option>');
                        }
                        console.log(data, data);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching child categories:', error);
                    }
                });
            });

            $('#childCategory').on('change', function() {
                var childId = $(this).val();
                $('#productTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('get-product-categories') }}",
                        data: function (d) {
                            console.log(d);
                            d.child_id = childId;
                        }
                    },
                    columns: [
                        { data: 'name', name: 'name' },
                        { data: 'status', status: 'status' },
                        { data: 'actions', name: 'actions' }
                    ]
                });
            });


            $('#ProductAdd').on('submit', function(e){
                e.preventDefault();
                var data = new FormData(this);
                $.ajax({
                    url:"{{ route('products.store')}}",
                    type:"POST",
                    data:data,
                      processData: false,       // Don't process the data
                         contentType: false,   
                    success:function(data){
                        console.log('data', data);
                        // alert('Product added successfully!');
                        $('#ProductAdd')[0].reset();
                    },
                    error:function(xhr){
                        console.log('error', xhr.responseText);
                        alert('Failded to add product');
                    }
                });
            });
        }); 
   </script>    
  </body>
</html>