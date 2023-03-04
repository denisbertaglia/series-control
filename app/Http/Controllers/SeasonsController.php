<?php

namespace App\Http\Controllers;

use App\Http\Requests\Season\SeasonUpdateRequest;
use App\Models\Season;
use App\Models\Series;
use App\Repositories\SeasonRepository;

class SeasonsController extends Controller
{
    public function __construct(private SeasonRepository $seasonRepository)
    {

    }
    public function index(Series $series)
    {
        $seasons = $series->seasons;
        $seasonsLastKey = $seasons->keys()->max();

        return view('seasons.index', compact('seasons', 'series', 'seasonsLastKey'));
    }

    public function create($series)
    {
        return view('seasons.create', compact('series'));
    }

    public function update(Series $series, SeasonUpdateRequest $request)
    {
        $this->seasonRepository->update($series, $request);

        return redirect()->route('seasons.index', ['series' => $series->id]);
    }

    public function delete(Series $series, Season $season)
    {

        $this->seasonRepository->delete($series, $season);

        return redirect()->route('seasons.index', ['series' => $series]);
    }
}
