<?php

namespace Database\Seeders;

use App\Models\Gradebook;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GradebookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Gradebook::factory(5)->create();
    }
}
