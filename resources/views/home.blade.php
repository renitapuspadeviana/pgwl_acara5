@extends('layouts.template')

@section('styles')
<style>

body{
    background:#f8fafc;
}

/* HERO */

.hero-modern{
    background: linear-gradient(135deg,#0f172a,#1e293b);
    border-radius:30px;
    padding:70px;
    color:white;
    text-align:center;
    margin-bottom:50px;
    position:relative;
    overflow:hidden;
}

.hero-modern::before{
    content:'';
    position:absolute;
    width:400px;
    height:400px;
    right:-100px;
    top:-100px;
    border-radius:50%;
    background:rgba(255,255,255,.05);
}

.hero-badge{
    display:inline-block;
    padding:10px 20px;
    border-radius:999px;
    background:rgba(255,255,255,.1);
    backdrop-filter:blur(10px);
    margin-bottom:20px;
    font-size:14px;
}

.hero-modern h1{
    font-size:4rem;
    font-weight:800;
    margin-bottom:20px;
}

.hero-modern p{
    max-width:750px;
    margin:auto;
    opacity:.9;
    line-height:1.9;
    font-size:1.05rem;
}


/* STAT CARD */

.modern-stat-card{
    background:white;
    border-radius:24px;
    padding:28px;
    display:flex;
    align-items:center;
    gap:20px;
    box-shadow:0 10px 30px rgba(0,0,0,.06);
    transition:.3s;
}

.modern-stat-card:hover{
    transform:translateY(-8px);
}

.icon-box{
    width:70px;
    height:70px;
    border-radius:18px;
    display:flex;
    justify-content:center;
    align-items:center;
    font-size:28px;
}

.modern-stat-card h2{
    font-weight:800;
    margin:0;
    color:#0f172a;
}

.modern-stat-card span{
    color:#64748b;
}


/* SECTION */

.section-heading{
    font-weight:800;
    color:#0f172a;
}


/* FEATURE */

.feature-card{
    background:white;
    border-radius:24px;
    padding:35px;
    text-align:center;
    height:100%;
    border:1px solid #edf2f7;
    transition:.3s;
}

.feature-card:hover{
    transform:translateY(-10px);
    box-shadow:0 15px 40px rgba(0,0,0,.08);
}

.feature-card i{
    font-size:40px;
    margin-bottom:20px;
    color:#2563eb;
}

.feature-card h5{
    font-weight:700;
    margin-bottom:15px;
}

.feature-card p{
    color:#64748b;
    margin:0;
}


/* ABOUT */

.about-modern{
    background:white;
    border-radius:30px;
    padding:50px;
    box-shadow:0 10px 35px rgba(0,0,0,.05);
}

.mini-title{
    color:#2563eb;
    font-size:13px;
    font-weight:700;
    letter-spacing:2px;
}

.about-modern h2{
    margin-top:10px;
    font-weight:800;
    color:#0f172a;
}

.about-modern p{
    color:#64748b;
    line-height:1.9;
    margin:0;
}


/* BUTTON */

.btn-primary{
    background:#2563eb;
    border:none;
    border-radius:14px;
    padding:14px 28px;
    font-weight:600;
}

.btn-primary:hover{
    background:#1d4ed8;
}

</style>
@endsection


@section('content')

<div class="container py-5">

    {{-- HERO --}}
    <div class="hero-modern">

        <span class="hero-badge">
            <i class="fas fa-satellite-dish me-2"></i>
            Spatial Infrastructure Monitoring
        </span>

        <h1>
            Infrasight
        </h1>

        <p>
            Platform monitoring dan pelaporan kerusakan infrastruktur berbasis Sistem Informasi Geografis (SIG)
            yang dirancang untuk membantu identifikasi lokasi, dokumentasi kondisi lapangan,
            serta mendukung pengambilan keputusan secara cepat, akurat, dan terintegrasi.
        </p>

        <a href="{{ route('map') }}" class="btn btn-primary btn-lg mt-3">
            <i class="fas fa-map-marked-alt me-2"></i>
            Buka Dashboard Peta
        </a>

    </div>


    {{-- STATISTICS --}}
    <div class="row g-4 mt-3">

        <div class="col-md-4">

            <div class="modern-stat-card">

                <div class="icon-box bg-success-subtle">
                    <i class="fas fa-map-marker-alt text-success"></i>
                </div>

                <div>
                    <h2>{{ $points_count }}</h2>
                    <span>Titik Kerusakan</span>
                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="modern-stat-card">

                <div class="icon-box bg-primary-subtle">
                    <i class="fas fa-road text-primary"></i>
                </div>

                <div>
                    <h2>{{ $polylines_count }}</h2>
                    <span>Segmen Jalan</span>
                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="modern-stat-card">

                <div class="icon-box bg-warning-subtle">
                    <i class="fas fa-draw-polygon text-warning"></i>
                </div>

                <div>
                    <h2>{{ $polygons_count }}</h2>
                    <span>Wilayah Monitoring</span>
                </div>

            </div>

        </div>

    </div>


    {{-- FEATURES --}}
    <section class="mt-5">

        <div class="text-center mb-5">

            <h2 class="section-heading">
                Fitur Unggulan
            </h2>

            <p class="text-muted">
                Sistem dirancang untuk mendukung proses monitoring, pelaporan,
                dan pengelolaan kerusakan infrastruktur secara terintegrasi.
            </p>

        </div>

        <div class="row g-4">

            <div class="col-md-6 col-lg-3">

                <div class="feature-card">

                    <i class="fas fa-map-location-dot"></i>

                    <h5>Pemetaan Interaktif</h5>

                    <p>
                        Menampilkan lokasi kerusakan secara spasial dengan visualisasi peta yang responsif.
                    </p>

                </div>

            </div>

            <div class="col-md-6 col-lg-3">

                <div class="feature-card">

                    <i class="fas fa-pen-ruler"></i>

                    <h5>Digitasi Langsung</h5>

                    <p>
                        Tambahkan titik, garis, maupun area kerusakan langsung dari dashboard peta.
                    </p>

                </div>

            </div>

            <div class="col-md-6 col-lg-3">

                <div class="feature-card">

                    <i class="fas fa-database"></i>

                    <h5>Manajemen Data</h5>

                    <p>
                        Penyimpanan data spasial dan atribut secara terstruktur menggunakan Laravel.
                    </p>

                </div>

            </div>

            <div class="col-md-6 col-lg-3">

                <div class="feature-card">

                    <i class="fas fa-chart-line"></i>

                    <h5>Monitoring Real-Time</h5>

                    <p>
                        Mendukung pemantauan kondisi infrastruktur dan pembaruan data secara berkala.
                    </p>

                </div>

            </div>

        </div>

    </section>


    {{-- ABOUT --}}
    <section class="mt-5">

        <div class="about-modern">

            <div class="row align-items-center">

                <div class="col-lg-6">

                    <span class="mini-title">
                        TENTANG PLATFORM
                    </span>

                    <h2>
                        Monitoring Infrastruktur yang Lebih Efisien dan Terukur
                    </h2>

                </div>

                <div class="col-lg-6">

                    <p>
                        Infrasight dikembangkan sebagai platform WebGIS untuk mendukung proses
                        inventarisasi, monitoring, dan pelaporan kerusakan infrastruktur secara
                        terpusat. Sistem memungkinkan pengguna mengelola data spasial secara
                        interaktif sehingga proses identifikasi lokasi dan penentuan prioritas
                        penanganan dapat dilakukan dengan lebih cepat dan akurat.
                    </p>

                </div>

            </div>

        </div>

    </section>

</div>

@endsection
