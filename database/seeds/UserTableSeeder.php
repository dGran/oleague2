<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\VerifyUser;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$role_user = Role::where('name', 'user')->first();
        $role_admin = Role::where('name', 'admin')->first();

        $user = User::create([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => bcrypt('secret'),
            'verified' => 1
        ]);
        $user->save();
        $user->roles()->attach($role_user);

        $verifyUser = VerifyUser::create([
            'user_id' => $user->id,
            'token' => str_random(40)
        ]);

        $user = User::create([
            'name' => 'LPX',
            'email' => 'lpx@example.com',
            'password' => bcrypt('secret'),
            'verified' => 1
        ]);
        $user->save();
        $user->roles()->attach($role_admin);

        $verifyUser = VerifyUser::create([
            'user_id' => $user->id,
            'token' => str_random(40)
        ]);
    }
}