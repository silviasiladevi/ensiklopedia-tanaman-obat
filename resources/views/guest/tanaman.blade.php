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
            <!-- Search form -->
            <div class="row tm-row">
                <div class="col-12">
                    <form method="GET" action="/tanaman/search" class="form-inline tm-mb-80 tm-search-form">
                        <input class="form-control tm-search-input" name="query" type="text" placeholder="Search..."
                            aria-label="Search" id="searchInput" value="{{ session('search_query') }}">
                        <button class="tm-search-button" type="submit">
                            <i class="fas fa-search tm-search-icon" aria-hidden="true"></i>
                        </button>
                    </form>
                </div>
            </div>

            <div class="row tm-row">
                @foreach ($tanamen as $tanaman)
                    <article class="col-12 col-md-6 tm-post">
                        <hr class="tm-hr-primary">
                        <a href="/tanaman/{{ $tanaman->id }}/post" class="effect-lily tm-post-link tm-pt-60">
                            <div class="tm-post-link-inner">
                                <img src="{{ Storage::url($tanaman->gambar) }}" style="height: 300px;" alt="Image"
                                    class="img-fluid">
                            </div>
                            <span class="position-absolute tm-new-badge">{{ $tanaman->like_count }} likes</span>
                            <h2 class="tm-pt-30 tm-color-primary tm-post-title">{{ $tanaman->nama_tanaman }}</h2>
                        </a>
                        <p class="tm-pt-10">
                            {{ $tanaman->khasiat }}
                        </p>
                        <div class="d-flex justify-content-between tm-pt-10">
                            <span class="tm-color-primary">{{ $tanaman->kategori }}</span>
                            <span class="tm-color-primary">{{ $tanaman->created_at_formatted }}</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            {{-- <span>36 comments</span> --}}
                            <span>by {{ $tanaman->username }}</span>
                        </div>
                    </article>
                @endforeach


            </div>
            <div class="tm-paging-wrapper">
                <span class="d-inline-block mr-3">Page</span>
                {{ $tanamen->links('vendor/pagination/bootstrap-4') }}
            </div>

    </div>


    </main>
    </div>
@endsection
