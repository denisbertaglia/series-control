<?php

namespace App\Http\Controllers;

use App\Models\Series;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SeriesController extends Controller
{
    public function __construct()
    {
    }

    public function index(Request $request)
    {
        $user = $request->user();
        $seriesCollection = $user->series;

        return view('series.index', compact('seriesCollection'));
    }

    public function create()
    {
        $seriesCollection = [
            (object)[
                'name' => 'Series Example'
            ],
        ];
        return view('series.create', compact('seriesCollection'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|min:2',
        ]);

        $series = new Series(['name' => $request->name]);
        $user = $request
            ->user();
        $series = $user
            ->series()
            ->save($series);
        $user->refresh();

        return redirect()->route('series.index');
    }

    public function destroy(Series $series)
    {
        $series->delete();
        return redirect()->route('series.index');
    }
}
