@extends('layouts.dash_layout')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Categories /</span> Add Category</h4>
  <div class="row">
    <div class="col-md-12">
      <div class="card mb-4">
        <h5 class="card-header">Add New Category</h5>  
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="successMsg" style="display: none" >
          Category Updated successfully
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>           
        <!-- Account -->
        <div class="card-body">
          <form action="{{ route('category.update', $categories->id) }}" method="POST" id="update-category" enctype="multipart/form-data">
            @csrf            
            <div class="row">                
              <div class="mb-3 col-md-6">
                <label for="categoryname" class="form-label">Category Name</label>
                <input class="form-control" type="text" id="catName" name="cat_name" value="{{$categories->cat_name}}" autofocus/>
                <span class="text-danger" id="name-input-error"></span>
              </div>  
              <div class="mb-3 col-md-6">
                <label for="category Image" class="form-label">Category Image</label>
                <input type="file" class="form-control" name="cat_image_path" id="catImagePath">
                <span class="text-danger" id="image-input-error"></span>
              </div>  
              <div class="mb-3 col-md-6">
                <label for="Description" class="form-label">Description</label>
                <textarea class="form-control" name="cat_description" id="catDescription" rows="3">{{$categories->cat_description}}</textarea>
                <span class="text-danger" id="desc-input-error"></span>
              </div> 
              <div class="mb-3 col-md-3">
                <span>Old Image : </span><img width="50%" src="{{ asset('storage/images/'.$categories->cat_image_path) }}">
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

  $('#catImagePath').change(function(){    
      let reader = new FileReader();
 
      reader.onload = (e) => { 
          $('#preview-image').attr('src', e.target.result); 
      }   
      reader.readAsDataURL(this.files[0]); 
   
  });

  $('#update-category').submit(function(e) {
         e.preventDefault();

         let formData = new FormData(this);

         $.ajax({
            type:'POST',
            url: "{{ route('category.update', $categories->id) }}",
             data: formData,
             contentType: false,
             processData: false,
             success: (response) => {
               if (response) {
                    alert('Category updated successfully');
                    window.location.reload();
               }
             },
             error: function(response){
                  $('#name-input-error').text(response.responseJSON.errors.cat_name);
                  $('#desc-input-error').text(response.responseJSON.errors.cat_description);
                  $('#image-input-error').text(response.responseJSON.errors.cat_image_path);
             }
         });
  });
    
</script>


@endsection