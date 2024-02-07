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
        // FATAL: this is extremly BAD idea !!! be warned !!! do something different to restrict `admin` username !!!
        // create admin account:
        // - the only goal here is to reserve username 'admin` (in the database row `username` is unique).
        // - this account MUST NOT be used to anything at all !!!.
        // ---- . ---- ---- ---- ---- . ----

        $admin_name = 'admin';
        $admin_user = User::where('username', $admin_name) -> first();
        if (is_null($admin_user)) {
            User::create([
                'username' => 'admin',
                'email' => 'admin@example.com',
                'password' => bcrypt(str_random(32)), // logic: since we don't want to use this account, we don't need to remember its password.
                                                      //        and if at any point in time, we will want to start using it, we can always manually overwrite the password in the DB.
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
