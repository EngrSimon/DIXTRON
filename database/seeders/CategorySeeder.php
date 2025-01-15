<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $categories = [
            ['name' => 'Custom Built PCs', 'image' => 'category.jpg'],
            ['name' => 'Laptops', 'image' => 'category2.jpg'],
            ['name' => 'Monitors', 'image' => 'category3.jpg'],
            ['name' => 'Components and Parts', 'image' => 'category4.jpeg'],
            ['name' => 'Printers', 'image' => 'category5.jpg'],
            ['name' => 'Software', 'image' => 'category6.jpeg'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
