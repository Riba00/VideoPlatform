<?php

namespace Tests\Feature\Users;

use App\Models\User;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

/**
 * @covers \App\Http\Controllers\UsersManageController
 */
class UsersManageControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_with_permissions_can_manage_users()
    {
        $this->loginAsUsersManager();

        $user1 = create_video_manager_user();
        $user2 = create_regular_user();
        $user3 = create_superadmin_user();
        $users = collect([$user1,$user2,$user3]);

        $response = $this->get('/manage/users');

        $response->assertStatus(200);
        $response->assertViewIs('users.manage.index');
        $response->assertViewHas('users',function () use ($users){
            return $users->count() === $users->count() && get_class($users) === Collection::class &&
                get_class($users[0]) === User::class;
        });

        foreach ($users as $user) {
            $response->assertSee($user->id);
            $response->assertSee($user->name);
            $response->assertSee($user->email);
            $response->assertSee($user->superadmin);
        }
    }

    /** @test */
    public function regular_users_cannot_manage_users(){

        $this->loginAsRegularUser();
        $response = $this->get('/manage/users');
        $response->assertStatus(403);
    }

    /** @test */
    public function guest_users_cannot_manage_users(){

        $response = $this->get('/manage/users');
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function superadmins_can_manage_users()
    {
        $this->loginAsSuperAdmin();

        $response = $this->get('/manage/users');

        $response->assertStatus(200);
        $response->assertViewIs('users.manage.index');
    }

    private function loginAsUsersManager()
    {
        Auth::login(create_user_manager_user());
    }

    private function loginAsSuperAdmin()
    {
        Auth::login(create_superadmin_user());
    }

    private function loginAsRegularUser()
    {
        Auth::login(create_regular_user());
    }
}
