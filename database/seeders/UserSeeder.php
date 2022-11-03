<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\backend\UserSetting;
use App\Models\backend\Perfil;

// agregamos
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;

// Spatie
use Spatie\Permission\PermissionRegistrar;
use Spatie\Permission\Models\model_has_roles;
use Spatie\Permission\Models\model_has_permissions;

class UserSeeder extends Seeder
{
    public function __construct()
    {
        $users = [
            'admin' => [
                'name' => 'Super Admin',
                'email' => 'admin@email.com',
                'profile_photo_path' => 'public/storage/images/avatars/admin.png',
                'email_verified_at' => now(),
                'password' => Hash::make('0Admin'), //bcrypt('0Admin')
                'remember_token' => Str::random(10),
                'is_active' => 1,
            ],
            'guest' => [
                'name' => 'guest',
                'email' => 'guest@email.com',
                'profile_photo_path' => 'public/storage/images/avatars/guest.png',
                'email_verified_at' => now(),
                'password' => Hash::make('guest'), //bcrypt('guest')
                'remember_token' => Str::random(10),
                'is_active' => 1,
            ],
        ];

        foreach ($users as $user) {
            $u = User::create($user);
            if ($user['name'] == 'Super Admin') {
                // dd('creando super admin');
                $u->assignRole('super-admin');
                // All current roles will be removed from the user and replaced by the array given
                // $user->syncRoles(['super-admin']);
                $theme = 'light';
                $language = 'es-ES';
            } else {
                $theme = 'dark';
                $language = 'fr-FR';
            }
            //guardar un registro de configuracion para el usuario
            $s = DB::table('user_settings')->insert([
                'user_id' => $u['id'],
                'theme' => $theme,
                'language' => $language,
            ]);
        }
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $user = User::factory()
        //     // ->has(UserSetting::factory()->count(1), 'userSetting')
        //     ->count(48)
        //     ->create();

        // factory(App\User::class, 25)->create()->each(function ($user) {
        //     $user->profile()->save(factory(App\UserProfile::class)->make());
        // });
        $array1 = ['light', 'dark'];
        $array2 = ['es-ES', 'fr-FR', 'en-EN'];

        User::factory(48)
            ->create()
            ->each(function ($user) {
                // dump($user);
                $us = UserSetting::factory()->make();
                // dd($us->theme);
                DB::table('user_settings')->insert([
                    'user_id' => $user->id,
                    'theme' => $us->theme,
                    'language' => $us->language,
                    'autologin' => $us->autologin,
                ]);

                $p = Perfil::factory()->make();
                // dump($p);
                DB::table('perfiles')->insert([
                    'user_id' => $user->id,
                    'edad' => $p->edad,
                    'profesion' => $p->profesion,
                    'biografia' => $p->biografia,
                    'website' => $p->website,
                ]);
            });
        // dump($u);
        // UserSetting::factory()
        //     ->create()
        //     ->make([$u->id]);
        // Perfil::factory()
        //     ->create()
        //     ->make([$u->id]);

        // UserSetting::factory(1)->make([$u->id]);
        // Perfil::factory(1)->make([$u->id]);
        // foreach ($users as $key => $u) {
        //     UserSetting::factory(1)->make([$u->id]);
        //     dd($u);
        //     Perfil::factory(1)->make([$u->id]);
        // }
    }
}
