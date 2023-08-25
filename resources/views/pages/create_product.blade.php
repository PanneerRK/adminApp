@extends('layouts.dash_layout')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Categories /</span> Add Category</h4>
  <div class="row">
    <div class="col-md-12">
      <div class="card mb-4">
        <h5 class="card-header">Add New Product</h5>  
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="successMsg" style="display: none" >
          Category saved successfully
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>           
        <!-- Account -->
        <div class="card-body">
          <form action="{{ route('product.store') }}" method="POST" id="create-product" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="mb-3 col-md-6">
                <label for="Product Name" class="form-label">Product Name</label>
                <input class="form-control" type="text" id="prodName" name="prod_name" value="{{old('prod_name')}}" autofocus/>
                <span class="text-danger" id="prodName-input-error"></span>
              </div> 
              
              <div class="mb-3 col-md-6">
                <label for="Brand Name" class="form-label">Brand Name</label>
                <input class="form-control" type="text" id="prodBrand" name="prod_brand" value="{{old('prod_brand')}}" autofocus/>
                <span class="text-danger" id="prodBrand-input-error"></span>
              </div>

              <div class="mb-3 col-md-6">
                <label for="Product Price" class="form-label">Product Price</label>
                <input class="form-control" type="number" id="prodPrice" name="prod_price" value="{{old('prod_price')}}" autofocus/>
                <span class="text-danger" id="prodPrice-input-error"></span>
              </div>
              <div class="mb-3 col-md-6">
                <label for="Product Tax" class="form-label">Product Tax</label>
                <input class="form-control" type="number" id="prodTax" name="prod_tax" value="{{old('prod_tax')}}" autofocus/>
                <span class="text-danger" id="prodtax-input-error"></span>
              </div>

              <div class="mb-3 col-md-6">
                <label for="Category Name" class="form-label">Category Name</label>
                <select class="form-select" id="category" name="category">
                  <option selected>Open this select menu</option>
                  <option value="1">One</option>
                  <option value="2">Two</option>
                  <option value="3">Three</option>
                </select>
              </div>

              <div class="mb-3 col-md-6">
                <label for="Product Image" class="form-label">Product Image</label>
                <input type="file" class="form-control" name="prod_image_path" id="prodImagePath">
                <span class="text-danger" id="image-input-error"></span>
              </div>  
              <div class="mb-3 col-md-6">
                <label for="Description" class="form-label">Description</label>
                <textarea class="form-control" name="prod_description" id="prodDescription" rows="3"></textarea>
                <span class="text-danger" id="prodDesc-input-error"></span>
              </div> 
              
              <div class="mb-3 col-md-6">
                <img id="preview-image" width="300px">
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


@endsection