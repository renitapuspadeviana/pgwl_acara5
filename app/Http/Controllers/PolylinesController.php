<?php

namespace App\Http\Controllers;

use App\Models\polylinesModel;
use Illuminate\Http\Request;

class PolylinesController extends Controller
{
    public function __construct()
    {
        $this->polylines = new polylinesModel();
    }

    public function store(Request $request)
    {
        $request->validate(
    [
        'name' => 'required|string|max:255',
        'geometry_polyline' => 'required',
        'description' => 'required|string',
    ],
    [
        'name.required' => 'Nama wajib diisi.',
        'geometry_polyline.required' => 'Geometri polyline wajib diisi.',
        'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
        'name.string' => 'Nama harus berupa string.',
        'description.required' => 'Deskripsi wajib diisi.',
        'description.string' => 'Deskripsi harus berupa string.',
    ]
);
        $data = [
            'geom' => $request->geometry_polyline,
            'name' => $request->name,
            'description' => $request->description,
        ];

        if (!$this->polylines->create($data)){
        return redirect()->back()->with('error', 'Gagal menyimpan polylines');
       }

       // Kembali ke peta
       return redirect()->route('map')->with('success', 'Polyline berhasil disimpan');
    }
}
