<?php

namespace App\Repositories\Eloquent;

use App\Http\Requests\Season\SeasonUpdateRequest;
use App\Models\Episode;
use App\Models\Season;
use App\Models\Series;
use App\Repositories\SeasonRepository;
use Illuminate\Support\Facades\DB;

class EloquentSeasonRepository implements SeasonRepository
{
    public function update(Series $series, SeasonUpdateRequest $request): void
    {
        DB::transaction(function () use ($series, $request) {
            $seasonsQtsActive = $series
                ->seasons
                ->count();

            $seriesSeasonsQts = $request->seasonsQts;
            $episodesSeasonsQts = $request->episodesSeasonsQts;
            $seasons = [];
            for ($i = 1; $i <= $seriesSeasonsQts; $i++) {
                $seasons[] =
                    new Season(
                        [
                            'number' => $seasonsQtsActive + $i,
                        ]
                    );
            }
            $seasons = $series
                ->seasons()
                ->saveMany($seasons);
            $episodes = [];
            foreach ($seasons as $key => $season) {
                for ($j = 1; $j <= $episodesSeasonsQts; $j++) {
                    $episodes[] =
                        [
                            'number' => $j,
                            'season_id' => $season->id,
                        ];
                }
            }
            Episode::insert($episodes);
        });
    }
}
