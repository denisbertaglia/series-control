<?php

namespace App\Repositories\Eloquent;

use App\Http\Requests\Series\SeriesStoreRequest;
use App\Models\Episode;
use App\Models\Season;
use App\Repositories\SeriesRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class EloquentSeriesRepository implements SeriesRepository
{
    public function store(SeriesStoreRequest $request): void
    {
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
    }

    public function count(Request $request): int
    {
        return DB::transaction(function () use ($request) {

            /** @var User */
            $user = $request
                ->user();

            return $user
                ->series
                ->count();
        });
    }
}
