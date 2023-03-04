<?php

namespace App\Repositories\Eloquent;

use App\Http\Requests\Episode\EpisodeStoreRequest;
use App\Models\Episode;
use App\Models\Season;
use App\Repositories\EpisodeRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EloquentEpisodeRepository implements EpisodeRepository
{
    public function store(Season $season, EpisodeStoreRequest $request): void
    {
        DB::transaction(function () use ($season, $request) {
            $seasonCount = $season->episodes->count();
            $seasonEpisodesQts = $seasonCount + $request->episodesQts;
            $episodes = [];
            for ($i = ($seasonCount + 1); $i <= $seasonEpisodesQts; $i++) {
                $episodes[] = [
                    'number' => $i,
                    'season_id' => $season->id,
                ];
            }
            Episode::insert($episodes);
        });
    }

    public function update(Season $season, Request $request): void
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
    }

    public function destroy(Season $season, Episode $episode): void
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
    }
}
