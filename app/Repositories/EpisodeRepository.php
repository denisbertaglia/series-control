<?php

namespace App\Repositories;

use App\Http\Requests\Episode\EpisodeStoreRequest;
use App\Models\Season;
use Illuminate\Http\Request;

interface EpisodeRepository
{
    public function store(Season $season, EpisodeStoreRequest $request): void;
    public function update(Season $season, Request $request): void;
}
