<?php

namespace App\Http\Controllers;
use App\Models\pointsModel;
use Illuminate\Http\Request;

class PointsController extends Controller
{

    public function __construct()
    {
        $this->points = new pointsModel();
    }

    public function store(Request $request)
    {
    $request->validate(
    [
        'name' => 'required|string|max:255',
        'geometry_point' => 'required',
        'description' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ],
    [
        'name.required' => 'Nama wajib diisi.',
        'geometry_point.required' => 'Geometri point wajib diisi.',
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
    // Upload dan simpan gambar
    if ($request->hasFile('image')) {
        $image = $request->file('image');

         $name_image = time() . '_point.' . strtolower($image->getClientOriginalExtension());

         $image->move('storage/images', $name_image);
    } else {
        $name_image = null;
    }

    $data = [
        'geom' => $request->geometry_point,
        'name' => $request->name,
        'description' => $request->description,
        'status' => $request->status,
        'image' => $name_image
    ];
        // Store the point data in the database
        if (!$this->points->create($data)){
            return redirect()->back()->with('error', 'Gagal menyimpan point');
            }

         // Kembali ke peta
         return redirect()->route('map')->with('success', 'Point berhasil disimpan');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data=[
        'title' => 'Edit Point',
        'id' => $id,
        ];
        return view('map-edit-point', $data);

    }

    /**
     * Update the specified resource in storage.
     */
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
                'geometry.required' => 'Geometri point wajib diisi.',
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

        // Mencari nama file gambar lama berdasarkan ID point
        $image_old = $this->points->find($id)->image;

        // Upload dan simpan gambar
        if ($request->hasFile('image')) {
            $image = $request->file('image');

             $name_image = time() . '_point.' . strtolower($image->getClientOriginalExtension());

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

        // Update the point data in the database
        if (!$this->points->find($id)->update($data)){
            return redirect()->back()->with('error', 'Gagal memperbarui data point');
            }

         // Kembali ke peta
         return redirect()->route('map')->with('success', 'Data point berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Mencari nama file gambar berdasarkan ID point
        $image = $this->points->find($id)->image;

        // Hapus data dari database
        if (!$this->points->destroy($id)){
        return redirect()->route('map')->with('error', 'Gagal menghapus point');
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
       return redirect()->route('map')->with('success', 'Point berhasil dihapus');


    }
}

