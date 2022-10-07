<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // admin
        $admin = [
            'first_name' => 'Master',
            'email' => 'master@master.com',
            'admin_role' => 1,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
        DB::table('users')->insert($admin);

        // other users
        \App\Models\User::factory(20)->create();

        $users = \App\Models\User::get();

        foreach ($users as $user) {
            for ($i=0; $i < 3; $i++) { 
                $user->accessibleTabs()->attach(\App\Models\AccessibleTab::get()->random()->id);
                $user->userRoles()->attach(\App\Models\UserRole::get()->random()->id);
            }
        }
    }
}
