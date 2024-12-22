@extends('admin.template.layout')
@section('title','Categoies')
@section('content')
<div class="content-wrapper">
     <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span>Categoies</h4>

        <div class="card ">
            <div class="row card-header justify-content-end">
                <div class="col-md-4">
                    <a href="{{ route('admin-category-create')}}" class="btn btn-primary float-end">Create</a>
                </div>
            </div>
            
                <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($categories as $index => $category)
                        <tr>
                            
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $category->name}}</td>
                            <td>
                            <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                <li
                                data-bs-toggle="tooltip"
                                data-popup="tooltip-custom"
                                data-bs-placement="top"
                                class="avatar avatar-xs pull-up"
                                title="{{ $category->name }}"
                                >
                                <img src="{{ env('CATEGORY_IMAGE_URL').$category->image }}" alt="Avatar" class="rounded-circle" />
                                </li>
                            </ul>
                            </td>
                            <td>
                                @if($category->status == 1)
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
                                <a class="dropdown-item" href="{{ route('admin-category-update',['id' => $category->id])}}"
                                    ><i class="bx bx-edit-alt me-1"></i> Edit</a
                                >
                                @if(!$category->parent_id)
                                <a class="dropdown-item" href="{{ route('admin-category-view-child',['id' => $category->id])}}"
                                    ><i class="bx bx-info-circle me-1"></i> View Child</a
                                >
                                @endif
                                </div>
                            </div>
                            </td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
                {{ $categories->links() }}
                </div>
        </div>
    </div>
</div>
  @stop