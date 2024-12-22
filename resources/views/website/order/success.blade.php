@extends('website.template.layout')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg" style="border-radius: 15px; border: none;">
                <div class="card-body text-center p-5">
                    <div class="mb-4">
                        <i class="fas fa-check-circle text-success" style="font-size: 5rem; filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.1));"></i>
                    </div>
                    <h2 class="card-title mb-3" style="font-weight: 600; color: #2c3e50;">Order Placed Successfully!</h2>
                    <p class="card-text" style="color: #666; font-size: 1.1rem;">Thank you for your order. Your order has been successfully processed.</p>
                    
                    @if(isset($order))
                        <div class="order-details mt-5 text-left" style="background: #f8f9fa; padding: 25px; border-radius: 10px;">
                            <h4 style="color: #2c3e50; margin-bottom: 20px; font-weight: 600;">Order Details</h4>
                            <div class="table-responsive">
                                <table class="table" style="margin-bottom: 0;">
                                    <tr style="border-bottom: 1px solid #dee2e6;">
                                        <th style="padding: 15px 0; color: #6c757d; font-weight: 600; border-top: none;">Order ID:</th>
                                        <td style="padding: 15px 0; border-top: none;">#{{ $order->id }}</td>
                                    </tr>
                                    <tr style="border-bottom: 1px solid #dee2e6;">
                                        <th style="padding: 15px 0; color: #6c757d; font-weight: 600; border-top: none;">Order Date:</th>
                                        <td style="padding: 15px 0; border-top: none;">{{ $order->created_at->format('d M, Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th style="padding: 15px 0; color: #6c757d; font-weight: 600; border-top: none;">Total Amount:</th>
                                        <td style="padding: 15px 0; border-top: none;">£{{ number_format($order->amount, 2) }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    @endif

                    <div class="mt-5 d-flex justify-content-center gap-3">
                        <a href="{{ route('website-product-view') }}" class="rts-btn btn-primary d-flex justify-content-center" 
                           style="padding: 12px 30px; 
                                  border-radius: 8px;
                                  font-weight: 500;
                                  text-transform: uppercase;
                                  letter-spacing: 0.5px;
                                  transition: all 0.3s ease;
                                  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                            Continue Shopping
                        </a>
                        <a href="{{ route('user-dashboard') }}" class="rts-btn btn-primary d-flex justify-content-center" 
                           style="padding: 12px 30px; 
                                  border-radius: 8px;
                                  font-weight: 500;
                                  text-transform: uppercase;
                                  letter-spacing: 0.5px;
                                  transition: all 0.3s ease;
                                  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                            My Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection