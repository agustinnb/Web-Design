@extends('layouts.plantilla')
@section('title','Create User')
@section('content')

<main class="login-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <h3 class="card-header  text-white bg-dark text-center">Register</h3>
                    <div class="card-body  bg-dark">
                        <form method="POST" action="{{ route('user.register') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Name" id="name" class="form-control text-dark" name="name" required
                                    autofocus>
                                @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <input type="text" placeholder="Email" id="email" class="form-control text-dark" name="email" required>
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


                            <div class="d-grid mx-auto " style="margin-top: 20px;">
                                <button type="submit" class="btn btn-light text-dark btn-block mb-3">Register</button>
                            </div>
                            <?php if (isset($_GET['error'])){ ?>
                            <span class="text-danger">Email already in use!</span>
                            <?php } ?>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


    




@endsection