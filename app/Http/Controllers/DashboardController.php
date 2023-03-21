<?php

namespace App\Http\Controllers;

use App\Repositories\SeriesRepository;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(private  SeriesRepository $seriesRepository)
    {
    }

    public function index(Request $request, SeriesRepository $seriesRepository)
    {
        $seriesCount = $this->seriesRepository->count($request);

        return view('dashboard', compact('seriesCount'));
    }
}
