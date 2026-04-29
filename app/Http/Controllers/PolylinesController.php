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
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ],
    [
        'name.required' => 'Nama wajib diisi.',
        'geometry_polyline.required' => 'Geometri polyline wajib diisi.',
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
                $name_image = time() . '_polyline.' . strtolower($image->getClientOriginalExtension());
                $image->move('storage/images', $name_image);
        } else {
            $name_image = null;
        }

        $data = [
            'geom' => $request->geometry_polyline,
            'name' => $request->name,
            'description' => $request->description,
            'image' => $name_image,
        ];

        if (!$this->polylines->create($data)){
        return redirect()->back()->with('error', 'Gagal menyimpan polylines');
       }

       // Kembali ke peta
       return redirect()->route('map')->with('success', 'Polyline berhasil disimpan');
    }
}
