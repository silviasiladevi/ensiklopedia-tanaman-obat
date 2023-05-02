@extends('layouts.adminMain')

@section('container')
    <div class="page-heading">

    </div>
    <div class="page-content">
        <section class="row">
            <div class="card mb-4">

                <form role="form" action="/homeAdmin/akun/edit" method="post" enctype="multipart/form-data">
                    @method('patch')
                    @csrf
                    <div class="form-group">
                        <label for="nomor_hp">Telp</label>
                        <input type="text" name="nomor_hp" class="form-control" id="no_hp"
                            placeholder="Masukkan Telp Sekolah" value="{{ $admin->nomor_hp }}" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" class="form-control" id="email"
                            placeholder="Masukkan Email Sekolah" value="{{ $admin->email }}" required>
                    </div>

                    <div class="form-group">
                        <label for="fullname">Fullname</label>
                        <input type="text" name="fullname" class="form-control" id="fullname"
                            placeholder="Masukkan fullname" value="{{ $admin->fullname }}" required>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary">UPDATE</button>
                </form>

            </div>

        </section>
    </div>
@endsection
