@extends('layouts.adminMain')

@section('container')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                Daftar User


            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Lengkap</th>
                                <th>Username</th>
                                <th>No.Telp</th>
                                <th>Email</th>
                                <th>Jabatan</th>
                                <th>Ubah Jabatan</th>
                                <th>Hapus</th>

                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->fullname }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->nomor_hp }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->jabatan }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <form action="user/{{ $user->username }}" method="post">
                                                @csrf
                                                <input type="hidden" name="jabatan" value="admin">
                                                <button class="btn btn-primary"
                                                    onclick="return confirm('Jadikan user ini admin?');"><i
                                                        class="fas fa-user-shield"></i></button>
                                            </form>

                                            <form action="user/{{ $user->username }}" method="post">
                                                @csrf
                                                <input type="hidden" name="jabatan" value="User Registered">
                                                <button class="btn btn-info"
                                                    onclick="return confirm('Jadikan user ini User Registered?');">
                                                    <i class="fas fa-user-alt"></i>
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <form action="user/{{ $user->username }}" method="post">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Anda yakin ingin menghapus user ini?');"><i
                                                        class="fas fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <!-- Footer -->
@endsection
