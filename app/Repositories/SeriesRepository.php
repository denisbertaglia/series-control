<?php

namespace App\Repositories;

use App\Http\Requests\Series\SeriesStoreRequest;
use Illuminate\Http\Request;

interface SeriesRepository
{
    public function store(SeriesStoreRequest $request);
    public function count(Request $request): int;
}
