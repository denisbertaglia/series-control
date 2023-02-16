<?php

namespace Tests\Feature\Episode;

use App\Models\Season;
use App\Models\Series;
use App\Models\User;
use App\Models\Episode;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EpisodeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     */
    public function test_see_season_episode()
    {
        $espisodeFactory = Episode::factory()->count(12);
        $seasonFactory = Season::factory()->has($espisodeFactory)->count(3);
        $seriesFactory = Series::factory()->has($seasonFactory)->count(1);
        $user = User::factory()->has($seriesFactory)->create();

        /** @var Series */
        $series = $user->series->first();
        $season = $series->seasons->first();

        $response = $this->actingAs($user)
            ->from(route('seasons.index', ['series' => $series]))
            ->get(route('episodes.index', ['season' => $season]));

        $response->assertSeeText('Season Episodes');
        $response->assertOk();
    }

    /**
     * @return void
     */
    public function test_can_see_episode_creation()
    {
        $espisodeFactory = Episode::factory()->count(12);
        $seasonFactory = Season::factory()->has($espisodeFactory)->count(3);
        $seriesFactory = Series::factory()->has($seasonFactory)->count(1);
        $user = User::factory()->has($seriesFactory)->create();

        $series = $user->series->first();
        $season = $series->seasons->first();

        $response = $this->actingAs($user)
            ->from(route('episodes.index', ['season' => $season]))
            ->get(route('episodes.create', ['season' => $season]));

        $response->assertSeeText('Episode Create');
        $response->assertOk();
    }

    /**
     * @return void
     */
    public function test_can_create_episode()
    {
        $espisodeFactory = Episode::factory()->count(12);
        $seasonFactory = Season::factory()->has($espisodeFactory)->count(3);
        $seriesFactory = Series::factory()->has($seasonFactory)->count(1);
        $user = User::factory()->has($seriesFactory)->create();

        $series = $user->series->first();
        /** @var Season  */
        $season = $series->seasons->first();

        $response = $this->actingAs($user)
            ->from(route('episodes.create', ['season' => $season]))
            ->post(
                route(
                    'episodes.store',
                    ['season' => $season]
                ),
                [
                    'episodesQts' => 2
                ]
            );
        $user->refresh();
        $seasonCount = $season->episodes->count();

        $this->assertEquals(14, $seasonCount, "Episode has not been added");
        $response->assertRedirect(route('episodes.index', ['season' => $season]));
    }

    public function test_can_mark_with_the_watched_episode()
    {
        $espisodeFactory = Episode::factory()->count(12);
        $seasonFactory = Season::factory()->has($espisodeFactory)->count(3);
        $seriesFactory = Series::factory()->has($seasonFactory)->count(1);
        $user = User::factory()->has($seriesFactory)->create();

        $series = $user->series->first();
        $season = $series->seasons->first();
        $episodes = $season->first()->episodes;

        $watchedEpisodes = $episodes->map(function ($episode, $key) {
            if ($key < 4) {
                return $episode->id;
            }
        })->filter()
            ->all();

        $response = $this->actingAs($user)
            ->from(route('episodes.index', ['season' => $season]))
            ->put(
                route(
                    'episodes.update',
                    ['season' => $season]
                ),
                [
                    'episodes' => $watchedEpisodes
                ]
            );
        $response->assertRedirect(route('episodes.index', ['season' => $season]));
        $season->refresh();

        $numberWatchedEpisodes = $season->first()->numberOfWatchedEpisodes();
        $this->assertEquals(4, $numberWatchedEpisodes, "The quantity of episodes watched isn't correct.");
    }

    /**
     * @return void
     */
    public function test_can_remove_episode()
    {
        $espisodeFactory = Episode::factory()->count(12);
        $seasonFactory = Season::factory()->has($espisodeFactory)->count(3);
        $seriesFactory = Series::factory()->has($seasonFactory)->count(1);
        $user = User::factory()->has($seriesFactory)->create();

        $series = $user->series->first();
        /** @var Season  */
        $season = $series->seasons->first();

        /** @var Episode  */
        $episodeEnd = $season->episodes->take(-1)->first()->id;;

        $response = $this->actingAs($user)
            ->from(route('episodes.index', ['season' => $season]))
            ->delete(
                route(
                    'episodes.destroy',
                    [
                        'season' => $season,
                        'episode' => $episodeEnd,
                    ]
                )
            );
        $season->refresh();
        $episodesCount = $season->episodes->count();

        $this->assertEquals(11, $episodesCount, "Episode has not been removed");
        $response->assertRedirect(route('episodes.index', ['season' => $season]));
    }
}
