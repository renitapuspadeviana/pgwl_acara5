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

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $request->validate(
    [
        'name' => 'required|string|max:255',
        'geometry_point' => 'required',
        'description' => 'required|string',
    ],
    [
        'name.required' => 'Nama wajib diisi.',
        'geometry_point.required' => 'Geometri point wajib diisi.',
        'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
        'name.string' => 'Nama harus berupa string.',
        'description.required' => 'Deskripsi wajib diisi.',
        'description.string' => 'Deskripsi harus berupa string.',
    ]
);

        $data = [
            'geom' => $request->geometry_point,
            'name' => $request->name,
            'description' => $request->description,
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
