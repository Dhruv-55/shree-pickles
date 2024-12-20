@extends('admin.template.layout')
@section('title','Product Images')
@section('content')
<div class="content-wrapper">
     <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Product/</span>Images</h4>

        <div class="card ">
            <div class="row card-header justify-content-end">
                <div class="col-md-4">
                    <a href="{{ route('admin-product-image-create')}}" class="btn btn-primary float-end">Create</a>
                </div>
            </div>
            
                <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($images as $index => $image)
                        <tr>
                            
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $image->product->name}}</td>
                            <td>
                                @php
                                    $primaryImage = \App\Models\ProductImage::getPrimaryImage($image->product_id);
                                @endphp
                                <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                    <li
                                    data-bs-toggle="tooltip"
                                    data-popup="tooltip-custom"
                                    data-bs-placement="top"
                                    class="avatar avatar-xs pull-up"
                                    {{-- title="{{ $category->name }}" --}}
                                    >
                                    <img src="{{ env('PRODUCT_IMAGE_URL') . ($primaryImage ? $primaryImage->image : 'default-image.jpg') }}" alt="Avatar" class="rounded-circle" />
                                    </li>
                                </ul>
                            <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('admin-product-image-update',['id' => $image->id])}}"
                                    ><i class="bx bx-edit-alt me-1"></i> Edit</a
                                >
                                </div>
                            </div>
                            </td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
                </div>
        </div>
    </div>
</div>
  @stop