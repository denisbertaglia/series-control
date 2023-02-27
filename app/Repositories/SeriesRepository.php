<?php

namespace App\Repositories;

use App\Http\Requests\Series\SeriesStoreRequest;

interface SeriesRepository
{
    public function store(SeriesStoreRequest $request);
}
