@extends('admin.template.layout')
@section('title','Banner Create')
@section('content')
<div class="content-wrapper">
  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Banner/</span> Create</h4>

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
              <div class="col-md-4">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname"> Title</label>
                  <input type="text" name="title" value="{{ old('title') }}" class="form-control" id="basic-default-fullname"  />
                </div>
              </div>
              <div class="col-md-4">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-company">Link</label>
                  <input type="text" class="form-control" id="basic-default-company" name="link"  value="{{ old('link')}}" />
                </div>
              </div>
              <div class="col-md-4">
                <div class="mb-3">
                  <label for="exampleFormControlSelect1" class="form-label">Type</label>
                  <select class="form-select" name="type" id="exampleFormControlSelect1" aria-label="Default select example">
                    <option value="">Select Type</option>
                          <option value="1" {{ old('type') == 1 ? 'selected' : '' }}>
                              Banner
                          </option>
                          <option value="2" {{ old('type') == 2 ? 'selected' : '' }}>
                              Slider
                          </option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="formFile" class="form-label">Image</label>
                  <input class="form-control" type="file" name="image" id="formFile" />
                </div>
              </div>
              <div class="col-md-4">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-company">Position</label>
                  <input type="number" class="form-control" id="basic-default-company" name="position"  value="{{ old('position')}}" />
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