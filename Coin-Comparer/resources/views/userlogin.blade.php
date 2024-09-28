@extends('layouts.plantilla')
@section('title','Coin Comparer')
@section('content')
<main class="login-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <h3 class="card-header  text-white bg-dark text-center">Login</h3>
                    <div class="card-body  bg-dark">
                        <form method="POST" action="{{ route('user.logincheck') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Email" id="email" class="form-control text-dark" name="email" required
                                    autofocus>
                                @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <input type="password" placeholder="Password" id="password" class="form-control  text-dark" name="password" required>
                                @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" class="text-white" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>

                            <div class="d-grid mx-auto ">
                                <button type="submit" class="btn btn-light text-dark btn-block mb-3">Signin</button>
                            </div>
                      
                        </form>
                        <div class="d-grid mx-auto text-center"><a class="text-light" style="text-decoration: none;" href="{{ route('user.create') }}">Register</a></div>
                        @if(session()->has('error-msg'))
                        {{ session()->forget('error-msg') }}
                            <div class="text-danger text-center">Could not login - Email or Password wrong</div>
                        @endif


                    </div>
                </div>
            </div>
        </div>
    </div>
</main>




@endsection


