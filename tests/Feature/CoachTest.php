<?php

namespace Tests\Feature;

use App\Models\Coach;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class CoachTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate');
    }

    #[Test]
    public function it_can_list_all_coaches(): void
    {
        Coach::factory()->count(3)->create();

        $response = $this->getJson('/api/coach');

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data');
    }

    #[Test]
    public function it_can_create_a_coach(): void
    {
        $coachData = [
            'id' => Str::uuid(),
            'name' => 'John Doe',
            'years_of_experience' => 5,
            'hourly_rate' => 50.00,
            'city' => 'New York',
            'country' => 'USA',
            'start_date' => now(),
        ];

        $response = $this->postJson('/api/coach', $coachData);

        $response->assertStatus(201)
            ->assertJsonFragment(['name' => 'John Doe']);
    }

    #[Test]
    public function it_can_show_a_coach(): void
    {
        $coach = Coach::factory()->create();

        $response = $this->getJson("/api/coach/{$coach->id}");

        $response->assertStatus(200)
            ->assertJsonPath('data.id', (string)$coach->id);
    }

    #[Test]
    public function it_can_update_a_coach(): void
    {
        $coach = Coach::factory()->create();

        $updatedData = [
            'name' => 'Jane Doe',
            'years_of_experience' => 10,
            'hourly_rate' => 100.00,
            'city' => 'San Francisco',
            'country' => 'USA',
            'start_date' => now(),
        ];

        $response = $this->putJson("/api/coach/{$coach->id}", $updatedData);

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => 'Jane Doe']);
    }

    #[Test]
    public function it_can_delete_a_coach(): void
    {
        $coach = Coach::factory()->create();

        $response = $this->deleteJson("/api/coach/{$coach->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('coaches', ['id' => $coach->id]);
    }
}
