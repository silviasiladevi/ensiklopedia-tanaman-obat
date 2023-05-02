<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>E-TOB | {{ $title }}</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400" rel="stylesheet" />
    <link href=" /fontawesome/css/all.css" rel="stylesheet">
    {{-- <link href="/css/templatemo-style.css" rel="stylesheet" />

    <link href="/css/style-responsive.css" rel="stylesheet" />
    {{-- <link href="admin/css/bootstrap.min.css" rel="stylesheet"> --}}

    <link rel="stylesheet" href="fontawesome/css/all.min.css"> <!-- https://fontawesome.com/ -->
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">
    <!-- https://fonts.google.com/ -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/all.min.css" rel="stylesheet">
    <link href="/css/templatemo-xtra-blog.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/f3e89af895.js" crossorigin="anonymous"></script>




</head>

<body style="background-color: #FEFAE0">


    <header class="tm-header" id="tm-header">
        <div class="tm-header-wrapper">
            <button class="navbar-toggler" type="button" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="tm-site-header">
                <div class="mb-3 mx-auto tm-site-logo">
                    <img src="/img/e-tob/logoputih.png" alt="logo" style="height: 100px">
                </div>

            </div>
            <nav class="tm-nav" id="tm-nav">
                <ul>
                    <li class="tm-nav-item {{ $title === 'tanamanObat' ? 'active' : '' }}"><a href="/"
                            class="tm-nav-link">
                            <i class="fas fa-home"></i>
                            Tanaman Obat
                        </a></li>



                    <li class="tm-nav-item {{ $kategori === 'kategori' ? 'active' : '' }}" data-toggle="collapse"
                        data-target="#kategoriCollapse" style="color:white">
                        <a class="tm-nav-link">
                            <i class="fas fa-clover"></i>
                            Kategori
                        </a>
                    </li>
                    <div class="collapse" id="kategoriCollapse">
                        <ul class="tm-nav-ul">
                            @foreach ($kategoris as $kategori)
                                <li class="tm-nav-item {{ $title === $kategori->kategori ? 'active' : '' }}">
                                    <a href="/guest/{{ $kategori->kategori }}"
                                        class="tm-nav-link">{{ $kategori->kategori }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>


                    <li class="tm-nav-item {{ $title === 'about' ? 'active' : '' }}"><a href="/about"
                            class="tm-nav-link">
                            <i class="fas fa-circle-info"></i>
                            About
                        </a></li>


                </ul>
            </nav>

        </div>
    </header>

    <main>
        @yield('container')

    </main>




    <script src="js/jquery.min.js"></script>

    <script src="js/templatemo-script.js"></script>


</body>
<footer class="tm-footer text-center" style="background-color: #FEFAE0">
    <p>Copyright &copy; Silvia Siladevi Gosal</p>
</footer>

<script>
    const searchInput = document.querySelector('#searchInput');
    let timeout = null;

    searchInput.addEventListener('keyup', function() {
        clearTimeout(timeout);
        timeout = setTimeout(function() {
            const query = searchInput.value.toLowerCase().trim();
            const posts = document.querySelectorAll('.tm-post');

            // Mengubah parameter URL dengan query pencarian
            const url = new URL(window.location.href);
            url.searchParams.set('query', query);
            window.history.replaceState({}, '', url);
            // hide pagination links
            const paginationLinks = document.querySelectorAll('.tm-paging-wrapper');
            paginationLinks.forEach(link => {
                link.style.display = 'none';
            });


            posts.forEach(post => {
                const title = post.querySelector('.tm-post-title').textContent.toLowerCase();
                const content = post.querySelector('p').textContent.toLowerCase();
                if (title.includes(query) || content.includes(query)) {
                    post.style.display = 'block';
                } else {
                    post.style.display = 'none';
                }
            });


            // show only the posts that match the search query
            const searchResults = document.querySelectorAll('.tm-post[style*="display: block"]');
            const searchCount = searchResults.length;

            // show the number of search results
            const searchCountEl = document.querySelector('#searchCount');
            searchCountEl.textContent = searchCount;

            // show the pagination links that match the number of search results
            const pagination = document.querySelector('.pagination');
            const totalPosts = pagination.getAttribute('data-total');
            const perPage = pagination.getAttribute('data-per-page');
            const totalPages = Math.ceil(totalPosts / perPage);
            const pageLinks = document.querySelectorAll('.pagination-link');

            if (searchCount > 0) {
                if (searchCount <= perPage) {
                    // show all the pagination links
                    pageLinks.forEach(link => {
                        link.style.display = 'block';
                    });
                } else {
                    // hide some pagination links
                    pageLinks.forEach(link => {
                        const page = link.getAttribute('data-page');
                        if (page <= totalPages && page >= 1 && page != 2 && page !=
                            totalPages && page != 1 && page != totalPages - 1) {
                            link.style.display = 'none';
                        } else {
                            link.style.display = 'block';
                        }
                    });
                }
            } else {
                // show all the pagination links
                pageLinks.forEach(link => {
                    link.style.display = 'block';
                });
            }

        }, 500);
    });
</script>
<script>
    $(document).ready(function() {
        // Inisialisasi komponen collapse
        $('[data-toggle="collapse"]').click(function() {
            var target = $(this).data('target');
            $(target).collapse('toggle');
        });
    });
</script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>


{{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script>
    const searchInput = document.querySelector('#searchInput');
    let timeout = null;

    searchInput.addEventListener('keyup', function() {
        clearTimeout(timeout);
        timeout = setTimeout(function() {
            const query = searchInput.value.toLowerCase().trim();
            const posts = $('.tm-post');

            // Mengubah parameter URL dengan query pencarian
            const url = new URL(window.location.href);
            url.searchParams.set('query', query);
            window.history.replaceState({}, '', url);

            posts.hide().filter(function() {
                const title = $(this).find('.tm-post-title').text().toLowerCase();
                const content = $(this).find('p').text().toLowerCase();
                return title.includes(query) || content.includes(query);
            }).show();

            // hide pagination links
            const paginationLinks = $('.pagination-link');
            paginationLinks.hide();

            // show only the posts that match the search query
            const searchResults = $('.tm-post[style*="display: block"]');
            const searchCount = searchResults.length;

            // show the number of search results
            const searchCountEl = $('#searchCount');
            searchCountEl.text(searchCount);

            // show the pagination links that match the number of search results
            const pagination = $('.pagination');
            const totalPosts = pagination.attr('data-total');
            const perPage = pagination.attr('data-per-page');
            const totalPages = Math.ceil(totalPosts / perPage);
            const pageLinks = $('.pagination-link');

            if (searchCount > 0) {
                if (searchCount <= perPage) {
                    // show all the pagination links
                    pageLinks.show();
                } else {
                    // hide some pagination links
                    pageLinks.each(function() {
                        const page = $(this).attr('data-page');
                        if (page <= totalPages && page >= 1 && page != 2 && page !=
                            totalPages && page != 1 && page != totalPages - 1) {
                            $(this).hide();
                        } else {
                            $(this).show();
                        }
                    });
                }
            } else {
                // show all the pagination links
                pageLinks.show();
            }

        }, 500);
    });
</script> --}}



<script>
    $(document).ready(function() {
        // Handle click on paging links
        $('.tm-paging-link').click(function(e) {
            e.preventDefault();

            var page = $(this).text().toLowerCase();
            $('.tm-gallery-page').addClass('hidden');
            $('#tm-gallery-page-' + page).removeClass('hidden');
            $('.tm-paging-link').removeClass('active');
            $(this).addClass("active");
        });
    });
</script>
@include('sweetalert::alert')

</html>
