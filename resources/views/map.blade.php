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

        #map {
            height: calc(100vh - 56px);
            /* dikurangi tinggi navbar */
        }

        .navbar-brand {
            font-weight: bold;
        }
    </style>
@endsection
</head>

<body>

    @section('content')
        <!-- Map Container -->
        <div id="map"></div>

        <!-- Modal Form Input Point -->
        <div class="modal" tabindex="-1" id="inputPointModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Input Point</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('points.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Fill in the name of the point">
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="geometry_point" class="form-label">Geometry</label>
                                <textarea class="form-control" id="geometry_point" name="geometry_point" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input class="form-control" type="file" id="image" name="image"
                                onchange="document.getElementById('preview-image-point').src = window.URL.createObjectURL(this.files[0])">
                            </div>
                            <div class="mb-3">
                                <img src="" alt="" id="preview-image-point" class="img-thumbnail" width="400">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Form Input [Polyline] -->
        <div class="modal" tabindex="-1" id="inputPolylineModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Input Polyline</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('polylines.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Fill in the name of the polyline">
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="geometry_polyline" class="form-label">Geometry</label>
                                <textarea class="form-control" id="geometry_polyline" name="geometry_polyline" rows="3"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input class="form-control" type="file" id="image" name="image"
                                onchange="document.getElementById('preview-image-polyline').src = window.URL.createObjectURL(this.files[0])">
                            </div>
                            <div class="mb-3">
                                <img src="" alt="" id="preview-image-polyline" class="img-thumbnail" width="400">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Form Input [Polygon] -->
        <div class="modal" tabindex="-1" id="inputPolygonModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Input Polygon</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('polygons.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Fill in the name of the polygon">
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="geometry_polygon" class="form-label">Geometry</label>
                                <textarea class="form-control" id="geometry_polygon" name="geometry_polygon" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input class="form-control" type="file" id="image" name="image"
                                onchange="document.getElementById('preview-image-polygon').src = window.URL.createObjectURL(this.files[0])">
                            </div>
                            <div class="mb-3">
                                <img src="" alt="" id="preview-image-polygon" class="img-thumbnail" width="400">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection

    @section('scripts')
        <!-- Leaflet JS -->
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <!-- Leaflet Draw JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>
        <!-- Terraformer JS -->
        <script src="https://unpkg.com/@terraformer/wkt"></script>
        <!-- jQuery JS -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>


        <script>
            // Koordinat Yogyakarta
            var yogyakarta = [-7.7956, 110.3695];

            // Inisialisasi peta
            var map = L.map('map').setView(yogyakarta, 13);

            // Basemap OpenStreetMap
            var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            // Basemap Satelit (Esri)
            var esriSat = L.tileLayer(
                'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                    attribution: 'Tiles &copy; Esri'
                }
            );

            /* Digitize Function */
            var drawnItems = new L.FeatureGroup();
            map.addLayer(drawnItems);

            var drawControl = new L.Control.Draw({
                draw: {
                    position: 'topleft',
                    polyline: true,
                    polygon: true,
                    rectangle: true,
                    circle: false,
                    marker: true,
                    circlemarker: false
                },
                edit: false
            });

            map.addControl(drawControl);

            map.on('draw:created', function(e) {
                var type = e.layerType,
                    layer = e.layer;

                console.log(type);

                var drawnJSONObject = layer.toGeoJSON();
                var objectGeometry = Terraformer.geojsonToWKT(drawnJSONObject.geometry);

                console.log(drawnJSONObject);
                console.log(objectGeometry);

                if (type === 'polyline') {
                    $('#geometry_polyline').val(objectGeometry);

                    console.log("Create " + type);
                    $('#inputPolylineModal').modal('show');

                    $('#inputPolylineModal').on('hidden.bs.modal', function() {
                        location.reload();
                    });

                } else if (type === 'polygon' || type === 'rectangle') {
                    console.log("Create " + type);
                    $('#geometry_polygon').val(objectGeometry);

                    console.log("Create " + type);
                    $('#inputPolygonModal').modal('show');

                    $('#inputPolygonModal').on('hidden.bs.modal', function() {
                        location.reload();
                    });


                } else if (type === 'marker') {
                    $('#geometry_point').val(objectGeometry);

                    $('#inputPointModal').modal('show');

                    $('#inputPointModal').on('hidden.bs.modal', function() {location.reload();});
                } else {
                    console.log('__undefined__');
                }

                drawnItems.addLayer(layer);
            });

            // GeoJSON Point
            var points = L.geoJSON(null, {
                // Style

                // onEachFeature
                onEachFeature: function(feature, layer) {
                    // variable popup content
                    var popup_content = "Nama: " + feature.properties.name + "<br>" +
                        "Deskripsi: " + feature.properties.description + "<br>" +
                        "Dibuat pada: " + feature.properties.created_at + "<br>" +
                        "Diperbarui pada: " + feature.properties.updated_at + "<br>" +
                        "<img src='{{ asset('storage/images/') }}/" + feature.properties.image +
                        "' alt='Image' width='300'>";

                    layer.on({
                        click: function(e) {
                            points.bindPopup(popup_content);
                        },
                    });
                },
            });

            $.getJSON("{{ route('geojson_points') }}",
                function(data) {
                    points.addData(data);
                    map.addLayer(points);
                });

            // GeoJSON Polyline
            var polylines = L.geoJSON(null, {
                // Style

                // onEachFeature
                onEachFeature: function(feature, layer) {
                    // variable popup content
                    var popup_content = "Nama: " + feature.properties.name + "<br>" +
                        "Deskripsi: " + feature.properties.description + "<br>" +
                        "Dibuat pada: " + feature.properties.created_at + "<br>" +
                        "Diperbarui pada: " + feature.properties.updated_at + "<br>" +
                        "<img src='{{ asset('storage/images/') }}/" + feature.properties.image +
                        "' alt='Image' width='300'>";

                    layer.on({
                        click: function(e) {
                            polylines.bindPopup(popup_content);
                        },
                    });
                },
            });

            $.getJSON("{{ route('geojson_polylines') }}",
                function(data) {
                    polylines.addData(data);
                    map.addLayer(polylines);
                });

            // GeoJSON Polygon
            var polygons = L.geoJSON(null, {
                // Style

                // onEachFeature
                onEachFeature: function(feature, layer) {
                    // variable popup content
                    var popup_content = "Nama: " + feature.properties.name + "<br>" +
                        "Deskripsi: " + feature.properties.description + "<br>" +
                        "Dibuat pada: " + feature.properties.created_at + "<br>" +
                        "Diperbarui pada: " + feature.properties.updated_at + "<br>" +
                        "<img src='{{ asset('storage/images/') }}/" + feature.properties.image +
                        "' alt='Image' width='300'>";

                    layer.on({
                        click: function(e) {
                            polygons.bindPopup(popup_content);
                        },
                    });
                },
            });

            $.getJSON("{{ route('geojson_polygons') }}",
                function(data) {
                    polygons.addData(data);
                    map.addLayer(polygons);
                });

            // Control Layer
            var overlayMaps = {
                "Points": points,
                "Polylines": polylines,
                "Polygons": polygons,
            };

            var controllayer = L.control.layers(null, overlayMaps);
            controllayer.addTo(map);
        </script>
    @endsection
