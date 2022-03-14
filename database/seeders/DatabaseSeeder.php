<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Repositories\Repository;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        touch('database/database.sqlite');
        $repository = new Repository();
        $repository->createDatabase();
        $repository->fillDatabase();  
    }
}
