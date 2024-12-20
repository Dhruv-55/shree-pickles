@extends('website.template.layout')
@section('content')

   <!-- rts register area start -->
   <div class="rts-register-area rts-section-gap bg_light-1">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="registration-wrapper-1">
                    <div class="logo-area mb--0">
                        <img class="mb--10" src="{{ env('LOCAL_URL') }}logo.jpg" alt="logo">
                    </div>
                    <h3 class="title">Register Into Your Account</h3>
                    <form action="{{ route('website-auth-register') }}" method="post" class="registration-form">
                        <div class="input-wrapper">
                            <label for="name">Username*</label>
                            <input type="text" id="name" name="name">
                        </div>
                        <div class="input-wrapper">
                            <label for="email">Email*</label>
                            <input type="email" id="email" name="email">
                        </div>
                        <div class="input-wrapper">
                            <label for="password">Password*</label>
                            <input type="password" id="password" name="password">
                        </div>
                        <button class="rts-btn btn-primary">Register Account</button>
                        <div class="another-way-to-registration">
                            <div class="registradion-top-text">
                                <span>Or Register With</span>
                            </div>
                            <div class="login-with-brand">
                                <a href="register.html#" class="single">
                                    <img src="{{ env('LOCAL_URL') }}website-assets/images/form/google.svg" alt="login">
                                </a>
                                <a href="register.html#" class="single">
                                    <img src="{{ env('LOCAL_URL') }}website-assets/images/form/facebook.svg" alt="login">
                                </a>
                            </div>
                            <p>Already Have Account? <a href="{{ route('website-auth-login') }}">Login</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- rts register area end -->

@endsection