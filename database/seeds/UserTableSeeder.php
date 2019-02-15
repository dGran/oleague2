<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\VerifyUser;

use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

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

        $faker = Faker::create();
        foreach (range(1,40) as $index) {
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => bcrypt('secret'),
                'verified' => 1,
            ]);
        }
    }
}