@extends('admin.template.layout')
@section('title','Variation Update')
@section('content')
<div class="content-wrapper">
  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Variation/</span> Update</h4>

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
                  <label class="form-label" for="basic-default-fullname">Product Name</label>
                  <input type="text" readonly name="name" value="{{ $product->name }}" class="form-control" id="basic-default-fullname"  />
                </div>
              </div>
              <div class="col-md-3">
                <div class="mb-3">
                  <label for="exampleFormControlSelect1" class="form-label">Variation</label>
                  <select class="form-select" name="variation_id" id="exampleFormControlSelect1" aria-label="Default select example">
                    <option value="">Select Variation</option>
                      @foreach (\App\Models\ProductVariation::variations() as $key => $variation_name)
                          <option value="{{ $key }}" {{ $variation->variation_id == $key ? 'selected' : '' }}>
                              {{ $variation_name }}
                          </option>
                      @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <div class="mb-3">
                  <label for="formFile" class="form-label">Quantity</label>
                  <input class="form-control" type="number" name="quantity" id="formFile" value="{{ $variation->quantity }}" />
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="formFile" class="form-label">Orignal Price</label>
                  <input class="form-control" type="number" name="original_price" id="formFile" value="{{ $variation->original_price }}" />
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="formFile" class="form-label">Selling Price</label>
                  <input class="form-control" type="number" name="selling_price" id="formFile" value="{{ $variation->selling_price }}" />
                </div>
              </div>
            </div>
          
          
          
            <button type="submit" class="btn btn-primary">Update</button>
          </form>
        </div>
      </div>
    </div>
  
  </div>
  </div>
</div>
  @stop