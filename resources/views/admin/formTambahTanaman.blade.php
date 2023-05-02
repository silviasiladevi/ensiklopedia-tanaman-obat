@extends('layouts.adminMain')

@section('container')
    <!-- page start-->

    <div class="row">

        <div class="col-lg-12">
            <section class="panel">
                <div class="col-xl-12 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <section id="main-content">

                                <form role="form" action="/tanaman" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="namatanaman">Nama Tanaman</label>
                                        <input type="text" name="nama_tanaman" class="form-control" id="namatanaman"
                                            placeholder="Masukkan nama tanaman" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="latin">Nama Latin</label>
                                        <input type="text" name="latin" class="form-control" id="latin"
                                            placeholder="Masukkan nama latin" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="lokasi">lokasi</label>
                                        <input type="text" name="lokasi" class="form-control" id="lokasi"
                                            placeholder="Masukkan lokasi" required>
                                    </div>


                                    <div class="form-group">
                                        <label for="khasiat">Khasiat</label>
                                        <textarea type="text" name="khasiat" class="form-control" id="khasiat" placeholder="Masukkan khasiat tanaman"
                                            required rows="6" cols="30" required>
                                        </textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="desk">Deskripsi</label>
                                        <textarea type="text" name="desk" class="form-control" id="desk" placeholder="Masukkan Deskripsi tanaman"
                                            required rows="6" cols="30" required>
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="kategori">Kategori</label>
                                        <select id="kategori" class="form-control" name="kategori">
                                            <option value="" selected disabled>Pilih kategori</option>
                                            @foreach ($kategoris as $kategori)
                                                <option>{{ $kategori->kategori }}</option>
                                            @endforeach


                                        </select>

                                    </div>

                                    <div class="form-group">
                                        <label for="gambar">Unggah Foto</label>
                                        <input type="file" name="gambar" id="gambar"
                                            class="form-contorl  @error('gambar') is-invalid @enderror">
                                        @error('gambar')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>





                                    <button type="submit" name="submit" class="btn btn-primary">ADD</button>
                                </form>

                        </div>

                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- page end-->
@endsection
