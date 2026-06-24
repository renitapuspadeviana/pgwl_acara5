<style>
    .navbar-navy {
        background: linear-gradient(135deg, #1a3a52 0%, #2d5a7b 100%) !important;
        backdrop-filter: blur(10px);
        box-shadow: 0 4px 30px rgba(26, 58, 82, 0.15) !important;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .navbar-navy .navbar-brand {
        font-weight: 900;
        letter-spacing: -0.5px;
        transition: transform 0.3s ease;
    }

    .navbar-navy .navbar-brand:hover {
        transform: scale(1.02);
    }

    .navbar-navy .navbar-brand span {
        color: #ffffff !important;
    }

    .navbar-navy .nav-link {
        color: rgba(255, 255, 255, 0.85) !important;
        font-weight: 500;
        position: relative;
        transition: all 0.3s ease;
        padding: 8px 12px !important;
        border-radius: 6px;
    }

    .navbar-navy .nav-link:hover {
        color: #ffffff !important;
        background: rgba(255, 255, 255, 0.1);
        transform: translateY(-2px);
    }

    .navbar-navy .nav-link::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        width: 0;
        height: 2px;
        background: linear-gradient(90deg, #3b82f6, #10b981);
        transition: all 0.3s ease;
        transform: translateX(-50%);
    }

    .navbar-navy .nav-link:hover::after {
        width: 80%;
    }

    .navbar-navy .dropdown-menu {
        background: linear-gradient(135deg, #1a3a52 0%, #253d5c 100%);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        padding: 8px 0;
    }

    .navbar-navy .dropdown-item {
        color: rgba(255, 255, 255, 0.85);
        padding: 12px 20px;
        transition: all 0.3s ease;
        border-radius: 6px;
        margin: 4px 8px;
    }

    .navbar-navy .dropdown-item:hover {
        background: rgba(255, 255, 255, 0.15);
        color: #ffffff;
        transform: translateX(4px);
    }

    .navbar-navy .navbar-toggler {
        border: none;
        padding: 6px 12px;
        border-radius: 6px;
        background: rgba(255, 255, 255, 0.15);
        transition: all 0.3s ease;
    }

    .navbar-navy .navbar-toggler:hover {
        background: rgba(255, 255, 255, 0.25);
    }

    .navbar-navy .navbar-toggler-icon {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 24'%3e%3cpath stroke='rgba(255, 255, 255, 0.9)' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M6 7h12M6 12h12M6 17h12'/%3e%3c/svg%3e");
    }

    .navbar-navy .btn-auth {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        border: none;
        color: white;
        font-weight: 600;
        padding: 8px 24px;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .navbar-navy .btn-auth:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(59, 130, 246, 0.4);
        color: white;
    }

    @media (max-width: 991px) {
        .navbar-navy {
            padding: 12px 0 !important;
        }
    }
</style>

<nav class="navbar navbar-expand-lg navbar-dark navbar-navy fixed-top py-3"
     data-navbar-on-scroll="data-navbar-on-scroll">

    <div class="container">

        <a class="navbar-brand d-flex align-items-center"
           href="{{ route('home') }}">

            <img class="img-fluid"
                 src="{{ asset('assets/img/gallery/logo-icon.png') }}"
                 alt="Logo"
                 width="45"
                 style="filter: brightness(1.1);">

            <span class="fw-bold fs-4 ps-3">
                {{ $title }}
            </span>

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

            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link"
                       href="{{ route('home') }}">
                        <i class="fas fa-home me-1"></i> Beranda
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link"
                       href="{{ route('map') }}">
                        <i class="fas fa-map me-1"></i> Peta
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle"
                       href="#"
                       id="spatialDropdown"
                       role="button"
                       data-bs-toggle="dropdown"
                       aria-expanded="false">
                        <i class="fas fa-layer-group me-1"></i> Tabel Data
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="spatialDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('points') }}">
                                <i class="fas fa-map-pin me-2"></i> Titik Kerusakan
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="{{ route('polylines') }}">
                                <i class="fas fa-road me-2"></i> Segmen Jalan
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="{{ route('polygons') }}">
                                <i class="fas fa-draw-polygon me-2"></i> Wilayah Monitoring
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>

            <div class="d-flex gap-2 ms-lg-3">
                @guest
                    <a href="{{ route('login') }}"
                       class="btn btn-auth btn-sm">
                        <i class="fas fa-sign-in-alt me-1"></i> Login
                    </a>
                @endguest

                @auth
                    <form action="{{ route('logout') }}"
                          method="POST"
                          class="m-0">
                        @csrf

                        <button class="btn btn-auth btn-sm"
                                type="submit">
                            <i class="fas fa-sign-out-alt me-1"></i> Logout
                        </button>

                    </form>
                @endauth
            </div>

        </div>

    </div>
</nav>
