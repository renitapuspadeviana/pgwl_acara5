@extends('layouts.template')
@section('styles')
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
        <h3 class="card-title">Tabel Data</h3>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Renita</td>
                    <td>Karanganyar</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>John Doe</td>
                    <td>Jl. Merdeka No. 123</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Nina</td>
                    <td>Desa Cikarang</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>John Smith</td>
                    <td>Jl. Sudirman No. 456</td>
                <tr>
                    <td>5</td>
                    <td>John Doe</td>
                    <td>Jl. Merdeka No. 123</td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>John Doe</td>
                    <td>Jl. Merdeka No. 123</td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>Nina</td>
                    <td>Desa Cikarang</td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>John Smith</td>
                    <td>Jl. Sudirman No. 456</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
