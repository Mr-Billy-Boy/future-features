@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="h-100 d-flex justify-content-center align-items-center" style="margin-top: 80px;">
        <div class="col-sm-4">
            <div class="card" style="padding:20px;">
                <div class="card-body">
                    <h3>Login</h3>
                    <hr>
                    <div class="mb-3">
                        <label for="inputEmail" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="inputEmail" placeholder="example@gmail.com">
                    </div>
                    <div class="mb-3">
                        <label for="inputPassword" class="form-label">Password:</label>
                        <input type="password" class="form-control" id="inputPassword" placeholder="***********">
                    </div>

                    <div class="g-signin2" data-onsuccess="onSignIn"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>

    </script>
@endsection