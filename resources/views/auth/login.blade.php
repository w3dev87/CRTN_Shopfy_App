@extends('layouts.app')

@section('content')
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <form class="login100-form validate-form" method="POST" id="check_login">
                    {{ csrf_field() }}
					<span class="login100-form-title p-b-43">
						Login to continue
					</span>

                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100"  name="order_number" id="shop" placeholder="Order number">
                        <span class="focus-input100"></span>
                        <span class="label-input100">Order Number</span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                        <input class="input100" type="email"  name="email" id="shop" placeholder="Email">
                        <span class="focus-input100"></span>
                        <span class="label-input100">Email</span>
                    </div>

                    <div class="container-login100-form-btn">
                        <button type="button" class="login100-form-btn customer_login">
                            Login
                        </button>
                    </div>

                </form>

                <div class="login100-more" style="background-image: url({{asset('img/login-img.jpg')}});">
                </div>
            </div>
        </div>
    </div>
@endsection