@extends('layouts.adminMain')

@section('container')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold ">Bookmark</h6>
            </div>

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th data-orderable="false">No</th>
                                <th>Nama Tanaman</th>
                                <th>Jumlah Bookmark</th>
                                <th>Gambar</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($bookmarks as $bookmark)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $bookmark->tanaman->nama_tanaman }}</td>
                                    <td>{{ $bookmark->total }}</td>
                                    <td><img width="150px" src="{{ Storage::url($bookmark->tanaman->gambar) }}"></td>

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
@endsection
