@extends('layouts.adminMain')

@section('container')
    <!-- page start-->


    <section class="panel">
        <div class="row">
            @can('admin')
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <a class="card-block stretched-link text-decoration-none" href="/homeAdmin/tanaman">
                                <div class="row">
                                    <div class="col mr-2">
                                        <div class="h5 font-weight-bold text-info text-uppercase mb-1">
                                            KELOLA Tanaman</div>
                                        <div class="h6 mb-0 font-weight-bold text-gray-800">Tambah,Edit,Hapus Menu</div>
                                    </div>

                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-secondary shadow h-100 py-2">
                        <div class="card-body">
                            <a class="card-block stretched-link text-decoration-none" href="/homeAdmin/about">
                                <div class="row">
                                    <div class="col mr-2">
                                        <div class="h5 font-weight-bold text-secondary text-uppercase mb-1">
                                            KELOLA ABOUT</div>
                                        <div class="h6 mb-0 font-weight-bold text-gray-800">Update Informasi</div>
                                    </div>

                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <a class="card-block stretched-link text-decoration-none" href="/homeAdmin/user">
                                <div class="row">
                                    <div class="col mr-2">
                                        <div class="h5 font-weight-bold text-warning text-uppercase mb-1">
                                            KELOLA USER</div>
                                        <div class="h6 mb-0 font-weight-bold text-gray-800">Lihat, Edit Jabatan,Hapus User</div>
                                    </div>

                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-secondary shadow h-100 py-2">
                        <div class="card-body">
                            <a class="card-block stretched-link text-decoration-none" href="/homeAdmin/kategori">
                                <div class="row">
                                    <div class="col mr-2">
                                        <div class="h5 font-weight-bold text-secondary text-uppercase mb-1">
                                            KELOLA KATEGORI</div>
                                        <div class="h6 mb-0 font-weight-bold text-gray-800">Tambah dan hapus kategori</div>
                                    </div>

                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <a class="card-block stretched-link text-decoration-none" href="/homeAdmin/bookmark">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="h5 font-weight-bold text-warning text-uppercase mb-1">
                                            LIHAT BOOKMARK</div>
                                        <div class="h6 mb-0 font-weight-bold text-gray-800">Lihat Bookmark </div>
                                    </div>

                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <a class="card-block stretched-link text-decoration-none" href="/homeAdmin/report">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="h5 font-weight-bold text-info text-uppercase mb-1">
                                            KELOLA LAPORAN USER</div>
                                        <div class="h6 mb-0 font-weight-bold text-gray-800">Lihat laporan yang dikirimkan user,
                                            edit, dan hapus tanaman </div>
                                    </div>

                                </div>
                            </a>
                        </div>
                    </div>
                </div>


            </div>
        @endcan


    </section>
    </br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>


    <!-- page end-->
@endsection
