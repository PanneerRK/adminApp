@extends('layouts.dash_layout')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Product List /</span></h4>
  <div class="row">
    <div class="col-md-12">
      <div class="card mb-4">
        <!-- Table -->
        <div class="table-responsive">
          <table class="table">
            <thead class="table-dark">
              <tr>
                <th class="text-white">Name</th>
                <th class="text-white">Brand name</th>
                <th class="text-white">Price</th>
                <th class="text-white">Tax</th>
                <th class="text-white">Description</th>
                <th class="text-white">Image</th>
                <th class="text-white">Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($products as $product)
              <tr>
                <td>{{ $product->prod_name }}</td>
                <td>{{ $product->prod_brand }}</td>
                <td>{{ $product->prod_price }}</td>
                <td>{{ $product->prod_tax }} %</td>
                <td>{{ $product->prod_description }}</td>
                <td width="10%"><img width="50%" src="{{ asset('storage/images/'.$product->prod_image_path) }}" alt=""/></td>
                <td>
                  <div class="row">
                      <div class="col-md-6">
                          <a href="{{ route('product.edit', $product->id) }}"><i class="bx bx-edit-alt me-1" title="Edit"></i></a>
                      </div>
                      <meta name="csrf-token" content="{{ csrf_token() }}" />
                      <div class="col-md-6">
                          <a href="javascript:void(0)" data-url="{{ route('product.destroy', $product->cat_id) }}" id="delete-product" ><i class="bx bx-trash me-1 text-danger" title="Delete"></i></a>
                      </div>  
                  </div>        
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- /table -->
      </div>
    </div>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
<script type="text/javascript">      
    $(document).ready(function () {   
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
      
        /*------------------------------------------
        --------------------------------------------
        When click user on Show Button
        --------------------------------------------
        --------------------------------------------*/
        $('body').on('click', '#delete-product', function () {
          
          var userURL = $(this).data('url');
          var trObj = $(this);
  
          if(confirm("Are you sure you want to remove this Product?") == true){
                $.ajax({
                    url: userURL,
                    type: 'DELETE',
                    dataType: 'json',
                    success: function(data) {
                        alert(data.success);
                        trObj.parents("tr").remove();
                    }
                });
          }
  
       });
        
    });
    
</script>


@endsection