@extends('layouts.dash_layout')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Category List /</span></h4>
    <div class="row">
      <div class="col-md-12">
        <div class="card mb-4">
          <h5 class="card-header">Add New Category</h5>                     
          <!-- Table -->
          <div class="table-responsive">
            <table class="table">
              <thead class="table-dark">
                <tr>
                  <th class="text-white">Name</th>
                  <th class="text-white">Slug</th>
                  <th class="text-white">Description</th>
                  <th class="text-white">Image</th>
                  <th class="text-white">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($categories as $category)
                <tr>
                  <td>{{ $category->cat_name }}</td>
                  <td>{{ $category->cat_slug }}</td>
                  <td>{{ $category->cat_description }}</td>
                  <td><img width="10%" src="{{ asset('storage/images/'.$category->cat_image_path) }}" alt=""/></td>
                  <td>
                    <div class="row">
                        <div class="col-md-6">
                            <a href=""><i class="bx bx-edit-alt me-1" title="Edit"></i></a>
                        </div>
                        <div class="col-md-6">
                            <a href=""><i class="bx bx-trash me-1" title="Delete"></i></a>
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

@endsection