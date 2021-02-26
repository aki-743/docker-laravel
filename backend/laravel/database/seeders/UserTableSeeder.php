<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_name = config('app.ADMIN_NAME');
        $hashed_password = Hash::make(config('app.ADMIN_PASSWORD'));
        $param = [
            'name' => $user_name,
            'password' => $hashed_password
        ];
        DB::table('users')->insert($param);
    }
}
