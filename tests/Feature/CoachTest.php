<?php

namespace Tests\Feature;

use App\Models\Coach;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CoachTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
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
            ->assertJsonPath('data.id', (string) $coach->id);
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

    #[Test]
    public function it_can_search_coaches_by_name(): void
    {
        Coach::factory()->create(['name' => 'John Doe']);
        Coach::factory()->create(['name' => 'Jane Doe']);
        Coach::factory()->create(['name' => 'Alice Smith']);

        $response = $this->getJson('/api/coach?search=John');

        $response->assertStatus(200)
            ->assertJsonCount(1, 'data')
            ->assertJsonFragment(['name' => 'John Doe']);
    }

    #[Test]
    public function it_can_sort_coaches_by_hourly_rate_asc(): void
    {
        Coach::factory()->create(['hourly_rate' => 30.00]);
        Coach::factory()->create(['hourly_rate' => 40.00]);
        Coach::factory()->create(['hourly_rate' => 20.00]);

        $response = $this->getJson('/api/coach?sort_by=hourly_rate&sort=asc');

        $response->assertStatus(200);

        $coaches = $response->json('data');
        $this->assertEquals(20.00, $coaches[0]['hourly_rate']);
        $this->assertEquals(30.00, $coaches[1]['hourly_rate']);
        $this->assertEquals(40.00, $coaches[2]['hourly_rate']);
    }

    #[Test]
    public function it_can_sort_coaches_by_hourly_rate_desc(): void
    {
        Coach::factory()->create(['hourly_rate' => 30.00]);
        Coach::factory()->create(['hourly_rate' => 20.00]);
        Coach::factory()->create(['hourly_rate' => 40.00]);

        $response = $this->getJson('/api/coach?sort_by=hourly_rate&sort=desc');

        $response->assertStatus(200);

        $coaches = $response->json('data');
        $this->assertEquals(40.00, $coaches[0]['hourly_rate']);
        $this->assertEquals(30.00, $coaches[1]['hourly_rate']);
        $this->assertEquals(20.00, $coaches[2]['hourly_rate']);
    }

    #[Test]
    public function it_can_not_sort_coaches_by_invalid_sort_value(): void
    {
        Coach::factory()->create(['hourly_rate' => 30.00]);
        Coach::factory()->create(['hourly_rate' => 40.00]);
        Coach::factory()->create(['hourly_rate' => 20.00]);

        $response = $this->getJson('/api/coach?sort_by=hourly_rate&sort=invalid_sort');

        $response->assertStatus(400);
        $response->assertJson([
            'message' => "Invalid sortOrder: invalid_sort. Use 'asc' or 'desc'.",
        ]);
    }

    #[Test]
    public function it_can_not_sort_coaches_by_invalid_sort_by_value(): void
    {
        Coach::factory()->create(['hourly_rate' => 30.00]);
        Coach::factory()->create(['hourly_rate' => 40.00]);
        Coach::factory()->create(['hourly_rate' => 20.00]);

        $response = $this->getJson('/api/coach?sort_by=invalid_value&sort=asc');

        $response->assertStatus(400);
        $response->assertJson([
            'message' => 'Invalid sortBy: invalid_value. Allowed: name, hourly_rate.',
        ]);
    }
}
