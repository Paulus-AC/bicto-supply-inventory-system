<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Office Supplies',
                'status' => 1,
            ],
            [
                'name' => 'IT Equipment',
                'status' => 1,
            ],
            [
                'name' => 'Furniture and Fixtures',
                'status' => 1,
            ],
            [
                'name' => 'Cleaning Supplies',
                'status' => 1,
            ],
            [
                'name' => 'Medical Supplies',
                'status' => 1,
            ],
            [
                'name' => 'Electrical Supplies',
                'status' => 1,
            ],
            [
                'name' => 'Construction Materials',
                'status' => 1,
            ],
            [
                'name' => 'Vehicle Parts and Accessories',
                'status' => 1,
            ],
            [
                'name' => 'Laboratory Supplies',
                'status' => 1,
            ],
            [
                'name' => 'Others',
                'status' => 1,
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['name' => $category['name']],
                $category
            );
        }
    }
}