<?php

namespace Tests\Feature\Seasons;

use App\Models\Season;
use App\Models\Series;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SeasonsTest extends TestCase
{
    use RefreshDatabase;

    public function test_season_of_a_series_can_be_seen()
    {
        $user = User::factory()
            ->has(
                Series::factory()
                    ->has(
                        Season::factory()
                            ->count(1)
                    )
                    ->count(1)
            )->create();
        $series = $user->series->first();
        $response = $this->actingAs($user)
            ->from(route('series.index'))
            ->get(route('seasons.index', ['series' => $series->id]));
        $response->assertOk();
    }

    public function test_season_of_a_series_can_be_added_with_the_series()
    {
        $user = User::factory()
            ->has(
                Series::factory()
                    ->has(Season::factory()->count(3))
                    ->count(1)
            )->create();
        $series = $user->series->first();
        $seasons = $series->seasons;

        $this->assertCount(3, $seasons);
    }

    public function test_season_of_a_series_can_be_add()
    {
        $user = User::factory()
            ->has(
                Series::factory()
                    ->has(Season::factory()->count(2))
                    ->count(1)
            )->create();
        $series = $user->series->first();

        $response = $this->actingAs($user)
            ->get(
                route(
                    'seasons.create',
                    [
                        'series' => $series->id,
                    ]
                )
            );
        $user->refresh();
        $response->assertOk();
    }

    public function test_season_of_a_series_can_be_added_later()
    {
        $user = User::factory()
            ->has(
                Series::factory()
                    ->has(Season::factory()->count(2))
                    ->count(1)
            )->create();
        $series = $user->series->first();
        $seasons = $series->seasons;
        $this->assertCount(2, $seasons);

        $response = $this->actingAs($user)
            ->from(
                route(
                    'seasons.create',
                    [
                        'series' => $series->id,
                    ]
                )
            )->put(
                route('seasons.update', ['series' => $series->id]),
                [
                    'seasonsQts' => 2,
                ]
            );
        $user->refresh();
        $response->assertRedirect(route('seasons.index', ['series' => $series->id]));

        $seasonsCount = $user
            ->series
            ->first()
            ->seasons;
        $this->assertCount(4, $seasonsCount, "The quantity of seasons isn't correct.");
    }

    public function test_season_of_a_series_can_be_removed()
    {
        $user = User::factory()
            ->has(
                Series::factory()
                    ->has(Season::factory()->count(2))
                    ->count(1)
            )->create();
        $series = $user->series->first();
        /** @var Season */
        $seasonLast = $series->seasons->last();

        $response = $this->actingAs($user)
            ->from(
                route(
                    'seasons.create',
                    [
                        'series' => $series->id,
                    ]
                )
            )->delete(
                route(
                    'seasons.delete',
                    [
                        'series' => $series->id,
                        'season' => $seasonLast->id,
                    ]
                ),
            );
        $user->refresh();

        $this->assertNull(Season::find($seasonLast->id), "The season has not been removed.");
        $response->assertRedirect();
    }
}
