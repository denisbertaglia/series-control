<?php

namespace Tests\Feature\Series;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SeriesTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_series_view()
    {
        $user = User::factory()->create();

        $response = $this
        ->actingAs($user)
        ->get('/series');
        
        $response->assertStatus(200);
    }
}
