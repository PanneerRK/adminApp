@extends('layouts.dash_layout')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Products /</span> Update Product</h4>
  <div class="row">
    <div class="col-md-12">
      <div class="card mb-4">
        <h5 class="card-header">Add New Product</h5>  
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="successMsg" style="display: none" >
          Product saved successfully
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>           
        <!-- Account -->
        <div class="card-body">
          <form action="{{ route('product.update', $product->id) }}" method="POST" id="update-product" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="mb-3 col-md-6">
                <label for="Product Name" class="form-label">Product Name</label>
                <input class="form-control" type="text" id="prodName" name="prod_name" value="{{ $product->prod_name}}" autofocus/>
                <span class="text-danger" id="prodNameErr"></span>
              </div> 
              
              <div class="mb-3 col-md-6">
                <label for="Brand Name" class="form-label">Brand Name</label>
                <input class="form-control" type="text" id="prodBrand" name="prod_brand" value="{{ $product->prod_brand}}" />
                <span class="text-danger" id="prodBrandErr"></span>
              </div>

              <div class="mb-3 col-md-6">
                <label for="Product Price" class="form-label">Product Price</label>
                <input class="form-control" type="number" id="prodPrice" name="prod_price" value="{{ $product->prod_price}}" />
                <span class="text-danger" id="prodPriceErr"></span>
              </div>
              <div class="mb-3 col-md-6">
                <label for="Product Tax" class="form-label">Product Tax</label>
                <input class="form-control" type="number" id="prodTax" name="prod_tax" value="{{ $product->prod_tax}}" />
                <span class="text-danger" id="prodTaxErr"></span>
              </div>

              <div class="mb-3 col-md-6">
                <label for="Category Name" class="form-label">Category Name</label>
                <select class="form-select" id="category" name="category">
                  <option value="" selected>-- Select Anyone --</option>
                  @php  $catgories =  \App\Models\Category::get(); @endphp
                  @foreach ($catgories as $cat)
                      <option value="{{ $cat->id }}" {{ ( $cat->id == $product->cat_id) ? 'selected' : '' }}> {{ $cat->cat_name }} </option>
                  @endforeach
                </select>
                <span class="text-danger" id="categoryErr"></span>
              </div>
              <div class="mb-3 col-md-6">
                <label for="Product Image" class="form-label">Product Image</label>
                <input type="file" class="form-control" name="prod_image_path" id="prodImagePath">
                <span class="text-danger" id="imageErr"></span>
              </div>  
              <div class="mb-3 col-md-6">
                <label for="Description" class="form-label">Description</label>
                <textarea class="form-control" name="prod_description" id="prodDescription" rows="3">{{ $product->prod_description }}</textarea>
                <span class="text-danger" id="prodDescErr"></span>
              </div> 
              
              <div class="mb-3 col-md-3">
                <span>Old Image : </span><img width="50%" src="{{ asset('storage/images/'.$product->prod_image_path) }}">
              </div>
              <div class="mb-3 col-md-3">
                <span>New Image : </span><img id="preview-image" width="50%" >
              </div>
            </div>
            <div class="mt-2">
              <button type="submit" class="btn btn-submit btn-primary me-2">Save changes</button>
              <button type="reset" class="btn btn-outline-secondary">Cancel</button>
            </div>
          </form>
        </div>
        <!-- /Account -->
      </div>
    </div>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
  
    $('#prodImagePath').change(function(){    
        let reader = new FileReader();
   
        reader.onload = (e) => { 
            $('#preview-image').attr('src', e.target.result); 
        }   
        reader.readAsDataURL(this.files[0]); 
     
    });
  
    $('#update-product').submit(function(e) {
           e.preventDefault();
  
           let formData = new FormData(this);
  
           $.ajax({
              type:'POST',
              url: "{{ route('product.update', $product->id) }}",
               data: formData,
               contentType: false,
               processData: false,
               success: (response) => {
                 if (response) {
                      alert('Product updated successfully');
                      window.location.reload();
                 }
               },
               error: function(response){
                    $('#prodNameErr').text(response.responseJSON.errors.prod_name);
                    $('#prodBrandErr').text(response.responseJSON.errors.prod_brand);
                    $('#prodPriceErr').text(response.responseJSON.errors.prod_price);
                    $('#prodTaxErr').text(response.responseJSON.errors.prod_tax);
                    $('#categoryErr').text(response.responseJSON.errors.category);
                    $('#imageErr').text(response.responseJSON.errors.prod_image_path);
                    $('#prodDescErr').text(response.responseJSON.errors.prod_description);
               }
           });
    });
      
  </script>

@endsection