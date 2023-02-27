<?php

namespace App\Repositories;

use App\Http\Requests\Season\SeasonUpdateRequest;
use App\Models\Series;

interface SeasonRepository
{
    public function update(Series $series, SeasonUpdateRequest $request): void;
}
