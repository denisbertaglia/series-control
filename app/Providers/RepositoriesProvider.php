<?php

namespace App\Providers;

use App\Repositories\Eloquent\EloquentEpisodeRepository;
use App\Repositories\Eloquent\EloquentSeasonRepository;
use App\Repositories\Eloquent\EloquentSeriesRepository;
use App\Repositories\EpisodeRepository;
use App\Repositories\SeasonRepository;
use App\Repositories\SeriesRepository;
use Illuminate\Support\ServiceProvider;

class RepositoriesProvider extends ServiceProvider
{
    public array $bindings = [
        SeriesRepository::class => EloquentSeriesRepository::class,
        SeasonRepository::class => EloquentSeasonRepository::class,
        EpisodeRepository::class => EloquentEpisodeRepository::class,
    ];
}
