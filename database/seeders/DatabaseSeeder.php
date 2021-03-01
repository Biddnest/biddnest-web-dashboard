<?php

namespace Database\Seeders;

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
//        \App\Models\Test::factory(10)->create();
         \App\Models\User::factory(100)->create();
         \App\Models\Admin::factory(10)->create();
//         \App\Models\Service::factory(3)->create();
//         \App\Models\Subservice::factory(10)->create();
    }
}
