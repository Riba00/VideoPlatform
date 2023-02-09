<?php

namespace Tests\Feature\Videos;

use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

/**
 * @covers \App\Http\Controllers\VideosApiController::class
 */
class VideoApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_users_can_index_published_videos()
    {
        $videos = create_sample_videos();


        $response = $this->get('/api/videos');

        $response->assertStatus(200);

        $response->assertJsonCount(count($videos));
    }

    /** @test */
    public function guest_users_can_show_published_videos()
    {
//        $this->withoutExceptionHandling();
        $video = Video::create([
            'title' => 'TDD 101',
            'description' => 'Bla bla bla',
            'url' => 'https://www.youtube.com/watch?v=2NnTOzZBieM&list=PLyasg1A0hpk07HA0VCApd4AGd3Xm45LQv&index=26',
        ]);
        $response = $this->getJson('/api/videos/' . $video->id);

        $response->assertStatus(200);

        $response->assertSee($video->title);
        $response->assertSee($video->description);
        $response->assertSee($video->id);

        $response->assertJson(fn(AssertableJson $json) =>
                    $json->where('id', $video->id)
                        ->where('title', $video->title)
                        ->where('url', $video->url)
                        ->etc());
    }

    /** @test */
    public function guest_users_cannot_show_unexisting_videos()
    {
        $response = $this->get('/api/videos/9984');

        $response->assertStatus(404);
    }
}
