@extends('layouts.template')
@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.8/css/dataTables.dataTables.css">
    <style>
        body{
            margin: 0;
            padding: 0;
        }
    </style>
@endsection

@section('content')
<div class="container mt-3">
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Tabel Data Point<p></p></h3>
    </div>
    <div class="card-body">
        <table class="table table-striped" id="tabeldatapoint">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Deskripsi</th>
                    <th>Foto</th>
                    <th>Tanggal Dibuat</th>

                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($points as $p)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $p['name'] }}</td>
                    <td>{{ $p['description'] }}</td>
                    <td>
                        <img src="{{ asset('storage/images' . '/' . $p['image']) }}" alt="" width="150">
                    </td>
                    <td>{{ $p['created_at'] }}</td>

                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>

<div class="container mt-3">
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Tabel Data Polyline<p></p></h3>
    </div>
    <div class="card-body">
        <table class="table table-striped" id="tabeldatapolyline">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Deskripsi</th>
                    <th>Foto</th>
                    <th>Tanggal Dibuat</th>

                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($polylines as $p)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $p['name'] }}</td>
                    <td>{{ $p['description'] }}</td>
                    <td>
                        <img src="{{ asset('storage/images' . '/' . $p['image']) }}" alt="" width="150">
                    </td>
                    <td>{{ $p['created_at'] }}</td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="container mt-3">
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Tabel Data Polygon<p></p></h3>
    </div>
    <div class="card-body">
        <table class="table table-striped" id="tabeldatapolygon">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Deskripsi</th>
                    <th>Foto</th>
                    <th>Tanggal Dibuat</th>

                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($polygons as $p)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $p['name'] }}</td>
                    <td>{{ $p['description'] }}</td>
                    <td>
                        <img src="{{ asset('storage/images' . '/' . $p['image']) }}" alt="" width="150">
                    </td>
                    <td>{{ $p['created_at'] }}</td>

                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.3.8/js/dataTables.js"></script>
<script>
    new DataTable('#tabeldatapoint');
    new DataTable('#tabeldatapolyline');
    new DataTable('#tabeldatapolygon');
</script>
@endsection
