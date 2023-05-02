@extends('layouts.main')

@section('container')
    @if (session('status'))
        <script>
            alert('Data berhasil ditambahkan ke bookmark!');
            // document.location.href = '/dashboard';
        </script>
    @endif


    <div class="container-fluid" style="background-color: #FEFAE0">
        <main class="tm-main">

            <h1 class="pt-2 tm-color-primary tm-post-title text-center mx-auto">{{ $tanaman->nama_tanaman }}</h1>
            <p class="tm-mb-40 text-center mx-auto">{{ $tanaman->latin }}</p>

            <div class="col-12">
                <hr class="tm-hr-primary tm-mb-55">
                <img src="{{ Storage::url($tanaman->gambar) }}" width="850" height="535" alt="Image" class="tm-mb-40">
            </div>



            <div class="mb-4">
                <h2 class="pt-2 tm-color-primary tm-post-title">Deskripsi</h2>

                <p>

                    {{ $tanaman->desk }}

                </p>


                <h4 class="tm-color-primary tm-post-title">Khasiat</h4>
                <p>
                    {{ $tanaman->khasiat }}.
                </p>
                <span class="d-block text-right tm-color-primary">posted by {{ $tanaman->username }}</span>
                <span class="d-block text-right tm-color-primary">{{ $tanaman->created_at_formatted }} </span>
            </div>



        </main>
    </div>
@endsection
