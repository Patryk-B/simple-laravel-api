<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ---- . ---- ---- ---- ---- . ----
        // create admin account:
        // ---- . ---- ---- ---- ---- . ----

        $admin_name = 'admin';
        $admin_user = User::where('username', $admin_name) -> first(); // FATAL: introduce roles and permissions !!! because `username` row is not unique !!! normal `user` can be named `admin` !!!
        if (is_null($admin_user)) {
            User::create([
                'username' => 'admin',
                'email' => 'admin@example.com',
                'password' => bcrypt($admin_name), // FATAL: THIS IS JUST FOR SHOW !!! NEVER DO THIS IRL !!! OR AT LEAST USE `.env` FILE !!!
            ]);
        }
        // else {
        //     dump('admin user already exists');
        //     dump($admin_user);
        // }

        // ---- . ---- ---- ---- ---- . ----
        // seed with fake users:
        // ---- . ---- ---- ---- ---- . ----

    }
}
