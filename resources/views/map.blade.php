@extends('layouts.template')

@section('styles')
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <!-- Leaflet Draw CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css">

    <style>
        body {
            margin: 0;
        }

        main{
    padding-top:90px;
}

#map{
    height:calc(100vh - 90px);
}

        .navbar-brand {
            font-weight: bold;
        }
           .layer-control {
        background: #fff;
        padding: 10px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.15);
        width: 200px;
    }

    .layer-control h6 {
        margin-bottom: 10px;
        font-weight: 600;
    }

    .layer-control label {
        display: flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 6px;
        font-size: 14px;
        cursor: pointer;
    }
   .search-box {
    position: absolute;
    bottom: 3%;
    left: 13%;
    transform: translateX(-50%);
    z-index: 9999;
    background: white;
    padding: 10px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.15);
    width: 300px;
}

.search-box input {
    width: 100%;
    padding: 6px 10px;
    border: 1px solid #ddd;
    border-radius: 6px;
}
    </style>
@endsection



    @section('content')
        <!-- Map Container -->
        <div id="map"></div>
        <div class="search-box">
    <input type="text" id="searchInput" placeholder="Cari nama lokasi...">
</div>

        <!-- Modal Form Input Point -->
       <div class="modal fade" id="inputPointModal" tabindex="-1"
     aria-labelledby="inputPointModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow">

            <div class="modal-header">
                <h5 class="modal-title" id="inputPointModalLabel">
                    <i class="fa-solid fa-location-dot me-2"></i>
                    Input Point
                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close">
                </button>
            </div>

            <form action="{{ route('points.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <div class="modal-body px-4">

                    <div class="row g-3">

                        <div class="col-12">
                            <label for="name" class="form-label">
                                Name
                            </label>

                            <input type="text"
                                   class="form-control"
                                   id="name"
                                   name="name"
                                   placeholder="Fill in the name of the point">
                        </div>

                        <div class="col-12">
                            <label for="description" class="form-label">
                                Description
                            </label>

                            <textarea class="form-control"
                                      id="description"
                                      name="description"
                                      rows="3"
                                      placeholder="Enter description"></textarea>
                        </div>

                        <div class="col-12">
                            <label for="geometry_point" class="form-label">
                                Geometry
                            </label>

                            <textarea class="form-control"
                                      id="geometry_point"
                                      name="geometry_point"
                                      rows="3"
                                      readonly></textarea>
                        </div>
                        <div class="col-12">
                            <select class="form-select" aria-label="Default select example" name="status" id="status">
  <option selected>Status Infrastruktur</option>
  <option value="Ringan">Ringan</option>
  <option value="Sedang">Sedang</option>
  <option value="Berat">Berat</option>
</select>
                        </div>

                        <div class="col-12">
                            <label for="image" class="form-label">
                                Image
                            </label>

                            <input class="form-control"
                                   type="file"
                                   id="image"
                                   name="image"
                                   onchange="document.getElementById('preview-image-point').src = window.URL.createObjectURL(this.files[0])">
                        </div>

                        <div class="col-12 text-center">
                            <img src=""
                                 alt="Preview Image"
                                 id="preview-image-point"
                                 class="img-thumbnail rounded"
                                 width="300">
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">
                        Close
                    </button>

                    <button type="submit"
                            class="btn btn-primary">
                        <i class="fa-solid fa-floppy-disk me-1"></i>
                        Save
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

        <!-- Modal Form Input [Polyline] -->
       <div class="modal fade" id="inputPolylineModal" tabindex="-1"
     aria-labelledby="inputPolylineModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow">

            <div class="modal-header">
                <h5 class="modal-title" id="inputPolylineModalLabel">
                    <i class="fa-solid fa-route me-2"></i>
                    Input Polyline
                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close">
                </button>
            </div>

            <form action="{{ route('polylines.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <div class="modal-body px-4">

                    <div class="row g-3">

                        <div class="col-12">
                            <label for="name" class="form-label">
                                Name
                            </label>

                            <input type="text"
                                   class="form-control"
                                   id="name"
                                   name="name"
                                   placeholder="Fill in the name of the polyline">
                        </div>

                        <div class="col-12">
                            <label for="description" class="form-label">
                                Description
                            </label>

                            <textarea class="form-control"
                                      id="description"
                                      name="description"
                                      rows="3"
                                      placeholder="Enter description"></textarea>
                        </div>

                        <div class="col-12">
                            <label for="geometry_polyline" class="form-label">
                                Geometry
                            </label>

                            <textarea class="form-control"
                                      id="geometry_polyline"
                                      name="geometry_polyline"
                                      rows="3"
                                      readonly></textarea>
                        </div>
                         <div class="col-12">
                            <select class="form-select" aria-label="Default select example" name="status" id="status">
  <option selected>Status Jalan</option>
  <option value="Ringan">Ringan</option>
  <option value="Sedang">Sedang</option>
  <option value="Berat">Berat</option>
</select>
                        </div>

                        <div class="col-12">
                            <label for="image" class="form-label">
                                Image
                            </label>

                            <input class="form-control"
                                   type="file"
                                   id="image"
                                   name="image"
                                   onchange="document.getElementById('preview-image-polyline').src = window.URL.createObjectURL(this.files[0])">
                        </div>

                        <div class="col-12 text-center">
                            <img src=""
                                 alt="Preview Image"
                                 id="preview-image-polyline"
                                 class="img-thumbnail rounded"
                                 width="300">
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">
                        Close
                    </button>

                    <button type="submit"
                            class="btn btn-primary">
                        <i class="fa-solid fa-floppy-disk me-1"></i>
                        Save
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>


        <div class="modal fade" id="inputPolygonModal" tabindex="-1"
     aria-labelledby="inputPolygonModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow">

            <div class="modal-header">
                <h5 class="modal-title" id="inputPolygonModalLabel">
                    <i class="fa-solid fa-draw-polygon me-2"></i>
                    Input Polygon
                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close">
                </button>
            </div>

            <form action="{{ route('polygons.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <div class="modal-body px-4">

                    <div class="row g-3">

                        <div class="col-12">
                            <label for="name" class="form-label">
                                Name
                            </label>

                            <input type="text"
                                   class="form-control"
                                   id="name"
                                   name="name"
                                   placeholder="Fill in the name of the polygon">
                        </div>

                        <div class="col-12">
                            <label for="description" class="form-label">
                                Description
                            </label>

                            <textarea class="form-control"
                                      id="description"
                                      name="description"
                                      rows="3"
                                      placeholder="Enter description"></textarea>
                        </div>

                        <div class="col-12">
                            <label for="geometry_polygon" class="form-label">
                                Geometry
                            </label>

                            <textarea class="form-control"
                                      id="geometry_polygon"
                                      name="geometry_polygon"
                                      rows="3"
                                      readonly></textarea>
                        </div>
                         <div class="col-12">
                            <select class="form-select" aria-label="Default select example" name="status" id="status">
  <option selected>Status Area</option>
  <option value="Ringan">Ringan</option>
  <option value="Sedang">Sedang</option>
  <option value="Berat">Berat</option>
</select>
                        </div>

                        <div class="col-12">
                            <label for="image" class="form-label">
                                Image
                            </label>

                            <input class="form-control"
                                   type="file"
                                   id="image"
                                   name="image"
                                   onchange="document.getElementById('preview-image-polygon').src = window.URL.createObjectURL(this.files[0])">
                        </div>

                        <div class="col-12 text-center">
                            <img src=""
                                 alt="Preview Image"
                                 id="preview-image-polygon"
                                 class="img-thumbnail rounded"
                                 width="300">
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">
                        Close
                    </button>

                    <button type="submit"
                            class="btn btn-primary">
                        <i class="fa-solid fa-floppy-disk me-1"></i>
                        Save
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

    @endsection



@section('scripts')

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>
<script src="https://unpkg.com/@terraformer/wkt"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- 🔥 HEATMAP -->
<script src="https://unpkg.com/leaflet.heat/dist/leaflet-heat.js"></script>

<script>


    // =========================
    // BASE MAP
    // =========================
    var map = L.map('map').setView([-7.7956, 110.3695], 13);

    var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19
    }).addTo(map);

    var esri = L.tileLayer(
        'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}'
    );

// =========================
// 🔥 SEARCH VARIABLES
// =========================
var allFeatures = [];
var searchLayer = L.layerGroup().addTo(map);
    // =========================
    // 🔥 HEATMAP (UPGRADE VISUAL)
    // =========================
    var heatLayer = L.heatLayer([], {

        radius: 18,        // 🔥 lebih besar = lebih kelihatan
        blur: 18,          // smoothing lebih halus
        maxZoom: 17,

        // 🔥 INTENSITY SCALE
        minOpacity: 0.3,

        // 🔥 GRADIENT WARNA (IMPORTANT)
        gradient: {
            0.1: 'blue',
            0.3: 'cyan',
            0.5: 'lime',
            0.7: 'yellow',
            0.85: 'orange',
            1.0: 'red'
        }

    }).addTo(map);

    // =========================
    // 🔥 INTENSITY (lebih kontras)
    // =========================
    function getWeight(feature) {

        let s = feature.properties.status;

        if (s === "Ringan") return 0.4;
        if (s === "Sedang") return 0.7;
        if (s === "Berat") return 1.0;

        return 0.3;
    }

// =========================
// SEARCH FUNCTION
// =========================
function searchFeatures(keyword) {

    searchLayer.clearLayers();

    if (!keyword) return;

    keyword = keyword.toLowerCase();

    let results = allFeatures.filter(f => {

        let name = (f.properties.name || '').toLowerCase();
        let desc = (f.properties.description || '').toLowerCase();

        return name.includes(keyword) ||
               desc.includes(keyword);
    });

    results.forEach((f) => {

        let layer = L.geoJSON(f, {

            onEachFeature: function(feature, l) {

                let del = "#";
                let edit = "#";

                l.bindPopup(popup(feature, del, edit));

                // otomatis buka popup
                l.on('add', function() {
                    l.openPopup();
                });
            }

        });

        searchLayer.addLayer(layer);
    });

    // zoom ke hasil pertama
    if (results.length > 0) {

        let firstLayer = L.geoJSON(results[0]);

        let bounds = firstLayer.getBounds();

        if (bounds.isValid()) {
            map.fitBounds(bounds, {
                maxZoom: 18,
                padding: [20,20]
            });
        }
    }
}

// =========================

// =========================
// INPUT EVENT
// =========================
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("searchInput").addEventListener("keyup", function(e) {
        searchFeatures(e.target.value);
    });
});

// =========================
// POINTS
// =========================
var points = L.geoJSON(null, {
    onEachFeature: function(f, l) {

        let c = f.geometry.coordinates;
        heatLayer.addLatLng([c[1], c[0], getWeight(f) * 1.2]);

        let del = "{{ route('points.delete', ':id') }}".replace(':id', f.properties.id);
        let edit = "{{ route('point.edit', ':id') }}".replace(':id', f.properties.id);

        l.bindPopup(popup(f, del, edit));
    }
});

$.getJSON("{{ route('geojson_points') }}", function(d) {
    points.addData(d);
    map.addLayer(points);

    allFeatures = allFeatures.concat(d.features);
});
    // =========================
    // POINT → HEAT (FULL IMPACT)
    // =========================
    function addPointHeat(feature) {

        let c = feature.geometry.coordinates;

        let weight = getWeight(feature);

        heatLayer.addLatLng([
            c[1],
            c[0],
            weight * 1.2   // 🔥 boost biar kelihatan
        ]);
    }

    // =========================
    // LINE → HEAT (lebih padat)
    // =========================
   function addLineHeat(feature) {

    let coords = feature.geometry.coordinates;

    let weight = getWeight(feature) * 0.9;

    // jumlah titik sampling (semakin besar = semakin halus)
    let steps = 20;

    for (let i = 0; i < coords.length - 1; i++) {

        let p1 = coords[i];
        let p2 = coords[i + 1];

        let lat1 = p1[1];
        let lng1 = p1[0];

        let lat2 = p2[1];
        let lng2 = p2[0];

        for (let j = 0; j <= steps; j++) {

            let t = j / steps;

            let lat = lat1 + (lat2 - lat1) * t;
            let lng = lng1 + (lng2 - lng1) * t;

            heatLayer.addLatLng([
                lat,
                lng,
                weight
            ]);
        }
    }
}

    // =========================
    // POLYGON → HEAT (centroid + boost)
    // =========================
    function addPolygonHeat(feature) {

        let coords = feature.geometry.coordinates[0];

        let lat = 0;
        let lng = 0;

        coords.forEach(c => {
            lng += c[0];
            lat += c[1];
        });

        lat /= coords.length;
        lng /= coords.length;

        heatLayer.addLatLng([
            lat,
            lng,
            getWeight(feature) * 1.5   // 🔥 paling dominan
        ]);
    }

    // =========================
    // DRAW CONTROL
    // =========================
    var drawnItems = new L.FeatureGroup();
    map.addLayer(drawnItems);

    map.addControl(new L.Control.Draw({
        draw: {
            polyline: true,
            polygon: true,
            rectangle: true,
            marker: true,
            circle: false,
            circlemarker: false
        },
        edit: false
    }));

    map.on('draw:created', function(e) {

        let layer = e.layer;
        let type = e.layerType;

        let geo = layer.toGeoJSON();
        let wkt = Terraformer.geojsonToWKT(geo.geometry);

        if (type === 'marker') {
            $('#geometry_point').val(wkt);
            new bootstrap.Modal(document.getElementById('inputPointModal')).show();
        }

        if (type === 'polyline') {
            $('#geometry_polyline').val(wkt);
            new bootstrap.Modal(document.getElementById('inputPolylineModal')).show();
        }

        if (type === 'polygon' || type === 'rectangle') {
            $('#geometry_polygon').val(wkt);
            new bootstrap.Modal(document.getElementById('inputPolygonModal')).show();
        }

        drawnItems.addLayer(layer);
    });

    // =========================
    // POPUP
    // =========================

   function popup(feature, del, edit) {

    let p = feature.properties || {};

    let waktu = p.updated_at ? p.updated_at : p.created_at;
    waktu = waktu ? new Date(waktu).toLocaleDateString('id-ID') : '-';

    let img = p.image
        ? `<img src="{{ asset('storage/images/') }}/${p.image}" width="220" class="rounded mt-2">`
        : '';

    return `
        <div style="min-width:220px">

            <table class="table table-borderless table-sm mb-2">

                <tr>
                    <td><b>Nama</b></td>
                    <td>: ${p.name ?? '-'}</td>
                </tr>

                <tr>
                    <td><b>Status</b></td>
                    <td>: ${p.status ?? '-'}</td>
                </tr>

                <tr>
                    <td><b>Deskripsi</b></td>
                    <td>: ${p.description ?? '-'}</td>
                </tr>

                <tr>
                    <td><b>Waktu</b></td>
                    <td>: ${waktu}</td>
                </tr>

                <tr>
                    <td><b>Gambar</b></td>
                    <td></td>
                </tr>

                <tr>
                    <td colspan="2" class="text-center">
                        ${img}
                    </td>
                </tr>

            </table>

            <div class="d-flex gap-2 mt-2">

                <form action="${del}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm"
                        onclick="return confirm('Apakah Anda yakin ingin menghapus fitur ini?')">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                </form>

                <a href="${edit}" class="btn btn-warning btn-sm">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>

            </div>

        </div>
    `;
}
    // =========================
    // POINTS
    // =========================
    var points = L.geoJSON(null, {
        onEachFeature: function(f, l) {

            addPointHeat(f);

            let del = "{{ route('points.delete', ':id') }}".replace(':id', f.properties.id);
            let edit = "{{ route('point.edit', ':id') }}".replace(':id', f.properties.id);

            l.bindPopup(popup(f, del, edit));
        }
    });

    $.getJSON("{{ route('geojson_points') }}", function(d) {
        points.addData(d);
        map.addLayer(points);
    });

    // =========================
    // POLYLINES
    // =========================
    var lines = L.geoJSON(null, {
        onEachFeature: function(f, l) {

            addLineHeat(f);

            let del = "{{ route('polylines.delete', ':id') }}".replace(':id', f.properties.id);
            let edit = "{{ route('polyline.edit', ':id') }}".replace(':id', f.properties.id);

            l.bindPopup(popup(f, del, edit));
        }
    });

    $.getJSON("{{ route('geojson_polylines') }}", function(d) {
        lines.addData(d);
        map.addLayer(lines);
          allFeatures = allFeatures.concat(d.features);
    });

    // =========================
    // POLYGONS
    // =========================
    var polygons = L.geoJSON(null, {
        onEachFeature: function(f, l) {

            addPolygonHeat(f);

            let del = "{{ route('polygons.delete', ':id') }}".replace(':id', f.properties.id);
            let edit = "{{ route('polygon.edit', ':id') }}".replace(':id', f.properties.id);

            l.bindPopup(popup(f, del, edit));
        }
    });

    $.getJSON("{{ route('geojson_polygons') }}", function(d) {
        polygons.addData(d);
        map.addLayer(polygons);
            allFeatures = allFeatures.concat(d.features);
    });

    // =========================
    // LAYER CONTROL (lebih rapi)
    // =========================
  var LayerControl = L.Control.extend({
    options: { position: 'topright' },

    onAdd: function () {

        var div = L.DomUtil.create('div', 'layer-control');

        div.innerHTML = `
            <h6>Layer Control</h6>

            <label>
                <input type="checkbox" id="chkPoints" checked>
                Points
            </label>

            <label>
                <input type="checkbox" id="chkLines" checked>
                Polylines
            </label>

            <label>
                <input type="checkbox" id="chkPolygons" checked>
                Polygons
            </label>

            <label>
                <input type="checkbox" id="chkHeat" checked>
                Heatmap
            </label>
        `;

        // Disable map drag ketika hover panel
        L.DomEvent.disableClickPropagation(div);

        return div;
    }
});

map.addControl(new LayerControl());
document.addEventListener("change", function (e) {

    if (e.target.id === "chkPoints") {
        if (e.target.checked) map.addLayer(points);
        else map.removeLayer(points);
    }

    if (e.target.id === "chkLines") {
        if (e.target.checked) map.addLayer(lines);
        else map.removeLayer(lines);
    }

    if (e.target.id === "chkPolygons") {
        if (e.target.checked) map.addLayer(polygons);
        else map.removeLayer(polygons);
    }

    if (e.target.id === "chkHeat") {
        if (e.target.checked) map.addLayer(heatLayer);
        else map.removeLayer(heatLayer);
    }

});

</script>

@endsection
