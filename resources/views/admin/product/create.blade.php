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
                      <label for="parent_category" class="form-label">Parent Category</label>
                      <select class="form-select" name="parent_category_id" id="parent_category" aria-label="Default select example">
                        <option value="">Select Parent Category</option>
                        @foreach (\App\Models\Category::whereNull('parent_id')->active()->get() as $category)
                            <option value="{{ $category->id }}" {{ old('parent_category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>                            
                        @endforeach
                      </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                      <label for="child_category" class="form-label">Child Category</label>
                      <select class="form-select" name="category_id" id="child_category" aria-label="Default select example">
                        <option value="">Select Child Category</option>
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
  
  @section('page-js')
  <script>
    document.getElementById('parent_category').addEventListener('change', function() {
        let parentId = this.value;
        let childSelect = document.getElementById('child_category');
        
        // Clear existing options
        childSelect.innerHTML = '<option value="">Select Child Category</option>';
        
        if(parentId) {
            // Fetch child categories
            fetch(`/admin/product/get-child-categories/${parentId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    if (Array.isArray(data)) {
                        data.forEach(category => {
                            let option = document.createElement('option');
                            option.value = category.id;
                            option.textContent = category.name;
                            childSelect.appendChild(option);
                        });
                    } else {
                        console.error('Expected array of categories but got:', data);
                    }
                })
                .catch(error => {
                    console.error('Error fetching child categories:', error);
                    childSelect.innerHTML = '<option value="">Error loading categories</option>';
                });
        }
    });
  </script>
  @stop