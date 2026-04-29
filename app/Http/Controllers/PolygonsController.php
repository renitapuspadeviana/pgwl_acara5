<?php

namespace App\Http\Controllers;

use App\Models\polygonsModel;
use Illuminate\Http\Request;

class PolygonsController extends Controller
{
    public function __construct()
    {
        $this->polygons = new polygonsModel();
    }

    public function store(Request $request)
    {
       $request->validate(
    [
        'name' => 'required|string|max:255',
        'geometry_polygon' => 'required',
        'description' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

    ],
    [
        'name.required' => 'Nama wajib diisi.',
        'geometry_polygon.required' => 'Geometri polygon wajib diisi.',
        'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
        'name.string' => 'Nama harus berupa string.',
        'description.required' => 'Deskripsi wajib diisi.',
        'description.string' => 'Deskripsi harus berupa string.',
        'image.image' => 'File harus berupa gambar.',
        'image.mimes' => 'Gambar harus berformat jpeg, png, jpg, atau gif.',
        'image.max' => 'Ukuran gambar tidak boleh lebih dari 2MB.',
    ]
);
         // Cek dan buat folder jika belum ada
        if (!is_dir('storage/images')) {
            mkdir('storage/images', 0777, true);
        }
        // Upload dan simpan gambar
        if ($request->hasFile('image')) {
            $image = $request->file('image');
                $name_image = time() . '_polygon.' . strtolower($image->getClientOriginalExtension());
                $image->move('storage/images', $name_image);
        } else {
            $name_image = null;
        }

        $data = [
            'geom' => $request->geometry_polygon,
            'name' => $request->name,
            'description' => $request->description,
            'image' => $name_image,
        ];


       if (!$this->polygons->create($data)){
        return redirect()->back()->with('error', 'Gagal menyimpan polygon');
       }

         // Kembali ke peta
            return redirect()->route('map')->with('success', 'Polygon berhasil disimpan');
    }
}
