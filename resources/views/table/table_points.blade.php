@extends('layouts.template')

@section('styles')

<link rel="stylesheet" href="https://cdn.datatables.net/2.3.8/css/dataTables.dataTables.css">

<style>
    body{
        background: #f5f8fb;
    }

    .table-card{
        border: none;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 6px 18px rgba(0,0,0,0.08);
    }

    .table-header{
        background: #0A2647;
        color: white;
        padding: 18px 22px;
        font-weight: 600;
    }

    table.dataTable{
        width: 100% !important;
    }

    table.dataTable thead th{
        background: #f1f5f9;
        border-bottom: none !important;
    }

    table.dataTable tbody tr:hover{
        background: #f8fafc;
    }

    img.table-img{
        border-radius: 10px;
        object-fit: cover;
    }
</style>

@endsection


@section('content')

<div class="container mt-4">

    {{-- CARD TABLE --}}
   <div class="card shadow border-0">

    {{-- HEADER --}}
    <div class="card-header bg-white border-bottom py-3">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold text-primary">
                <i class="fa-solid fa-location-dot me-2"></i>
                Tabel Data Point
            </h5>
        </div>
    </div>

    {{-- BODY --}}
    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-hover table-striped align-middle mb-0"
                   id="tabeldatapoint">

                <thead class="table-light">
                    <tr>
                        <th width="5%">No</th>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
                        <th width="15%">Foto</th>
                        <th width="20%">Tanggal Dibuat</th>
                    </tr>
                </thead>

                <tbody>

                    @php $no = 1; @endphp

                    @foreach ($points as $p)
                    <tr>

                        <td>{{ $no++ }}</td>

                        <td class="fw-semibold text-dark">
                            {{ $p['name'] }}
                        </td>

                        <td>
                            {{ $p['description'] }}
                        </td>
                        <td>
                            @if ($p['status'] === 'Ringan')
                                <span class="badge bg-soft-success text-success">
                                    {{ $p['status'] }}
                                </span>
                            @elseif ($p['status'] === 'Sedang')
                                <span class="badge bg-soft-warning text-warning">
                                    {{ $p['status'] }}
                                </span>
                            @elseif ($p['status'] === 'Berat')
                                <span class="badge bg-soft-danger text-danger">
                                    {{ $p['status'] }}
                                </span>
                            @endif
                        </td>

                        <td>
                            <img
                                src="{{ asset('storage/images/' . $p['image']) }}"
                                class="rounded shadow-sm"
                                width="120"
                                alt="foto">
                        </td>

                        <td>
                            <span class="badge bg-soft-primary text-primary">
                                {{ $p['created_at'] }}
                            </span>
                        </td>

                    </tr>
                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>

</div>

@endsection


@section('scripts')

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.3.8/js/dataTables.js"></script>

<script>
    new DataTable('#tabeldatapoint', {
        pageLength: 5,
        responsive: true
    });
</script>

@endsection
