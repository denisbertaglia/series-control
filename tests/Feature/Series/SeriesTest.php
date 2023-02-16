<?php

namespace Tests\Feature\Series;

use App\Models\Series;
use App\Models\Seasons;
use App\Models\Episode;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class SeriesTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_series_view_exist()
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get(route('series.index'));

        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_series_create_validate()
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->from(route('series.create'))
            ->post(
                route('series.store'),
                [

                    'name' => 'T',
                ]
            );

        $response->assertStatus(302);

        $response
            ->assertSessionHasErrors(['name'])
            ->assertRedirect(route('series.create'));
    }

    public function test_series_save()
    {
        $user = User::factory()->create();

        $serieName = "The simple Series";
        $response = $this
            ->actingAs($user)
            ->from(route('series.create'))
            ->post(
                route('series.store'),
                [
                    'name' => $serieName,
                    'seasonsQts' => 2,
                    'episodesSeasonsQts' => 24,
                ]
            );

        /** @var Collection<Series> */
        $series = $user->series->filter(fn ($series) => $series->name == $serieName);

        /** @var Collection<Seasons> */
        $seasons = $series->first()->seasons;

        /** @var Collection<Episode> */
        $episode = $seasons->first()->episodes;

        $this->assertNotEmpty($series, "The series does not exist in the database");
        $this->assertCount(2, $seasons, "The seasons of the series do not exist in the database");
        $this->assertCount(24, $episode, "The episode of the seasons do not exist in the database");


        $response
            ->assertRedirect(route('series.index'));
    }

    public function test_series_remove()
    {
        $user = User::factory()
            ->has(Series::factory()->count(2))
            ->create();
        /** @var Collection */
        $series = $user->series;

        $response = $this
            ->actingAs($user)
            ->from(route('series.index'))
            ->delete(
                route(
                    'series.destroy',
                    [
                        'series' => $series->first()
                    ]
                )
            );

        $user->refresh();

        $this->assertCount(1, $user->series, "There are 2 series in the database instead of 1");
        $response
            ->assertRedirect(route('series.index'));
    }

    public function test_screen_of_series_update_can_be_rendered()
    {
        $user = User::factory()
            ->has(Series::factory()->count(2))
            ->create();

        /** @var  Series */
        $series = $user->series->first();

        $response = $this->actingAs($user)
            ->from(route('series.index'))
            ->get(
                route(
                    'series.edit',
                    [
                        'series' => $series->first()->id
                    ]
                )
            );

        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_series_update_can_be_done()
    {
        $serieName = "The Example 2";
        $user = User::factory()
            ->has(Series::factory()->count(2))
            ->create();

        /** @var  Series */
        $series = $user->series->first();
        $seriesId = $series->first()->id;

        $response = $this->actingAs($user)
            ->from(
                route(
                    'series.edit',
                    [
                        'series' => $seriesId
                    ]
                )
            )->patch(
                route(
                    'series.update',
                    [
                        'series' => $seriesId,
                        'name' => $serieName
                    ]
                )
            );
        $user->refresh();

        $seriesNewName = $user->series->first()->name;

        $response
            ->assertRedirect(route('series.index'));

        $this->assertEquals($serieName, $seriesNewName, "The name of the series has not changed");
    }
}
