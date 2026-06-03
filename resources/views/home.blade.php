@extends('layouts.template')

@section('styles')
<style>
    body{
        background-color: #f4f7fc;
    }

    .hero-banner{
        background: linear-gradient(135deg,#0A2647,#144272,#205295);
        color:white;
        padding:50px;
        border-radius:20px;
        margin-bottom:30px;
        box-shadow:0 10px 25px rgba(0,0,0,0.15);
    }

    .hero-banner h1{
        font-weight:700;
        margin-bottom:10px;
    }

    .hero-banner p{
        margin-bottom:0;
        opacity:0.9;
    }

    .dashboard-card{
        border:none;
        border-radius:20px;
        overflow:hidden;
        transition:all .3s ease;
        box-shadow:0 5px 15px rgba(0,0,0,0.08);
    }

    .dashboard-card:hover{
        transform:translateY(-8px);
    }

    .card-content{
        padding:25px;
        color:white;
        position:relative;
    }

    .card-content i{
        position:absolute;
        right:20px;
        top:20px;
        font-size:45px;
        opacity:0.3;
    }

    .card-content h5{
        font-size:16px;
        margin-bottom:15px;
    }

    .card-content h1{
        font-size:42px;
        font-weight:bold;
        margin:0;
    }

    .point-card{
        background:linear-gradient(135deg,#198754,#20c997);
    }

    .line-card{
        background:linear-gradient(135deg,#0d6efd,#6ea8fe);
    }

    .polygon-card{
        background:linear-gradient(135deg,#fd7e14,#ffc107);
    }

    .user-card{
        background:linear-gradient(135deg,#6f42c1,#d63384);
    }

    .about-card{
        border:none;
        border-radius:20px;
        box-shadow:0 5px 15px rgba(0,0,0,0.08);
    }

    .about-card .card-header{
        background:#0A2647;
        color:white;
        border-radius:20px 20px 0 0 !important;
        font-weight:bold;
    }
</style>
@endsection

@section('content')

<div class="container mt-4">

    <div class="hero-banner">
        <h1>🌍 WebGIS Dashboard</h1>
        <p>
            Sistem Informasi Geografis berbasis Laravel dan Leaflet.js untuk menampilkan
            data spasial dalam bentuk peta interaktif dan tabel informasi.
        </p>
    </div>

    <div class="row">

        <div class="col-md-3 mb-4">
            <div class="card dashboard-card">
                <div class="card-content point-card">
                    <i class="fa-solid fa-location-dot"></i>
                    <h5>Jumlah Titik</h5>
                    <h1>{{ $points_count }}</h1>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card dashboard-card">
                <div class="card-content line-card">
                    <i class="fa-solid fa-road"></i>
                    <h5>Jumlah Garis</h5>
                    <h1>{{ $polylines_count }}</h1>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card dashboard-card">
                <div class="card-content polygon-card">
                    <i class="fa-solid fa-draw-polygon"></i>
                    <h5>Jumlah Area</h5>
                    <h1>{{ $polygons_count }}</h1>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card dashboard-card">
                <div class="card-content user-card">
                    <i class="fa-solid fa-users"></i>
                    <h5>Jumlah User</h5>
                    <h1>{{ $user_count }}</h1>
                </div>
            </div>
        </div>

    </div>

    <div class="card about-card">
        <div class="card-header">
            Tentang Aplikasi
        </div>
        <div class="card-body">
            <p>
                Aplikasi ini dibuat untuk memenuhi tugas mata kuliah Pemrograman Web Lanjut.
                Sistem memanfaatkan framework Laravel sebagai backend dan Leaflet.js sebagai
                library pemetaan interaktif.
            </p>

            <p>
                Aplikasi mendukung visualisasi data geospasial berupa titik, garis, dan
                poligon, serta menyediakan informasi atribut dalam bentuk tabel untuk
                memudahkan pengelolaan dan analisis data spasial.
            </p>
        </div>
    </div>

</div>

@endsection
