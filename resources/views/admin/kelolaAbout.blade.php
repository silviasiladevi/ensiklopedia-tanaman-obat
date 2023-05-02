@extends('layouts.adminMain')

@section('container')
    <div class="page-heading">

    </div>
    <div class="page-content">
        <section class="row">
            <div class="card mb-4">

                <form role="form" action="/homeAdmin/about/edit" method="post" enctype="multipart/form-data">
                    @method('patch')
                    @csrf
                    <div class="form-group">
                        <label for="no_hp" class="sr-only">Nomor Telepon</label>
                        <input type="number" name="no_hp" size="14"
                            class="
                        form-control @error('nomor_hp') is-invalid @enderror"
                            id="no_hp" placeholder="Masukkan nomor telepon" value="{{ $about->no_hp }}" required>
                        @error('no_hp')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            id="email" placeholder="Masukkan Email " value="{{ $about->email }}" required>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="instagram">Instagram</label>
                        <input type="text" name="instagram" class="form-control" id="instagram"
                            placeholder="Masukkan username instagram" value="{{ $about->instagram }}" required>
                    </div>


                    <div class="form-group">
                        <label for="facebook">Facebook</label>
                        <input type="text" name="facebook" class="form-control" id="facebook"
                            placeholder="Masukkan Facebook" value="{{ $about->facebook }}" required>
                    </div>


                    <div class="form-group">
                        <label for="info_aplikasi">Informasi Aplikasi</label>
                        <textarea type="text" name="info_aplikasi" class="form-control" id="info_aplikasi"
                            placeholder="Masukkan informasi aplikas" required rows="6" cols="30" required> {{ $about->info_aplikasi }}
                    </textarea>

                        {{-- <input type="text" name="sambutan" class="form-control" id="sambutan"
                            placeholder="Masukkan sambutan Kepala Sekolah" value="{{ $about->sambutan }}" required> --}}
                    </div>

                    <div class="form-group">
                        <label for="tentang">Tentang</label>
                        <textarea type="text" name="tentang" id="tentang" class="form-control" placeholder="Masukkan tentang aplikasi"
                            required rows="6" cols="30" required> {{ $about->tentang }}</textarea>
                        {{-- <input type="text" name="sambutan" class="form-control" id="sambutan"
                            placeholder="Masukkan sambutan Kepala Sekolah" value="{{ $about->sambutan }}" required> --}}
                    </div>

                    <img width="300px" src="{{ Storage::url($about->gambar) }}">
                    </br> </br>
                    <div class="form-group">
                        <label for="gambar">Unggah Foto</label>
                        <input type="file" name="gambar" id="gambar"
                            class="form-contorl  @error('gambar') is-invalid @enderror" value="{{ $about->gambar }}">
                        @error('gambar')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>




                    <button type="submit" name="submit" class="btn btn-primary">UPDATE</button>
                </form>

            </div>

        </section>
    </div>
@endsection
