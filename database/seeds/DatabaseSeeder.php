<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name' => 'Marty McFly',
            'email' => 'martymcfly@savetheclocktower.com',
            'email_verified_at' => now(),
            'password' => Hash::make('jennifer'),
        ]);
        // let's build out these teams
        factory(App\Team::class, 10)
            ->create()
            ->each(function(\App\Team $team) {
                $team->players()->saveMany(factory(App\Player::class, 10)->create());
            });
    }
}
