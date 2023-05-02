<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;

        $user->username = "superadmin";
        $user->password = bcrypt('superadmin');
        $user->fullname = "admin";
        $user->email = "admin@gmail.com";
        $user->nomor_hp = "08226271789";
        $user->jabatan = "admin";
        $user->save();
    }
}
