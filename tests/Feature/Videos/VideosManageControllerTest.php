<?php

namespace Tests\Feature\Videos;

use App\Events\VideoCreated;
use App\Models\Serie;
use App\Models\User;
use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;

/**
 * @covers \App\Http\Controllers\VideosManageController
 */
class VideosManageControllerTest extends TestCase
{
    use RefreshDatabase, CanLogin;

    /** @test */
    public function user_with_permissions_can_update_videos()
    {
        $this->withoutExceptionHandling();
        $this->loginAsVideoManager();

        $video = Video::create([
            'title' => 'HTTP for noobs',
            'description' => 'bla bla bla',
            'url' => 'http://tubeme.acacha.org/http',
        ]);

        $response = $this->put('/manage/videos/' . $video->id, [
            'title' => 'HTTP for AAAAAAA',
            'description' => 'bla bla AAAAAA',
            'url' => 'http://tubeme.acacha.org/AAAAAAA',
        ]);

        $response->assertRedirect(route('manage.videos'));
        $response->assertSessionHas('status', 'Successfully updated');

        $newVideo = Video::find($video->id);
        $this->assertEquals('HTTP for AAAAAAA', $newVideo->title);
        $this->assertEquals('bla bla AAAAAA', $newVideo->description);
        $this->assertEquals('http://tubeme.acacha.org/AAAAAAA', $newVideo->url);
        $this->assertEquals($video->id, $newVideo->id);

    }

    /** @test */
    public function user_with_permissions_can_see_edit_videos()
    {
        $this->withoutExceptionHandling();
        $this->loginAsVideoManager();

        $video = Video::create([
            'title' => 'HTTP for noobs',
            'description' => 'bla bla bla',
            'url' => 'http://tubeme.acacha.org/http',
        ]);

        $response = $this->get('/manage/videos/' . $video->id);

        $response->assertStatus(200);
        $response->assertViewIs('videos.manage.edit');
        $response->assertViewHas('video', function ($v) use ($video) {
            return $video->is($v);
        });
        $response->assertSee('<form data-qa="form_video_edit" a', false);

        $response->assertSeeText($video->title);
        $response->assertSeeText($video->description);
        $response->assertSee($video->url);
    }

    /** @test */
    public function title_is_required()
    {
        $this->markTestIncomplete();
    }
    /** @test */
    public function description_is_required()
    {
        $this->markTestIncomplete();
    }
    /** @test */
    public function url_is_required()
    {
        $this->markTestIncomplete();
    }

    /** @test */
    public function user_with_permissions_cannot_destroy_videos()
    {
        $this->loginAsRegularUser();

        $video = Video::create([
            'title' => 'HTTP for noobs',
            'description' => 'bla bla bla',
            'url' => 'http://tubeme.acacha.org/http',
        ]);

        $response = $this->delete('/manage/videos/' . $video->id);

        $response->assertStatus(403);

    }

    /** @test */
    public function user_without_permissions_can_destroy_videos()
    {
        $this->loginAsVideoManager();

        $video = Video::create([
            'title' => 'HTTP for noobs',
            'description' => 'bla bla bla',
            'url' => 'http://tubeme.acacha.org/http',
        ]);

        $response = $this->delete('/manage/videos/' . $video->id);

        $response->assertRedirect(route('manage.videos'));

        $this->assertNull(Video::find($video->id));

        $this->assertNull($video->fresh());

        $response->assertSessionHas('status', 'Successfully removed');

    }

    /** @test */
    public function user_without_permissions_cannot_store_videos()
    {
        $this->loginAsRegularUser();

        $response = $this->post('/manage/videos', [
            'title' => 'HTTP for noobs',
            'description' => 'bla bla bla',
            'url' => 'http://tubeme.acacha.org/http',
        ]);

        $response->assertStatus(403);
    }

    /** @test */
    public function user_with_permissions_can_store_videos()
    {
        $this->withoutExceptionHandling();
        $this->loginAsVideoManager();

        $video = objectify($videoArray = [
            'title' => 'HTTP for noobs',
            'description' => 'bla bla bla',
            'url' => 'http://tubeme.acacha.org/http',
        ]);

        // API ENDPOINT
        $response = $this->post('/manage/videos', [
            'title' => 'HTTP for noobs',
            'description' => 'bla bla bla',
            'url' => 'http://tubeme.acacha.org/http',
        ]);

        Event::fake();
        $response = $this->post('/manage/videos', $videoArray);
        Event::assertDispatched(VideoCreated::class);

        $response->assertRedirect(route('manage.videos'));

        $videoDB = Video::first();

        $this->assertNotNull($videoDB);
        $this->assertEquals($video->title, $videoDB->title);
        $this->assertEquals($video->description, $videoDB->description);
        $this->assertEquals($video->url, $videoDB->url);
        $this->assertNull($video->published_at);

        $response->assertSessionHas('status', 'Successfully created');

    }

    /** @test */
    public function user_with_permissions_can_store_videos_with_serie()
    {
        $this->loginAsVideoManager();

        $serie = Serie::create([
            'title' => 'TDD (Test Driven Development)',
            'description' => 'Bla bla bla',
            'image' => 'tdd.png',
            'teacher_name' => 'Sergi Tur Badenas',
            'teacher_photo_url' => 'https://www.gravatar.com/avatar/' . md5('sergiturbadenas@gmail.com')
        ]);

        $video = objectify($videoArray = [
            'title' => 'HTTP for noobs',
            'description' => 'bla bla bla',
            'url' => 'https://tubeme.acacha.org/http',
            'serie_id' => $serie->id
        ]);

        // API ENDPOINT
        Event::fake();
        $response = $this->post('/manage/videos', $videoArray);
        Event::assertDispatched(VideoCreated::class);

        $response->assertRedirect(route('manage.videos'));

        $videoDB = Video::first();

        $this->assertNotNull($videoDB);
        $this->assertEquals($video->title, $videoDB->title);
        $this->assertEquals($video->description, $videoDB->description);
        $this->assertEquals($video->url, $videoDB->url);
        $this->assertEquals($videoDB->serie_id, $serie->id);
        $this->assertNull($video->published_at);

        $response->assertSessionHas('status', 'Successfully created');

    }

    /** @test */
    public function user_with_permissions_can_see_add_videos()
    {
        $this->loginAsVideoManager();

        $response = $this->get('/manage/videos');

        $response->assertStatus(200);
        $response->assertViewIs('videos.manage.index');

        $response->assertSee('<form data-qa="form_video_create" a', false);
    }

    /** @test */
    public function user_without_videos_manage_create_cannot_see_add_videos()
    {
        Permission::firstOrCreate(['name' => 'videos_manage_index']);

        $user = User::create([
            'name' => 'PEPE',
            'email' => 'PEPE',
            'password' => Hash::make('12345678')
        ]);
        $user->givePermissionTo('videos_manage_index');
        add_personal_team($user);
        Auth::login($user);

        $response = $this->get('/manage/videos');

        $response->assertStatus(200);
        $response->assertViewIs('videos.manage.index');

        $response->assertDontSee('<form data-qa="form_video_create"', false);
    }

    /** @test */
    public function user_with_permissions_can_manage_videos()
    {
        $this->loginAsVideoManager();

        $videos = create_sample_videos();

        $response = $this->get('/manage/videos');

        $response->assertStatus(200);
        $response->assertViewIs('videos.manage.index');
        $response->assertViewHas('videos', function ($v) use ($videos) {
            return $videos->count() === $videos->count() && get_class($videos) === Collection::class &&
                get_class($videos[0]) === Video::class;
        });

        foreach ($videos as $video) {
            $response->assertSee($video->id);
            $response->assertSee($video->title);
        }
    }

    /** @test */
    public function user_with_permissions_can_manage_videos_and_see_series()
    {
        $this->loginAsVideoManager();

        $videos = create_sample_videos();

        $serie = Serie::create([
            'title' => 'TDD (Test Driven Development)',
            'description' => 'Bla bla bla',
            'image' => 'tdd.png',
            'teacher_name' => 'Sergi Tur Badenas',
            'teacher_photo_url' => 'https://www.gravatar.com/avatar/' . md5('sergiturbadenas@gmail.com'),
            'created_at' => Carbon::now()->addSeconds(1)
        ]);

        $videos[0]->setSerie($serie);

        $response = $this->get('/manage/videos');

        $response->assertStatus(200);
        $response->assertViewIs('videos.manage.index');
        $response->assertViewHas('videos', function ($v) use ($videos) {
            return $videos->count() === $videos->count() && get_class($videos) === Collection::class &&
                get_class($videos[0]) === Video::class;
        });

        foreach ($videos as $video) {
            $response->assertSee($video->id);
            $response->assertSee($video->title);
            $response->assertSee($videos[0]->fresh()->serie->title);
        }
    }

    /** @test */
    public function regular_users_cannot_manage_videos()
    {

        $this->loginAsRegularUser();
        $response = $this->get('/manage/videos');
        $response->assertStatus(403);
    }

    /** @test */
    public function guest_users_cannot_manage_videos()
    {

        $response = $this->get('/manage/videos');
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function superadmins_can_manage_videos()
    {
        $this->loginAsSuperAdmin();

        $response = $this->get('/manage/videos');

        $response->assertStatus(200);
        $response->assertViewIs('videos.manage.index');
    }
}
