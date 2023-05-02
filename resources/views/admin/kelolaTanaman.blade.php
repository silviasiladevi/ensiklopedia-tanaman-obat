@extends('layouts.adminMain')

@section('container')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a class="btn btn-primary btn-lg" href="/homeAdmin/tambahTanaman">Tambah Tanaman</a>


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
                                <th>No</th>
                                <th>Nama Tanaman</th>
                                <th>Nama Latin</th>

                                <th>Lokasi</th>
                                <th>Kategori</th>
                                <th>Penulis</th>
                                <th>Gambar Tanaman</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($tanamen as $tanaman)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $tanaman->nama_tanaman }}</td>
                                    <td>{{ $tanaman->latin }}</td>

                                    <td>{{ $tanaman->lokasi }}</td>
                                    <td>{{ $tanaman->kategori }}</td>
                                    <td>{{ $tanaman->user->fullname }}</td>
                                    <td><img width="150px" src="{{ Storage::url($tanaman->gambar) }}"></td>
                                    <td>

                                        <div class="btn-group">
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#lihatDetail-{{ $tanaman->id }}"
                                                data-bs-whatever="@getbootstrap"><i class="fas fa-eye"></i></button>

                                            <a class="btn btn-success" href="/homeAdmin/{{ $tanaman->id }}/edit"><i
                                                    class="fas fa-edit"></i></a>

                                            <form action="tanaman/{{ $tanaman->id }}" method="post">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Yakin ingin menghapus tanaman ini?');"><i
                                                        class="fas fa-trash"></i></button>
                                            </form>
                                            {{-- <form action="tanaman/{{ $tanaman->id }}/status" method="post">
                                                @csrf
                                                @if ($tanaman->status == 'non-verified')
                                                    <input type="hidden" name="status" value="verified">
                                                @else
                                                    <input type="hidden" name="status" value="non-verified">
                                                @endif

                                                <button class="btn btn-primary"
                                                    onclick="return confirm('{{ $tanaman->status === 'non-verified' ? 'Verified' : 'Non-verified' }} tanaman ini?');">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form> --}}


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

    @foreach ($tanamen as $tanaman)
        <div class="modal" id="lihatDetail-{{ $tanaman->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">

            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">

                        <h4 class="modal-title text-center mx-auto" id="exampleModalLabel">
                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;{{ strtoupper($tanaman->nama_tanaman) }}</h4>

                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <h5>Deskripsi</h5>
                        <p>{{ $tanaman->desk }}</p>
                        <h5>khasiat</h5>
                        <p>{{ $tanaman->khasiat }}</p>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!-- End of Main Content -->

    <!-- Footer -->
@endsection
