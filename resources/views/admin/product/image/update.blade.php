@extends('admin.template.layout')
@section('title','Product Image Update')
@section('content')
<div class="content-wrapper">
  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Product Image/</span> Update</h4>

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
                      <label for="exampleFormControlSelect1" class="form-label">Product</label>
                      <select class="form-select" name="product_id" id="exampleFormControlSelect1" aria-label="Default select example">
                        <option value="">Select Product</option>
                        @foreach (\App\Models\Product::active()->get() as $product)
                        <option value="{{ $product->id }}"{{ $product->id == $image->product_id ? 'selected' : '' }}>{{ $product->name }} </option>                            
                        @endforeach
                      </select>
                    </div>
                  </div>
              <div class="col-md-6">
                {{ dump($image->image)}}
                <div class="mb-3">
                  <label for="formFile" class="form-label">Image</label>
                  <input class="form-control" type="file" name="images[]" id="filer_input" multiple/>
                </div>
              </div>
            </div>
          
          
          
            <button type="submit" class="btn btn-primary">Create</button>
          </form>
        </div>
      </div>
    </div>
  
  </div>
  </div>
</div>
@stop
 