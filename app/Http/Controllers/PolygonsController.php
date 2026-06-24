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
            'status' => $request->status,
            'image' => $name_image,
        ];


       if (!$this->polygons->create($data)){
        return redirect()->back()->with('error', 'Gagal menyimpan polygon');
       }

         // Kembali ke peta
            return redirect()->route('map')->with('success', 'Polygon berhasil disimpan');
    }


    public function edit(string $id)
    {
        $data=[
        'title' => 'Edit Polygon',
        'id' => $id,
        ];
        return view('map-edit-polygon', $data);

    }

    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'geometry' => 'required',
                'description' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ],
            [
                'name.required' => 'Nama wajib diisi.',
                'geometry.required' => 'Geometri polygon wajib diisi.',
                'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
                'name.string' => 'Nama harus berupa string.',
                'description.required' => 'Deskripsi wajib diisi.',
                'description.string' => 'Deskripsi harus berupa string.',
                'image.image' => 'File harus berupa gambar.',
                'image.mimes' => 'Gambar harus berformat jpeg, png, jpg, atau gif.',
                'image.max' => 'Ukuran gambar tidak boleh lebih dari 2MB    .',
            ]
        );

        // Cek dan buat folder jika belum ada
        if (!is_dir('storage/images')) {
            mkdir('storage/images', 0777, true);
        }

        // Mencari nama file gambar lama berdasarkan ID polygon
        $image_old = $this->polygons->find($id)->image;

        // Upload dan simpan gambar
        if ($request->hasFile('image')) {
            $image = $request->file('image');

             $name_image = time() . '_polygon.' . strtolower($image->getClientOriginalExtension());

             $image->move('storage/images', $name_image);

              // Hapus file gambar jika ada
              if ($image_old != null) {
                //cek apakah file gambar ada sebelum dihapus
                if (file_exists('./storage/images/' . $image_old)) {
                // Hapus file gambar
                unlink('./storage/images/' . $image_old);
                }
       }

        } else {
            $name_image = $image_old; // Jika tidak ada gambar baru, gunakan nama gambar lama
        }

        $data = [
            'geom' => $request->geometry,
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
            'image' => $name_image
        ];

        // Update the polygon data in the database
        if (!$this->polygons->find($id)->update($data)){
            return redirect()->back()->with('error', 'Gagal memperbarui data polygon');
            }

         // Kembali ke peta
         return redirect()->route('map')->with('success', 'Data polygon berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        // Mencari nama file gambar berdasarkan ID polygon
        $image = $this->polygons->find($id)->image;

        // Hapus data dari database
        if (!$this->polygons->destroy($id)){
        return redirect()->route('map')->with('error', 'Gagal menghapus polygon');
        }
       // Hapus file gambar jika ada
       if ($image != null) {
        //cek apakah file gambar ada sebelum dihapus
        if (file_exists('./storage/images/' . $image)) {
            // Hapus file gambar
                unlink('./storage/images/' . $image);
            }
       }
       // Kembali ke peta
       return redirect()->route('map')->with('success', 'Polygon berhasil dihapus');


    }
}
