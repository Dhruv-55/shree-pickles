@extends('admin.template.layout')
@section('title','Product Update')
@section('content')
<div class="content-wrapper">
  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Product/</span> Update</h4>

  <div class="row">
    <div class="col-md-xl ">
      <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
          {{-- <h5 class="mb-0">Basic Layout</h5> --}}
          {{-- <small class="text-muted float-end">Default label</small> --}}
        </div>
        <div class="card-body">
          <form action="" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname"> Name</label>
                  <input type="text" name="name" value="{{ $product->name }}" class="form-control" id="basic-default-fullname"  />
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-company">Slug</label>
                  <input type="text" class="form-control" id="basic-default-company" name="slug"  value="{{ $product->slug }}" />
                </div>
              </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="mb-3">
                      <label for="exampleFormControlSelect1" class="form-label">Category</label>
                      <select class="form-select" name="category_id" id="exampleFormControlSelect1" aria-label="Default select example">
                        <option value="">Select Category</option>
                        @foreach (\App\Models\Category::active()->get() as $category)
                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }} >{{ $category->name }}</option>                            
                        @endforeach
                      </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                      <label for="exampleFormControlSelect1" class="form-label">Brand</label>
                      <select class="form-select" name="brand_id" id="exampleFormControlSelect1" aria-label="Default select example">
                        <option value="">Select Brand</option>
                        @foreach (\App\Models\Brand::active()->get() as $brand)
                            <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' : '' }} >{{ $brand->name }}</option>                            
                        @endforeach
                      </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                      <label for="exampleFormControlSelect1" class="form-label">Trending</label>
                      <select class="form-select" name="trending" id="exampleFormControlSelect1" aria-label="Default select example">
                        <option value="">Select Trending Status</option>
                        <option value="1"  {{ $product->trending == 1 ? 'selected' : '' }} >Yes</option>
                        <option value="2" {{ $product->trending == 2 ? 'selected' : '' }}>No</option>
                      </select>
                    </div>
                </div>
                <div class="col-md-3">
                  <div class="mb-3">
                    <label for="exampleFormControlSelect1" class="form-label">Variation</label>
                    <select class="form-select" name="qty_type" id="exampleFormControlSelect1" aria-label="Default select example">
                      <option value="">Select Variation</option>
                        @foreach (\App\Models\Product::variations() as $key => $variation)
                            <option value="{{ $key }}" {{ $product->qty_type == $key ? 'selected' : '' }}>
                                {{ $variation }}
                            </option>
                        @endforeach
                    </select>
                  </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-message">Short Description</label>
                        <textarea
                          id="basic-default-message"
                          class="form-control"
                          name="short_description"
                        > {{ $product->short_description }} </textarea>
                      </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-message">Description</label>
                  <textarea
                    id="basic-default-message"
                    class="form-control"
                    name="description"
                  > {{ $product->description }} </textarea>
                </div>
              </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="mb-3">
                      <label class="form-label" for="basic-default-company">Original Price</label>
                      <input type="number" class="form-control" id="basic-default-company" name="original_price"  value="{{ $product->original_price }}" />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                      <label class="form-label" for="basic-default-company">Selling Price</label>
                      <input type="number" class="form-control" id="basic-default-company" name="selling_price"  value="{{ $product->selling_price }}" />
                    </div>
                </div>
                <div class="col-md-3">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-company">Quantity</label>
                    <input type="number" class="form-control" id="basic-default-company" name="quantity"  value="{{ $product->quantity }}" />
                  </div>
              </div>
              <div class="col-md-3">
                <div class="mb-3">
                  <label for="exampleFormControlSelect1" class="form-label">Status</label>
                  <select class="form-select" name="status" id="exampleFormControlSelect1" aria-label="Default select example">
                    <option value="">Select Trending Status</option>
                    <option value="1"  {{ $product->status == 1 ? 'selected' : '' }} >Active</option>
                    <option value="2" {{ $product->status == 2 ? 'selected' : '' }}>In Active</option>
                  </select>
                </div>
            </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="formFile" class="form-label">Images</label>
                  <input class="form-control" type="file" name="images[]" id="filer_input" multiple/>
                </div>
              </div>
            </div>
            @if($product->images)
              <div class="row mt-4 mb-4" id="existing-images">
                  @foreach($product->images as $image)
                      <div class="col-md-3 d-flex justify-content-center align-items-center position-relative" id="image-{{ $loop->index }}">
                          <!-- Image Container with Border and Centered Image -->
                          <div class="border p-2 position-relative d-flex justify-content-center align-items-center" style="border-radius: 8px; overflow: hidden; width: 100%; height: 100px;">
                              <img src="{{ env('PRODUCT_IMAGE_URL') . $image }}" class="img-fluid" style="max-height: 100%; object-fit: cover;" />
                              <!-- Cross icon for deletion (Boxicon) -->
                              <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 delete-image" 
                                      data-image="{{ $image }}" 
                                      data-index="{{ $loop->index }}">
                                  <i class="bx bx-x"></i>  <!-- Boxicon Cross (X) Icon -->
                              </button>
                          </div>
                      </div>
                  @endforeach
              </div>
            @endif
        
            <button type="submit" class="btn btn-primary">Update</button>
          </form>
        </div>
      </div>
    </div>
  
  </div>
  </div>
</div>
  @stop

  @section('page-js')
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
<script>
$(document).ready(function () {
    // Handle delete image button click
    $('.delete-image').on('click', function () {
      // alert('asda');
        var imageFileName = $(this).data('image');  // Get the image filename
        var imageIndex = $(this).data('index');    // Get the image index

        // Confirm delete action
        if (confirm('Are you sure you want to delete this image?')) {
            var token = "{{ csrf_token() }}";
            var productId = "{{ $product->id }}"; // Current product ID

            $.ajax({
                url: "{{ route('admin-product-delete-image') }}",  // Make sure to create this route in your routes/web.php
                method: 'POST',
                data: {
                    _token: token,
                    image: imageFileName,
                    product_id: productId
                },
                success: function(response) {
                    if (response.success) {
                        // Remove the deleted image's thumbnail from the UI
                        $('#image-' + imageIndex).remove();
                        alert('Image deleted successfully!');
                    } else {
                        alert('Error deleting image.');
                    }
                },
                error: function() {
                    alert('Error deleting image.');
                }
            });
        }
    });
});
</script>
@endsection
