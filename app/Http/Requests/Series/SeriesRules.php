<?php

namespace App\Http\Requests\Series;

trait SeriesRules
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function getSeriesRules(): array
    {
        return [
            "name" => ["required", "min:2"],
            "seasonsQts" => ["required", "min:1"],
            "episodesSeasonsQts" => ["required", "min:1"],
        ];
    }
}
