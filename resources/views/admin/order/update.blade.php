@extends('admin.template.layout')
@section('title','Order Detail')
@section('content')
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4"><span>Order Details</h4>

      <div class="card mb-4">
        <div class="card-body">
          <div class="row">
            <!-- Basic List group -->
            <div class="col-lg-6 mb-4 mb-xl-0">
              <h5 class="">Account Summary</h5>
              <div class="demo-inline-spacing mt-3">
                <div class="list-group">
                  <a href="javascript:void(0);" class="list-group-item list-group-item-action text-dark ">Name : {{ $order->user->name }}</a>
                  <a href="javascript:void(0);" class="list-group-item list-group-item-action text-dark">Email : {{ $order->user->email }}</a>
                  <a href="javascript:void(0);" class="list-group-item list-group-item-action text-dark ">Mobile : {{ $order->address->mobile }}</a>
                  <a href="javascript:void(0);" class="list-group-item list-group-item-action text-dark ">Address 
                    : {{ $order->address->address }},{{ $order->address->city }},{{ $order->address->state }}-{{ $order->address->pin_code }}</a>
                </div>
              </div>
            </div>
            <div class="col-lg-6 mb-4 mb-xl-0">
                <h5 class="">Order Summary</h5>
                <div class="demo-inline-spacing mt-3">
                  <div class="list-group">
                    <a href="javascript:void(0);" class="list-group-item list-group-item-action text-dark ">Qty : {{ $order->qty}}</a>
                    <a href="javascript:void(0);" class="list-group-item list-group-item-action text-dark">Discount : {{ $order->discount_amount ?? 0 }}</a>
                    <a href="javascript:void(0);" class="list-group-item list-group-item-action text-dark ">Amount : {{ $order->amount }}</a>
                    <a href="javascript:void(0);" class="list-group-item list-group-item-action text-dark ">Total : {{ $order->total}}</a>
                   </div>
                </div>
              </div>
          </div>
        </div>
      </div>

      <form action="" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card mb-4">
          <div class="card-body">
            <h5 class="">Order Status</h5>
            @if($order->status !=5) 
            <div class="row">
              <div class="col-md-4 mb-4 mb-xl-0">
                <div class="mb-3">
                  <label for="exampleFormControlSelect1" class="form-label">Status</label>
                  <select class="form-select" name="status" id="exampleFormControlSelect1" aria-label="Default select example">
                    <option selected>Select Status</option>
                    <option value="1" {{ $order->status == 1 ? 'selected' : null}}>Placed</option>
                    <option value="2" {{ $order->status == 2 ? 'selected' : null}} >Dispatched</option>
                    <option value="3" {{ $order->status == 3 ? 'selected' : null}} >Shipped</option>
                    <option value="4" {{ $order->status == 4 ? 'selected' : null}} >Approved</option>
                    <option value="5" {{ $order->status == 5 ? 'selected' : null}} >Canceled</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row mt-2 ">
              <div class="col-md-12 text-left">
                <button type="submit" class="btn btn-primary">Update</button>
              </div>  
            </div>     
            @else
            <div class="row">
              <div class="col-md-12">
                <h6 class="text-danger">Order has been canceled at {{ Carbon\Carbon::parse($order->canceled_at)->format('d/m/y h:i a') }}</h6>
              </div>
            </div>
            @endif   
          </div>
        </div>
      </form>

      <div class="card mb-4">
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <h5 class="">Order Items</h5>
              <div class="table-responsive text-nowrap">
                <table class="table">
                  <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Amount</th>
                    </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                    @foreach($order->items as $index => $item)
                    <td>{{ $index +1 }}</td>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->price }}</td>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

   
    <!-- / Content -->


    <div class="content-backdrop fade"></div>
  </div>
@stop