<nav class="navbar navbar-expand-lg navbar-light fixed-top py-3 bg-light shadow-sm"
     data-navbar-on-scroll="data-navbar-on-scroll">

    <div class="container">

        <a class="navbar-brand d-flex align-items-center"
           href="{{ route('home') }}">

            <img class="img-fluid"
                 src="{{ asset('assets/img/gallery/logo-icon.png') }}"
                 alt="Logo"
                 width="45">

            <span class="text-theme fw-bold fs-4 ps-2">
                {{ $title }}
            </span>

        </a>

        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse"
             id="navbarSupportedContent">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item px-2">
                    <a class="nav-link fw-medium"
                       href="{{ route('home') }}">
                        Beranda
                    </a>
                </li>

                <li class="nav-item px-2">
                    <a class="nav-link fw-medium"
                       href="{{ route('map') }}">
                        Peta
                    </a>
                </li>

            <li class="nav-item dropdown px-2">
    <a class="nav-link dropdown-toggle fw-medium"
       href="#"
       id="spatialDropdown"
       role="button"
       data-bs-toggle="dropdown"
       aria-expanded="false">
        Data Spasial
    </a>

    <ul class="dropdown-menu" aria-labelledby="spatialDropdown">
        <li>
            <a class="dropdown-item" href="{{ route('points') }}">
                Point
            </a>
        </li>

        <li>
            <a class="dropdown-item" href="{{ route('polylines') }}">
                Polyline
            </a>
        </li>

        <li>
            <a class="dropdown-item" href="{{ route('polygons') }}">
                Polygon
            </a>
        </li>
    </ul>
</li>


            </ul>

            @guest
                <a href="{{ route('login') }}"
                   class="btn btn-lg btn-dark bg-gradient">
                    Login
                </a>
            @endguest

            @auth
                <form action="{{ route('logout') }}"
                      method="POST">
                    @csrf

                    <button class="btn btn-lg btn-dark bg-gradient"
                            type="submit">
                        Logout
                    </button>

                </form>
            @endauth

        </div>

    </div>
</nav>
