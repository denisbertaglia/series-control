<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Season;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EpisodeController extends Controller
{
    public function index(Season $season)
    {
        $episodes = $season->episodes;
        $seriesId = $season->series_id;

        $episodesLastKey = $episodes->keys()->max();

        return view('episodes.index', compact('seriesId', 'episodes', 'season','episodesLastKey'));
    }

    public function create(Season $season)
    {
        return view('episodes.create', compact( 'season'));
    }

    public function store(Season $season, Request $request)
    {
        $request->validate([
            "episodesQts" => "required|min:1"
        ]);

        DB::transaction(function () use ($season, $request) {
            $seasonCount = $season->episodes->count();
            $seasonEpisodesQts = $seasonCount + $request->episodesQts;
            $episodes = [];
            for ($i = ($seasonCount + 1); $i <= $seasonEpisodesQts; $i++) {
                $episodes[] = [
                    'number' => $i,
                    'season_id'=> $season->id,
                ];
            }
            Episode::insert($episodes);
        });

        return redirect()->route('episodes.index', ['season' => $season]);
    }

    public function update(Season $season, Request $request)
    {

        $episodes = (is_null($request->episodes)) ? [] : $request->episodes;

        DB::transaction(function () use ($season, $episodes) {
            /** @var Collection<Episode> */
            $season->episodes
                ->each(function ($episode) use ($episodes) {
                    $episode->watched = in_array($episode->id, $episodes);
                });
            $season->push();
        });

        return redirect()->route('episodes.index', ['season' => $season]);
    }

    public function destroy(Season $season, Episode $episode)
    {

        /** @var Collection */
        $episodes = $season->episodes;

        $episodeHas = $episodes->contains(function (Episode $value, $key) use ($episode) {
            return $value->id == $episode->id;
        });

        DB::transaction(function () use ($episode, $episodeHas) {
            if ($episodeHas) {
                $episode->delete();
            }
        });


        return redirect()->route('episodes.index', ['season' => $season]);
    }
}
