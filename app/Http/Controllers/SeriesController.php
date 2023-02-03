<?php

namespace App\Http\Controllers;

use App\Models\Season;
use App\Models\Series;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        return view('series.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            "name" => "required|min:2",
            "seasonsQts" => "required|min:1"
        ]);

        DB::transaction(function () use ($request) {
            /* Inserindo series */
            $seriesName = $request->name;
            $series = new Series(['name' => $seriesName]);
            /** @var User */
            $user = $request
                ->user();

            /** @var Series */
            $series = $user
                ->series()
                ->save($series);
            $user->refresh();

            $seriesSeasonsQts = $request->seasonsQts;
            $seasons = [];
            for ($i = 1; $i <= $seriesSeasonsQts; $i++) {
                $seasons[] = new Season(
                    [
                        'number' => $i,
                    ]
                );
            }
            $series
                ->seasons()
                ->saveMany($seasons);
                
        });

        return redirect()->route('series.index');
    }

    public function edit(Series $series)
    {
        return view('series.edit', compact('series'));
    }

    public function update(Series $series, Request $request)
    {
        $request->validate([
            'name' => 'required|min:2',
        ]);
        $series->name = $request->name;
        $series->save();

        return redirect()->route('series.index');;
    }

    public function destroy(Series $series)
    {
        $series->delete();
        return redirect()->route('series.index');
    }
}
