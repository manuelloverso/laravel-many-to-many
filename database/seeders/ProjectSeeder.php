<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Project;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 10; $i++) {
            $newProject = new Project();
            $newProject->title = $faker->words(3, true);
            $newProject->slug = Str::slug($newProject->title, '-');
            $newProject->image = $faker->imageUrl(100, 70, 'Projects', true, $newProject->title, false, 'png');
            $newProject->description = $faker->words(20, true);
            $newProject->date = $faker->date();
            $newProject->save();
        }
    }
}
