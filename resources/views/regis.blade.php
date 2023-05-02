@extends('layouts.loginMain')
@section('container')


    <div class="brand-wrapper">
        <img src="/img/Nosh/logo.png" alt="logo" style="height: 80px">
    </div>
    <p class="login-card-description">Make your own account</p>
    <form action="/regis" method="post">
        @csrf
        <div class="form-group">
            <label for="fullname" class="sr-only">Nama Lengkap</label>
            <input type="text" name="fullname" id="fullname" class="form-control @error('fullname') is-invalid @enderror"
                placeholder="Masukkan nama lengkap" required value="{{ old('fullname') }}">
            @error('fullname')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>

            @enderror
        </div>
        <div class="form-group">
            <label for="email" class="sr-only">Email</label>
            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                placeholder="Masukkan alamat email" required value="{{ old('email') }}">
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>

            @enderror
        </div>
        <div class="form-group">
            <label for="nomor_hp" class="sr-only">Nomor Handphone</label>
            <input type="number" size="13" name="nomor_hp" id="nomor_hp"
                class="
                form-control @error('nomor_hp') is-invalid @enderror"
                placeholder="Masukkan nomor hp" required value="{{ old('nomor_hp') }}">
            @error('nomor_hp')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>

            @enderror
        </div>
        <div class="form-group">
            <label for="username" class="sr-only">Username</label>
            <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror"
                placeholder="Masukkan username" required value="{{ old('username') }}">
            @error('username')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>

            @enderror
        </div>
        <div class="form-group mb-4">
            <label for="password" class="sr-only">Password</label>
            <input type="password" name="password" id="password"
                class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan password" required>
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>

            @enderror
        </div>
        <button class="btn btn-block login-btn mb-4" type="submit"> Register</button>
    </form>
    <p class="login-card-footer-text">Already have an account? <a href="/login">Login here !</a></p>






    {{-- <div class="text-right">


        <button class="open-button" onclick="openForm()">Daftar</button>

        <div class="form-popup" id="myForm">
            <form action="" class="form-container" method="POST">
                <h1>Daftar</h1>

                <label for="nama"><b>Nama Lengkap</b></label>
                <input type="text" placeholder="masukkan nama anda" name="name" required>

                <label for="nomor hp"><b>Nomor Hp</b></label>
                <input type="text" placeholder="masukkan nomor hp anda" name="no_hp" required>


                <label for="email"><b>Email</b></label>
                <input type="text" placeholder="masukkan email anda" name="email" required>

                <label for="psw"><b>Username</b></label>
                <input type="text" placeholder="masukkan username anda" name="user" required>


                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="masukkan password anda" name="psw" required>

                <button type="submit" name="submit" class="btn">Daftar</button>
                <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
            </form>
        </div>

        <script>
            function openForm() {
                document.getElementById("myForm").style.display = "block";
            }

            function closeForm() {
                document.getElementById("myForm").style.display = "none";
            }
        </script> --}}


@endsection
