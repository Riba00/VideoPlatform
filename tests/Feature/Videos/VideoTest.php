<?php

namespace Tests\Feature\Videos;

use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


/**
 * @covers \App\Http\Controllers\VideosController
 */
class VideoTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function users_can_view_videos()
    {
        //PREPARE
        //Wishful programming
        $video = Video::create([
            'title' => 'Title here',
            'description' => 'Description here',
            'url' => 'https://youtu.be/w8j07_DBl_I',
            'published_at' => Carbon::parse('December 13, 2020 8:00pm'),
            'previous' => null,
            'next' => null,
            'series_id' => 1
        ]);

        //EXECUTION
        // Http test
        $response = $this->get('/videos/' . $video->id);


        //ASSERTIONS
        $response->assertStatus(200);
        $response->assertSee('Title here');
        $response->assertSee('Description here');
        $response->assertSee('13 de desembre de 2020');
        $response->assertSee('https://youtu.be/w8j07_DBl_I');
    }

    /**
     * @test
     */
    public function users_can_not_view_not_existing_videos()
    {
        $response = $this->get('/videos/999');
        $response->assertStatus(404);

    }
}
