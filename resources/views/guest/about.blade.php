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
            <h1 class="pt-2 tm-color-primary text-center mx-auto">A B O U T</h1>
            @foreach ($about as $about)
                <div class="col-12" style="text-align: justify;">
                    <hr class="tm-hr-primary tm-mb-55">
                    <center>
                        <img src="{{ Storage::url($about->gambar) }}" width="600" height="400" alt="Image"
                            class="tm-mb-40">
                    </center>

                    <p style="display: inline-block; margin-left: 20px; margin-right: 20px;">
                        {{ $about->tentang }}
                    </p>
                    </br> </br></br>

                    <h2 class="pt-2 tm-color-primary text-center mx-auto">K O N T A K</h2>
                    </br>

                    <div class="tm-mb-65", style="text-align: center;">
                        <a rel="nofollow" href="https://api.whatsapp.com/send?phone=62{{ $about->no_hp }}"
                            class="tm-social-link">
                            <i class="fab fa-whatsapp tm-social-icon"></i>
                        </a>
                        <a href="mailto:{{ $about->email }}" class="tm-social-link">
                            <i class="fab fa-at tm-social-icon"></i>
                        </a>
                        <a href="https://instagram.com/{{ $about->instagram }}" class="tm-social-link">
                            <i class="fab fa-instagram tm-social-icon"></i>
                        </a>

                    </div>
                </div>
            @endforeach


        </main>
    </div>
@endsection
