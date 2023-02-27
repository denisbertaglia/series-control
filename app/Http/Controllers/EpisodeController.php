<?php

namespace App\Http\Controllers;

use App\Http\Requests\Episode\EpisodeStoreRequest;
use App\Models\Episode;
use App\Models\Season;
use App\Repositories\EpisodeRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EpisodeController extends Controller
{
    public function __construct(private EpisodeRepository $episodeRepository)
    {
    }

    public function index(Season $season)
    {
        $episodes = $season->episodes;
        $seriesId = $season->series_id;

        $episodesLastKey = $episodes->keys()->max();

        return view('episodes.index', compact('seriesId', 'episodes', 'season', 'episodesLastKey'));
    }

    public function create(Season $season)
    {
        return view('episodes.create', compact('season'));
    }

    public function store(Season $season, EpisodeStoreRequest $request)
    {
        $this->episodeRepository->store($season,  $request);

        return redirect()->route('episodes.index', ['season' => $season]);
    }

    public function update(Season $season, Request $request)
    {
        $this->episodeRepository->update($season,  $request);

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
