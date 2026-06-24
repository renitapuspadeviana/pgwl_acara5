@extends('layouts.template')

@section('styles')
<style>
    body{
        background: #f5f8fb;
    }

    /* HERO (menyesuaikan gaya Zou gradient) */
    .hero-banner{
        background: linear-gradient(135deg,#0A2647,#144272,#205295);
        color: white;
        padding: 60px 50px;
        border-radius: 20px;
        margin-bottom: 40px;
        box-shadow: 0 15px 30px rgba(0,0,0,0.15);
        position: relative;
        overflow: hidden;
    }

    .hero-banner h1{
        font-weight: 800;
        font-size: 2.2rem;
        margin-bottom: 10px;
    }

    .hero-banner p{
        opacity: 0.9;
        max-width: 700px;
        line-height: 1.6;
        margin-bottom: 0;
    }

    /* DASHBOARD CARD */
    .dashboard-card{
        border: none;
        border-radius: 18px;
        overflow: hidden;
        transition: all .3s ease;
        box-shadow: 0 6px 18px rgba(0,0,0,0.08);
    }

    .dashboard-card:hover{
        transform: translateY(-6px);
        box-shadow: 0 12px 28px rgba(0,0,0,0.12);
    }

    .card-content{
        padding: 22px;
        color: white;
        position: relative;
    }

    .card-content i{
        position: absolute;
        right: 18px;
        top: 18px;
        font-size: 42px;
        opacity: 0.25;
    }

    .card-content h5{
        font-size: 14px;
        font-weight: 500;
        opacity: 0.95;
        margin-bottom: 10px;
    }

    .card-content h1{
        font-size: 38px;
        font-weight: 800;
        margin: 0;
    }

    /* COLOR STYLE (lebih soft & konsisten template) */
    .point-card{
        background: linear-gradient(135deg,#198754,#20c997);
    }

    .line-card{
        background: linear-gradient(135deg,#0d6efd,#6ea8fe);
    }

    .polygon-card{
        background: linear-gradient(135deg,#fd7e14,#ffb84d);
    }

    .user-card{
        background: linear-gradient(135deg,#6f42c1,#a66bff);
    }

    /* ABOUT CARD */
    .about-card{
        border: none;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 6px 18px rgba(0,0,0,0.08);
    }

    .about-card .card-header{
        background: #0A2647;
        color: white;
        font-weight: 600;
        padding: 18px 22px;
        border: none;
    }

    .about-card .card-body{
        padding: 22px;
        color: #555;
        line-height: 1.7;
    }

</style>
@endsection


@section('content')

<section class="py-0">

    {{-- BACKGROUND IMAGE --}}
    <div class="bg-holder d-none d-md-block"
         style="background-image:url({{ asset('assets/img/illustrations/landing.png') }}); background-position:right top; background-size:contain;">
    </div>

    <div class="container">
        <div class="row align-items-center min-vh-75 min-vh-lg-100">

            <div class="col-md-7 col-lg-6 col-xxl-5 py-6 text-sm-start text-center">

                <h1 class="mt-6 mb-sm-4 fw-semi-bold lh-sm fs-4 fs-lg-5 fs-xl-6">
                    🌍 WebGIS Dashboard<br class="d-block d-lg-block" />
                    Sistem Informasi Spasial Interaktif
                </h1>

                <p class="mb-4 fs-1">
                    Aplikasi berbasis Laravel dan Leaflet.js untuk visualisasi data spasial seperti
                    point, polyline, dan polygon, serta manajemen data atribut secara real-time.
                </p>

                <a class="btn btn-lg btn-success" href="{{ route('map') }}" role="button">
                    Lihat Peta
                </a>

            </div>

        </div>
    </div>

</section>

    {{-- STATS --}}
  <div class="row justify-content-center px-4">

    {{-- POINTS --}}
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100 shadow px-4 card-span pt-4 dashboard-card-hover">

            <div class="card-body text-center">

                <h6 class="fw-bold text-success mb-3">POINTS</h6>

                <h1 class="fw-bold display-5 text-success mb-0">
                    {{ $points_count }}
                </h1>

            </div>

        </div>
    </div>

    {{-- POLYLINES --}}
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100 shadow px-4 card-span pt-4 dashboard-card-hover">

            <div class="card-body text-center">

                <h6 class="fw-bold text-primary mb-3">POLYLINES</h6>

                <h1 class="fw-bold display-5 text-primary mb-0">
                    {{ $polylines_count }}
                </h1>

            </div>

        </div>
    </div>

    {{-- POLYGONS --}}
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100 shadow px-4 card-span pt-4 dashboard-card-hover">

            <div class="card-body text-center">

                <h6 class="fw-bold text-warning mb-3">POLYGONS</h6>

                <h1 class="fw-bold display-5 text-warning mb-0">
                    {{ $polygons_count }}
                </h1>

            </div>

        </div>
    </div>

  </div>

<section class="py-5" id="about">

    <div class="container">

        {{-- TITLE --}}
        <div class="row">
            <div class="col-lg-9 mx-auto text-center mb-4">

                <h5 class="fw-bold fs-3 fs-lg-5 lh-sm mb-3">
                    Tentang Aplikasi
                </h5>

                <p class="text-muted mb-5">
                    Sistem informasi geografis berbasis web untuk pengelolaan dan visualisasi data spasial.
                </p>

            </div>
        </div>

        {{-- CONTENT --}}
        <div class="row justify-content-center">

            <div class="col-lg-10">

                <div class="card border-0 shadow-lg rounded-4">

                    <div class="card-body p-5">

                        <p class="mb-4 fs-1">
                            Aplikasi WebGIS ini dikembangkan menggunakan framework
                            <strong>Laravel</strong> sebagai backend dan
                            <strong>Leaflet.js</strong> sebagai library pemetaan interaktif
                            untuk mendukung visualisasi data spasial.
                        </p>

                        <p class="mb-0 fs-1">
                            Sistem ini memungkinkan pengguna melakukan digitasi data geospasial
                            berupa <strong>titik, garis, dan poligon</strong>, serta mengelola atribut
                            dalam bentuk database terintegrasi untuk analisis dan pengambilan keputusan.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection
