<?php

namespace App\Http\Controllers;

use App\Models\pointsModel;
use App\Models\polygonsModel;
use App\Models\polylinesModel;
use App\Models\User;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function __construct()
    {
        $this->points = new pointsModel();
        $this->polylines = new polylinesModel();
        $this->polygons = new polygonsModel();
        $this->users = new User();
    }

    public function landingpage()
    {
        $data=[
            'title' => 'PGWL',
            'points_count' => $this->points->count(),
            'polylines_count' => $this->polylines->count(),
            'polygons_count' => $this->polygons->count(),
            'user_count' => $this->users->count(),
        ];
        return view('home', $data);
    }


    public function map()
    {
    $data=[
        'title' => 'Peta Interaktif',
    ];
    return view('map', $data);
    }


    public function polygons()
    {
    $data=[
        'title' => 'Tabel Polygons',
        'polygons' => $this->polygons->all(),
    ];
    return view('table.table_polygons', $data);
    }

    public function polylines()
    {
    $data=[
        'title' => 'Tabel Polylines',
        'polylines' => $this->polylines->all(),
    ];
    return view('table.table_polylines', $data);
    }

    public function points()
    {
    $data=[
        'title' => 'Tabel Points',
        'points' => $this->points->all(),
    ];
    return view('table.table_points', $data);
    }
}
