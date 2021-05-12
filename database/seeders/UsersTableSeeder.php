<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$user = \App\Models\User::factory(10)->create();
        $user = \App\Models\User::create([
            'name'=>'Joseph Benjamin',
            'email'=>'johndoe@gmail.com',
            'password'=>bcrypt('password')
        ]);
        $user->restaurants()->create([
            'name'=>'GQ Lounge',
            'location'=>'Bodija, Ibadan'
        ]);

        $user->restaurants()->create([
            'name'=>'Highway Star',
            'location'=>'Bodija, Ibadan'
        ]);

        $user->restaurants()->create([
            'name'=>'Mainland China',
            'location'=>'Bodija, Ibadan'
        ]);
    }
}
