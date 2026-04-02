<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function up(): void
    {
        // CategorySeeder up() is not standard, it's run()
    }

    public function run(): void
    {
        $categories = [
            'Politik',
            'Ekonomi',
            'Teknologi',
            'Hiburan',
            'Olahraga',
            'Kesehatan',
            'Internasional'
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => Str::slug($category)],
                ['name' => $category]
            );
        }
    }
}
