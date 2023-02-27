<?php

namespace App\Http\Controllers;

use App\Http\Requests\Series\SeriesStoreRequest;
use App\Http\Requests\Series\SeriesUpdateRequest;
use App\Models\Episode;
use App\Models\Season;
use App\Models\Series;
use App\Models\User;
use App\Repositories\SeriesRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SeriesController extends Controller
{
    public function __construct(private SeriesRepository $seriesRepository)
    {
    }

    public function index(Request $request)
    {
        $user = $request->user();
        $seriesCollection = $user->series;

        return view('series.index', compact('seriesCollection'));
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(SeriesStoreRequest $request)
    {
        $this->seriesRepository->store($request);

        return redirect()->route('series.index');
    }

    public function edit(Series $series)
    {
        return view('series.edit', compact('series'));
    }

    public function update(Series $series, SeriesUpdateRequest $request)
    {
        $series->name = $request->name;
        $series->save();

        return redirect()->route('series.index');;
    }

    public function destroy(Series $series)
    {
        $series->delete();
        return redirect()->route('series.index');
    }
}
