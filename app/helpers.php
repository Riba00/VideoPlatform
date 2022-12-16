<?php

use App\Models\Team;
use App\Models\User;
use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

if (!function_exists('create_default_user')) {
    function create_default_user()
    {
        $user = User::create([
            'name' => config('casteaching.default_user.name', 'Sergi Tur Badenas'),
            'email' => config('casteaching.default_user.email', 'sergiturbadenas@gmail.com'),
            'password' => Hash::make(config('casteaching.default_user.password', '12345678'))
        ]);
        $user->superadmin = true;
        $user->save();

        add_personal_team($user);
    }
}
if (!function_exists('create_default_videos')) {

    function create_default_videos()
    {
        Video::create([
            'title' => 'Title here',
            'description' => 'Description here',
            'url' => 'https://youtu.be/w8j07_DBl_I',
            'published_at' => Carbon::parse('December 13, 2020 8:00pm'),
            'previous' => null,
            'next' => null,
            'series_id' => 1
        ]);
    }
}

if (!function_exists('create_regular_user')) {
    function create_regular_user()
    {
        $user = User::create([
            'name' => 'Pringao',
            'email' => 'pringao@casteaching.com',
            'password' => Hash::make('12345678')
        ]);
        add_personal_team($user);

        return $user;
    }
}

if (!function_exists('create_superadmin_user')) {
    function create_superadmin_user()
    {
        $user = User::create([
            'name' => 'SuperAdmin',
            'email' => 'superadmin@casteaching.com',
            'password' => Hash::make('12345678')
        ]);
        $user->superadmin = true;
        $user->save();

        add_personal_team($user);

        return $user;
    }
}

if (!function_exists('add_personal_team')) {
    function add_personal_team($user): void
    {
        try {
            $team = Team::forceCreate([
                'name' => $user->name . "'s Team",
                'user_id' => $user->id,
                'personal_team' => true
            ]);
        } catch (\Exception $exception) {
            dd($exception->getMessage());
        }
    }
}

if (!function_exists('create_video_manager_user')) {
    function create_video_manager_user()
    {
        $user = User::create([
            'name' => 'VideosManager',
            'email' => 'videosmanager@casteaching.com',
            'password' => Hash::make('12345678'),
        ]);

        Permission::create(['name' => 'videos_manage_index']);
        $user->givePermissionTo('videos_manage_index');
        add_personal_team($user);
        return $user;
    }
}

if (!function_exists('create_users_manager_user')) {
    function create_users_manager_user(){
        $user = User::create([
            'name' => 'UserManager',
            'email' => 'usersmanager@casteaching.com',
            'password' => Hash::make('12345678'),
        ]);

        Permission::create(['name' => 'users_manage_index']);
        $user->givePermissionTo('users_manage_index');
        add_personal_team($user);
        return $user;
    }
}



if (!function_exists('define_gates')) {
    function define_gates()
    {
        Gate::before(function ($user, $ability) {
            if ($user->isSuperAdmin()) {
                return true;
            }
        });
    }
}

if (!function_exists('create_permissions')) {
    function create_permissions()
    {
        Permission::firstOrCreate(['name' => 'videos_manage_index']);
        Permission::firstOrCreate(['name' => 'users_manage_index']);
    }
}

if (!function_exists('create_sample_videos')) {
    function create_sample_videos()
    {
        $video1 = Video::create([
            'title' => 'Video 1',
            'description' => 'Descripcio video 1',
            'url' => 'https://www.youtube.com/watch?v=zyABmm6Dw64&list=PLyasg1A0hpk07HA0VCApd4AGd3Xm45LQv&index=5'
        ]);
        $video2 = Video::create([
            'title' => 'Video 2',
            'description' => 'Descripcio video 2',
            'url' => 'https://www.youtube.com/watch?v=q06GbMP1h_s&list=PLyasg1A0hpk07HA0VCApd4AGd3Xm45LQv&index=2'
        ]);
        $video3 = Video::create([
            'title' => 'Video 3',
            'description' => 'Descripcio video 3',
            'url' => 'https://www.youtube.com/watch?v=ofSbYUEml4c&list=PLyasg1A0hpk07HA0VCApd4AGd3Xm45LQv&index=9&t=1520s'
        ]);
        return collect([$video1,$video2,$video3]);
    }
}
