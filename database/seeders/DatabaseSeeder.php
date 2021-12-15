<?php

namespace Database\Seeders;

use App\Models\Project;
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

        $this->call([
            UsersSeeder::class,
            StatusSeeder::class,
        ]);

        \App\Models\User::factory(9)->create();
        Project::factory(50)->create();
    }
}
