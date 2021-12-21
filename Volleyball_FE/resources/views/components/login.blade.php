@extends('layouts.master')

@section('title')
    <title>Login User</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('home/home.css') }}">
@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('home/home.js') }}"></script>
@endsection

@section('content')
    <section id="form"><!--form-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-sm-offset-1">
                    <div class="login-form"><!--login form-->
                        <h2>Login to your account</h2>
                        @if($errors->any())
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $err)
                                    <li> {{ $err }}</li>
                                @endforeach
                            </div>
                        @endif
                        @if(session('thongbao'))
                            <div class="alert alert-success">
                                {{ session('thongbao') }}
                            </div>
                        @endif

                        <form action="{{route('customers.post-login')}}" method="POST">
                            @csrf
                            <input name="email" type="email" placeholder="Email Address"/>
                            <input name="password" type="text" placeholder="Password">
                            <span>
								<input name="remember_me" type="checkbox" class="checkbox">
								Keep me signed in
							</span>
                            <button type="submit" class="btn btn-default">Login</button>
                        </form>
                    </div><!--/login form-->
                </div>
                <div class="col-sm-1">
                    <h2 class="or">OR</h2>
                </div>
                <div class="col-sm-4">
                    <div class="signup-form"><!--sign up form-->
                        <h2>New User Signup!</h2>

                        @if($errors->any())
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $err_)
                                    <li> {{ $err_ }}</li>
                                @endforeach
                            </div>
                        @endif
                        @if(session('thongbao_1'))
                            <div class="alert alert-success">
                                {{ session('thongbao_1') }}
                            </div>
                        @endif
                        <form action="{{route('customers.post-register')}}" method="POST">
                            @csrf
                            <label>Full Name</label>
                            <input name="name" type="text" placeholder="Full Name"/>

                            <label>Email Address</label>
                            <input name="email" type="email" placeholder="Email Address"/>

                            <label>Password</label>
                            <input name="password" type="password" placeholder="Password"/>

                            <label>Phone Number</label>
                            <input name="phone" type="text" placeholder="Phone Number"/>

                            <label>Address</label>
                            <input name="address" type="text" placeholder="Address"/>



{{--                            <label>Password Confirm</label>--}}
{{--                            <input type="password" placeholder="Password Confirm"/>--}}
                            <button type="submit" class="btn btn-default">Signup</button>
                        </form>

                    </div><!--/sign up form-->
                </div>
            </div>
        </div>
    </section><!--/form-->

@endsection

<body>


</body>
</html>



