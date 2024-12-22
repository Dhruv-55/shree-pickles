@extends('admin.template.layout')
@section('title','Products')
@section('content')
<div class="content-wrapper">
     <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span>Products</h4>

        <div class="card ">
            <div class="row card-header justify-content-end">
                <div class="col-md-4">
                    <a href="{{ route('admin-product-detail-create',['id' => $product->id])}}" class="btn btn-primary float-end">Create</a>
                </div>
            </div>
            
                <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Information</th>
                        <th>Detail</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($productDetails as $index => $productDetail)
                        <tr>
                            
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $productDetail->information}}</td>
                                <td>{{ $productDetail->detail}}</td>
                        
                            <td>
                                
                            <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('admin-product-detail-update',['id' => $productDetail->id])}}"
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