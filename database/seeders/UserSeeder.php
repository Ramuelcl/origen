<?php

namespace Database\Seeders;

use App\Models\User;

// agregamos
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
                // 'profile_photo_path'=>$this->faker->image('public/storage/images/avatars', $width = 640, $height = 480, null, false),
                'email_verified_at' => now(),
                'password' => Hash::make('0Admin'), //bcrypt('0Admin')
                'remember_token' => Str::random(10),
                'is_active' => 1,
            ],
            'guest' => [
                'name' => 'guest',
                'email' => 'guest@email.com',
                // 'profile_photo_path'=>$this->faker->image('public/storage/images/avatars', $width = 640, $height = 480, null, false),
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
            }
        }
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(48)->create();
    }
}
