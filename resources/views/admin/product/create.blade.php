@extends('admin.template.layout')
@section('title','Product Create')
@section('content')
<div class="content-wrapper">
  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Product/</span> Create</h4>

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
                  <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="basic-default-fullname"  />
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-company">Slug</label>
                  <input type="text" class="form-control" id="basic-default-company" name="slug"  value="{{ old('slug')}}" />
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
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }} >{{ $category->name }}</option>                            
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
                            <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }} >{{ $brand->name }}</option>                            
                        @endforeach
                      </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                      <label for="exampleFormControlSelect1" class="form-label">Trending</label>
                      <select class="form-select" name="trending" id="exampleFormControlSelect1" aria-label="Default select example">
                        <option value="">Select Trending Status</option>
                        <option value="1"  {{ old('trending') == 1 ? 'selected' : '' }} >Yes</option>
                        <option value="2" {{ old('trending') == 2 ? 'selected' : '' }}>No</option>
                      </select>
                    </div>
                </div>
                <div class="col-md-3">
                  <div class="mb-3">
                    <label for="exampleFormControlSelect1" class="form-label">Variation</label>
                    <select class="form-select" name="qty_type" id="exampleFormControlSelect1" aria-label="Default select example">
                      <option value="">Select Variation</option>
                        @foreach (\App\Models\Product::variations() as $key => $variation)
                            <option value="{{ $key }}" {{ old('qty_type') == $key ? 'selected' : '' }}>
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
                        > {{ old('short_description') }} </textarea>
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
                  > {{ old('description') }} </textarea>
                </div>
              </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                      <label class="form-label" for="basic-default-company">Original Price</label>
                      <input type="number" class="form-control" id="basic-default-company" name="original_price"  value="{{ old('original_price')}}" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                      <label class="form-label" for="basic-default-company">Selling Price</label>
                      <input type="number" class="form-control" id="basic-default-company" name="selling_price"  value="{{ old('selling_price')}}" />
                    </div>
                </div>
                <div class="col-md-4">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-company">Quantity</label>
                    <input type="number" class="form-control" id="basic-default-company" name="quantity"  value="{{ old('quantity')}}" />
                  </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="formFile" class="form-label">Images</label>
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