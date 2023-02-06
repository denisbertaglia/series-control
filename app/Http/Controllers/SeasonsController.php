<?php

namespace App\Http\Controllers;

use App\Models\Season;
use App\Models\Series;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class SeasonsController extends Controller
{
    public function index(Series $series)
    {
        $seasons = $series->seasons;
        $seasonsLastKey = $seasons->keys()->max();

        return view('seasons.index', compact('seasons', 'series', 'seasonsLastKey'));
    }

    public function create(Series $series)
    {
        return view('seasons.create', compact('series'));
    }

    public function update(Series $series, Request $request)
    {
        $request->validate([
            "seasonsQts" => "required|min:1"
        ]);
        $seasonsQtsActive = $series
            ->seasons
            ->count();

        $seriesSeasonsQts = $request->seasonsQts;
        $seasons = [];
        for ($i = 1; $i <= $seriesSeasonsQts; $i++) {
            $seasons[] = new Season(
                [
                    'number' => $seasonsQtsActive + $i,
                ]
            );
        }
        $series
            ->seasons()
            ->saveMany($seasons);

        return redirect()->route('seasons.index', ['series' => $series]);
    }

    public function delete(Series $series, Season $season)
    {
        /** @var Collection */
        $seasons = $series->seasons;

        $seasonHas = $seasons->contains(function (Season $value, $key) use ($season) {
            return $value->id == $season->id;
        });

        if ($seasonHas) {
            $season->delete();
        }

        return redirect()->route('seasons.index', ['series' => $series]);
    }
}
