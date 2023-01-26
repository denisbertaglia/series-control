<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function index()
    {
        $seriesCollection = [
            (object)[
                'name' =>'Series Example'
            ],
            (object)[
                'name' =>'Series Example'
            ],
            (object)[
                'name' =>'Series Example'
            ],
            (object)[
                'name' =>'Series Example'
            ],
            (object)[
                'name' =>'Series Example'
            ],
        ];

        return view('series.index', compact('seriesCollection'));
    }
}
