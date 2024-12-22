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
                        @foreach ($orders as $index => $order)
                        <tr>
                            
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $order->created_at->format('Y-m-d H:m A') }}</td>
                            <td>{{ $order->user->name}}</td>
                            <td>{{ $order->total}}</td>
                            <td>{{ $order->tracking_number }}</td>
                            <td>
                               <span class="badge bg-label-primary me-1"> {{$order->status}}</span>
                                {{-- @if($order->status == \App\Models\Order::PLACED)
                                <span class="badge bg-label-warning me-1">Placed</span></td>
                                @elseif($order->status == \App\Models\Order::DISPATCHED)
                                <span class="badge bg-label-info me-1">Dispacthed</span></td>
                                @elseif($order->status == \App\Models\Order::SHIPPED)
                                <span class="badge bg-label-primary me-1">Shipped</span></td>
                                @elseif($order->status == \App\Models\Order::APPROVED)
                                <span class="badge bg-label-success me-1">Approved</span></td>
                                @else
                                <span class="badge bg-label-danger me-1">Canceled</span></td>
                                @endif --}}
                            <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('admin-order-update',['id' => $order->id])}}"
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
                {{$orders->links()}}
        </div>
    </div>
</div>
  @stop