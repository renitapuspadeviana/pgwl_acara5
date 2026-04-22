@extends('layouts.template')

@section('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css"/>

<style>
    body, html {
        margin: 0;
        padding: 0;
    }
    #map {
        height: 100vh;
        width: 100%;
    }
</style>
@endsection

@section('content')
<div id="map"></div>

{{-- MODAL POINT --}}
<div class="modal" tabindex="-1" id="modalInputPoint">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Input Point</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('points.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="text" class="form-control mb-2" name="name" placeholder="Name">
                    <textarea class="form-control mb-2" name="description" placeholder="Description"></textarea>
                    <textarea class="form-control" id="geometry_point" name="geometry_point"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>

{{-- MODAL POLYLINE --}}
<div class="modal" tabindex="-1" id="modalInputPolyline">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Input Polyline</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('polylines.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="text" class="form-control mb-2" name="name" placeholder="Name">
                    <textarea class="form-control mb-2" name="description" placeholder="Description"></textarea>
                    <textarea class="form-control" id="geometry_polyline" name="geometry_polyline"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>

{{-- MODAL POLYGON --}}
<div class="modal" tabindex="-1" id="modalInputPolygon">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Input Polygon</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('polygons.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="text" class="form-control mb-2" name="name" placeholder="Name">
                    <textarea class="form-control mb-2" name="description" placeholder="Description"></textarea>
                    <textarea class="form-control" id="geometry_polygon" name="geometry_polygon"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
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

<script>
var map = L.map('map').setView([-7.7956, 110.3695], 13);

// BASEMAP
L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; OpenStreetMap'
}).addTo(map);

// DRAWING
var drawnItems = new L.FeatureGroup();
map.addLayer(drawnItems);

var drawControl = new L.Control.Draw({
    draw: {
        polyline: true,
        polygon: true,
        rectangle: true,
        marker: true,
        circle: false,
        circlemarker: false
    },
    edit: false
});
map.addControl(drawControl);

map.on('draw:created', function(e) {
    var type = e.layerType,
        layer = e.layer;

    var geojson = layer.toGeoJSON();
    var wkt = Terraformer.geojsonToWKT(geojson.geometry);

    if (type === 'polyline') {
        $('#geometry_polyline').val(wkt);
        $('#modalInputPolyline').modal('show');
        $('#modalInputPolyline').on('hidden.bs.modal', function () {
            location.reload();
        });

    } else if (type === 'polygon' || type === 'rectangle') {
        $('#geometry_polygon').val(wkt);
        $('#modalInputPolygon').modal('show');
        $('#modalInputPolygon').on('hidden.bs.modal', function () {
            location.reload();
        });

    } else if (type === 'marker') {
        $('#geometry_point').val(wkt);
        $('#modalInputPoint').modal('show');
        $('#modalInputPoint').on('hidden.bs.modal', function () {
            location.reload();
        });
    }

    drawnItems.addLayer(layer);
});
    // GEOJSON Point
    var points = L.geoJSON(null, {
	// Style

	// onEachFeature
    onEachFeature: function (feature, layer) {
	// variable popup content
	var popup_content = "Nama: " + feature.properties.name + "<br>" +
		"Deskripsi: " + feature.properties.description + "<br>" +
		"Dibuat: " + feature.properties.created_at;

	layer.on({
		click: function (e) {
			points.bindPopup(popup_content);
		},
	});
},

});
    $.getJSON("{{ route('geojson_points') }}", function (data) {
	points.addData(data); // Menambahkan data ke dalam GeoJSON Point
	map.addLayer(points); // Menambahkan GeoJSON Point ke dalam peta
});

    // GEOJSON Polyline
    var polylines = L.geoJSON(null, {
	// Style

	// onEachFeature
    onEachFeature: function (feature, layer) {
	// variable popup content
	var popup_content = "Nama: " + feature.properties.name + "<br>" +
		"Deskripsi: " + feature.properties.description + "<br>" +
		"Dibuat: " + feature.properties.created_at;

	layer.on({
		click: function (e) {
			polylines.bindPopup(popup_content);
		},
	});
},

});
    $.getJSON("{{ route('geojson_polylines') }}", function (data) {
	polylines.addData(data); // Menambahkan data ke dalam GeoJSON Polyline
	map.addLayer(polylines); // Menambahkan GeoJSON Polyline ke dalam peta
});

    // GEOJSON Polygon
    var polygons = L.geoJSON(null, {
	// Style

	// onEachFeature
    onEachFeature: function (feature, layer) {
	// variable popup content
	var popup_content = "Nama: " + feature.properties.name + "<br>" +
		"Deskripsi: " + feature.properties.description + "<br>" +
		"Dibuat: " + feature.properties.created_at;

	layer.on({
		click: function (e) {
			polygons.bindPopup(popup_content);
		},
	});
},

});
    $.getJSON("{{ route('geojson_polygons') }}", function (data) {
	polygons.addData(data); // Menambahkan data ke dalam GeoJSON Polygon
	map.addLayer(polygons); // Menambahkan GeoJSON Polygon ke dalam peta
});

    // Control Layer
    var baseMaps = {

    };
    var overlayMaps = {
	"Points": points,
	"Polylines": polylines,
	"Polygons": polygons,
};
    var controllayer = L.control.layers(baseMaps, overlayMaps);
    controllayer.addTo(map);

</script>
@endsection
