@extends('admin.template.layout')
@section('title','Orders')
@section('content')
<div class="content-wrapper">
     <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span>Orders</h4>

        <div class="card ">
            <div class="table-responsive text-nowrap py-5 px-2">
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Date</th>  
                        <th>User</th>
                        <th>Total</th>
                        <th>Order ID</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($cancel_orders as $index => $order)
                        <tr>
                            
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $order->created_at->format('Y-m-d H:m A') }}</td>
                            <td>{{ $order->user->name}}</td>
                            <td>{{ $order->order->total}}</td>
                            <td>{{ $order->cancel_order_id }}</td>
                     
                            <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('admin-order-update',['id' => $order->order_id])}}"
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