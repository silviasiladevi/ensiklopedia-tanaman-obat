@extends('layouts.loginMain')
@section('container')
    <div class="brand-wrapper">
        <img src="/img/e-tob/logo.png" alt="logo" style="height: 80px">


    </div>
    <p class="login-card-description" style="color: #609966;">Login Admin</p>

    <form action="/login" method="post">
        @csrf
        <div class="form-group">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
            @endif
            @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
            @endif
            <label for="username" class="sr-only">Username <i class="fas fa-user"></i></label>
            <input type="text" name="username" id="username" class="form-control" placeholder="Masukkan Username"
                required>

        </div>
        <div class="form-group mb-4">
            <label for="password" class="sr-only">Password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan Password"
                required>
        </div>
        <div>
            <input type="checkbox" name="remember" id="remember">
            <label for="remember">Remember me</label>
        </div>
        <button class="btn btn-block login-btn mb-4" type="submit" style="background-color: #9DC08B"> Login</button>
    </form>

    </p>
@endsection
