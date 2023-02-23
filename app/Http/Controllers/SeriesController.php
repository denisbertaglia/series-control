<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Season;
use App\Models\Series;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
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
            "seasonsQts" => "required|min:1",
            "episodesSeasonsQts" => "required|min:1",
        ]);

        DB::transaction(function () use ($request) {
            /* Inserindo series */
            $seriesName = $request->name;

            /** @var User */
            $user = $request
                ->user();

            /** @var Series */
            $series = $user
                ->series()
                ->create([
                    'name' => $seriesName,
                ]);

            $seasons = [];
            for ($i = 1; $i <= $request->seasonsQts; $i++) {
                $seasons[] = [
                    'series_id' => $series->id,
                    'number' => $i,
                ];
            }
            Season::insert($seasons);

            $episodes = [];
            foreach ($series->seasons as $season) {
                for ($j = 1; $j <= $request->episodesSeasonsQts; $j++) {
                    $episodes[] = [
                        'season_id' => $season->id,
                        'number' => $j
                    ];
                }
            }
            Episode::insert($episodes);
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
