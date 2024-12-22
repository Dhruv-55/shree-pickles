@extends('admin.template.layout')
@section('title','Banners')
@section('content')
<div class="content-wrapper">
     <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span>Banners</h4>

        <div class="card ">
            <div class="row card-header justify-content-end">
                <div class="col-md-4">
                    <a href="{{ route('admin-banner-create')}}" class="btn btn-primary float-end">Create</a>
                </div>
            </div>
            @if(count($banners) > 0)
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
                        @foreach ($banners as $index => $banner)
                        <tr>
                            
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $banner->title}}</td>
                            <td>
                            <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                <li
                                data-bs-toggle="tooltip"
                                data-popup="tooltip-custom"
                                data-bs-placement="top"
                                class="avatar avatar-xs pull-up"
                                title="{{ $banner->title }}"
                                >
                                <img src="{{ env('BANNER_IMAGE_URL').$banner->image }}" alt="Avatar" class="rounded-circle" />
                                </li>
                            </ul>
                            </td>
                            <td>
                                @if($banner->status == 1)
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
                                <a class="dropdown-item" href="{{ route('admin-banner-update',['id' => $banner->id])}}"
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
                {{$banners->links()}}
            @else
                <div class="alert alert-info">No banners found</div>
            @endif
        </div>
    </div>
</div>
  @stop