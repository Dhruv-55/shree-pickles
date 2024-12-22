@extends('admin.template.layout')
@section('title','Product Variations')
@section('content')
<div class="content-wrapper">
     <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span>Products Variations</h4>

        <div class="card ">
            <div class="row card-header justify-content-end">
                <div class="col-md-4">
                    <a href="{{ route('admin-product-view')}}" class="btn btn-primary float-end mx-2">Back</a>
                    <a href="{{ route('admin-product-variation-create',['id' => $product->id])}}" class="btn btn-primary float-end">Create</a>
              
                </div>
            </div>
            
                <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Variation</th>
                        <th>Orignal Price</th>
                        <th>Selling Price</th>
                        <th>Quantity</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($variations as $index => $variation)
                        <tr>
                            
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $product->name}}</td>
                            <td>{{ App\Models\ProductVariation::variation($variation->variation_id)}}</td>
                            <td>{{ $variation->original_price}}</td>
                            <td>{{ $variation->selling_price}}</td>
                            <td>{{ $variation->quantity}}</td>
                        
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('admin-product-variation-update',['id' => $variation->id])}}"
                                                ><i class="bx bx-edit-alt me-1"></i> Edit</a
                                            >
                                            <a class="dropdown-item" href="{{ route('admin-product-variation-delete',['id' => $variation->id])}}"
                                                ><i class="bx bx-trash me-1"></i> Delete</a>
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