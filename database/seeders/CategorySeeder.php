<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Track;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Soul',
            'Ambient',
            'Pop',
            'Rap',
            'Funk',
            'Rock',
            'Reggae / Dub',
            'Techno',
            'Electro'
        ];

        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }

        $tracksWithoutCategory = Track::whereNull('category_id')->get();

        $categories = Category::all();

        foreach ($tracksWithoutCategory as $track) {
            $randomCategory = $categories->random();
            $track->category()->associate($randomCategory);
            $track->save();
        }
    }
}