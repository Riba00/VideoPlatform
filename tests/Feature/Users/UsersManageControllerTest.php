<?php

namespace Tests\Feature\Users;

use App\Models\User;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

/**
 * @covers \App\Http\Controllers\UsersManageController
 */
class UsersManageControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_without_permissions_can_update_users()
    {
        $this->loginAsUsersManager();

        $user = User::create([
            'name' => 'PROVA update',
            'email' => 'PROVAUPDATE@PROVA.com',
            'password' => Hash::make('12345678'),
        ]);

        $response = $this->put('/manage/users/' . $user->id,[
            'name' => 'PROVA update AAAAA',
            'email' => 'PROVAUPDATEAAAAAAA@PROVA.com',
        ]);

        $response->assertRedirect(route('manage.users'));
        $response->assertSessionHas('status','Successfully updated');

        $newUser = User::find($user->id);
        $this->assertEquals('PROVA update AAAAA',$newUser->name);
        $this->assertEquals('PROVAUPDATEAAAAAAA@PROVA.com',$newUser->email);
        $this->assertEquals($user->id,$newUser->id);
    }

    /** @test */
    public function user_without_permissions_can_see_edit_users()
    {
        $this->withoutExceptionHandling();
        $this->loginAsUsersManager();

        $user = User::create([
            'name' => 'PROVA EDIT',
            'email' => 'PROVAEDIT@PROVA.com',
            'password' => Hash::make('12345678'),
        ]);
        $response = $this->get('/manage/users/' . $user->id);

        $response->assertStatus(200);
        $response->assertViewIs('users.manage.edit');
        $response->assertViewHas('user', function ($u) use ($user){
            return $user->is($u);
        });

        $response->assertSee('<form data-qa="form_user_edit" a', false);
        $response->assertSee($user->name);
        $response->assertSee($user->email);
    }

    /** @test */
    public function user_without_permissions_cannot_destroy_users()
    {
        $this->loginAsRegularUser();

        $user = User::create([
            'name' => 'PROVA',
            'email' => 'PROVA@PROVA.com',
            'password' => Hash::make('12345678'),
        ]);
        $response = $this->delete('/manage/users/' . $user->id);

        $response->assertStatus(403);
    }

    /** @test */
    public function user_with_permissions_can_destroy_users()
    {
        $this->loginAsUsersManager();

        $user = User::create([
            'name' => 'PROVA',
            'email' => 'PROVA@PROVA.com',
            'password' => Hash::make('12345678'),
        ]);

        $response = $this->delete('/manage/users/' . $user->id);
        $response->assertRedirect(route('manage.users'));
        $this->assertNull(User::find($user->id));
        $this->assertNull($user->fresh());
        $response->assertSessionHas('status', 'Successfully removed');
    }

    /** @test */
    public function user_without_permissions_cannot_store_users()
    {
        $this->loginAsRegularUser();

        $response = $this->post('/manage/users', [
            'name' => 'PROVA',
            'email' => 'PROVA@PROVA.com',
            'password' => Hash::make('12345678'),
        ]);

        $response->assertStatus(403);
    }

    /** @test */
    public function user_with_permissions_can_store_users()
    {
        $this->loginAsUsersManager();

        $user = objectify([
            'name' => 'PROVA',
            'email' => 'PROVA@PROVA.com',
            'password' => Hash::make('12345678'),
        ]);

        // API ENDPOINT
        $response = $this->post('/manage/users', [
            'name' => 'PROVA',
            'email' => 'PROVA@PROVA.com',
            'password' => Hash::make('12345678'),
        ]);

        $response->assertRedirect(route('manage.users'));

        $userDB = User::where('email', 'PROVA@PROVA.com')->first();

        $this->assertNotNull($userDB);
        $this->assertEquals($user->name, $userDB->name);
        $this->assertEquals($user->email, $userDB->email);
//        $this->assertTrue(Hash::check('12345678',$userDB->password));

        $response->assertSessionHas('status', 'Successfully created');

    }

    /** @test */
    public function user_with_permissions_can_manage_users()
    {
        $this->loginAsUsersManager();

        $user1 = create_video_manager_user();
        $user2 = create_regular_user();
        $user3 = create_superadmin_user();
        $users = collect([$user1, $user2, $user3]);

        $response = $this->get('/manage/users');

        $response->assertStatus(200);
        $response->assertViewIs('users.manage.index');
        $response->assertViewHas('users', function () use ($users) {
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
    public function regular_users_cannot_manage_users()
    {

        $this->loginAsRegularUser();
        $response = $this->get('/manage/users');
        $response->assertStatus(403);
    }

    /** @test */
    public function guest_users_cannot_manage_users()
    {

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
