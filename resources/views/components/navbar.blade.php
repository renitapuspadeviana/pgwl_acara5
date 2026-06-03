<style>
    .custom-navbar{
        background: linear-gradient(
            135deg,
            #0A2647,
            #144272,
            #205295
        );
        box-shadow: 0 3px 15px rgba(0,0,0,0.15);
        padding-top: 12px;
        padding-bottom: 12px;
    }

    .custom-navbar .navbar-brand{
        font-size: 1.3rem;
        font-weight: 700;
        letter-spacing: 0.5px;
    }

    .custom-navbar .nav-link{
        color: rgba(255,255,255,0.9) !important;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .custom-navbar .nav-link:hover{
        color: #ffffff !important;
        transform: translateY(-2px);
    }

    .custom-navbar .btn{
        border-radius: 30px;
        font-weight: 600;
    }

    body{
        padding-top: 80px;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-dark custom-navbar fixed-top">
    <div class="container-fluid">

        <a class="navbar-brand" href="{{ route('home') }}">
            <i class="fa-solid fa-earth-asia me-2"></i>
            {{ $title }}
        </a>

        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse"
             id="navbarSupportedContent">

            <ul class="navbar-nav ms-auto align-items-center">

                <li class="nav-item mx-1">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="fas fa-home me-1"></i>
                        Beranda
                    </a>
                </li>

                <li class="nav-item mx-1">
                    <a class="nav-link" href="{{ route('map') }}">
                        <i class="fa-solid fa-map me-1"></i>
                        Peta
                    </a>
                </li>

                <li class="nav-item mx-1">
                    <a class="nav-link" href="{{ route('table') }}">
                        <i class="fa-solid fa-table me-1"></i>
                        Tabel
                    </a>
                </li>

                <li class="nav-item mx-1">
                    <a class="nav-link" href="#">
                        <i class="fa-solid fa-circle-info me-1"></i>
                        Tentang
                    </a>
                </li>

                @guest
                <li class="nav-item ms-3">
                    <a href="{{ route('login') }}"
                       class="btn btn-light btn-sm px-3">
                        <i class="fa-solid fa-arrow-right-to-bracket me-1"></i>
                        Login
                    </a>
                </li>
                @endguest

                @auth
                <li class="nav-item ms-3">
                    <form action="{{ route('logout') }}"
                          method="POST">
                        @csrf
                        <button type="submit"
                                class="btn btn-outline-light btn-sm px-3">
                            <i class="fa-solid fa-right-from-bracket me-1"></i>
                            Logout
                        </button>
                    </form>
                </li>
                @endauth

            </ul>

        </div>

    </div>
</nav>
