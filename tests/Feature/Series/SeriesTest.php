<?php

namespace Tests\Feature\Series;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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
            ->get('/series');

        $response->assertStatus(200);
    }

    public function test_series_create_validate()
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->from('/series/create')
            ->post('/series/store', [
                'name' => 'T',
            ]);

        $response->assertStatus(302);

        $response
            ->assertSessionHasErrors(['name'])
            ->assertRedirect('/series/create');
    }

    public function test_series_save()
    {
        $user = User::factory()->create();

        $serieName = "The simple Series";
        $response = $this
            ->actingAs($user)
            ->from('/series/create')
            ->post('/series/store', [
                'name' => $serieName,
            ]);
        $series = $user->series->filter(fn ($series) => $series->name == $serieName);

        $this->assertNotEmpty($series, "The series does not exist in the database");

        $response
            ->assertRedirect('/series');
    }
}
