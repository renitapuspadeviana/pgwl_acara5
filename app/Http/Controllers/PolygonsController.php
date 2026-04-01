<?php

namespace App\Http\Controllers;

use App\Models\polygonsModel; // ⚠️ sesuaikan nama model kamu
use Illuminate\Http\Request;

class PolygonsController extends Controller
{
    public function __construct()
    {
        $this->polygons = new polygonsModel(); // 🔥 INI WAJIB ADA
    }

    public function store(Request $request)
    {
       $request->validate(
    [
        'name' => 'required|string|max:255',
        'geometry_polygon' => 'required',
        'description' => 'required|string',
    ],
    [
        'name.required' => 'Nama wajib diisi.',
        'geometry_polygon.required' => 'Geometri polygon wajib diisi.',
        'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
        'name.string' => 'Nama harus berupa string.',
        'description.required' => 'Deskripsi wajib diisi.',
        'description.string' => 'Deskripsi harus berupa string.',
    ]
);
        $data = [
            'geom' => $request->geometry_polygon,
            'name' => $request->name,
            'description' => $request->description,
        ];

       if (!$this->polygons->create($data)){
        return redirect()->back()->with('error', 'Gagal menyimpan polygon');
       }

         // Kembali ke peta
            return redirect()->route('map')->with('success', 'Polygon berhasil disimpan');
    }
}
