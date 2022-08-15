<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        \App\Models\User::factory(10)->create();
        \App\Models\AiBots::factory(1)->create();
        \App\Models\Channel::factory(10)->create();
        \App\Models\Chat::factory(500)->create();
        //$this->call(AiBotChannelSeeder::class);
    }
}
