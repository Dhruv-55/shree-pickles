@extends('admin.template.layout')
@section('title','Products')
@section('content')
<div class="content-wrapper">
     <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span>Products</h4>

        <div class="card ">
            <div class="row card-header justify-content-end">
                <div class="col-md-4">
                    <a href="{{ route('admin-product-create')}}" class="btn btn-primary float-end">Create</a>
                </div>
            </div>
            
                <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($products as $index => $product)
                        <tr>
                            
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $product->name}}</td>
                            <td>{{ $product->category->name}}</td>
                        
                            <td>
                                @if($product->status == 1)
                                <span class="badge bg-label-success me-1">Active</span></td>
                                @else
                                <span class="badge bg-label-danger me-1">In Active</span></td>
                                @endif
                            <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('admin-product-update',['id' => $product->id])}}"
                                            ><i class="bx bx-edit-alt me-1"></i> Edit</a
                                        >
                                        <a class="dropdown-item" href="{{ route('admin-product-variation-view',['id' => $product->id])}}"
                                            ><i class="bx bx-info-circle me-1"></i> Variation</a
                                        >
                                        <a class="dropdown-item" href="{{ route('admin-product-detail-manage',['id' => $product->id])}}"
                                            ><i class="bx bx-info-circle me-1"></i> Detail</a
                                        >

                                </div>
                            </div>
                            </td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
                </div>
                {{$products->links()}}
        </div>
    </div>
</div>
  @stop