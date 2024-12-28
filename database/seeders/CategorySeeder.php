<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\User;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // Get the first user from the database
        $user = User::first();

        if (!$user) {
            $user = User::create([
                'name' => 'Demo User',
                'email' => 'user@demo.com',
                'password' => '12345678',
            ]);
        }

        // Define categories and subcategories
        $categories = [
            [
                'name' => 'Bike Expense',
                'type' => 'expense',
                'children' => [
                    ['name' => 'Fuel'],
                    ['name' => 'Maintenance'],
                ],
            ],
            [
                'name' => 'Mobile and Internet Expense',
                'type' => 'expense',
                'children' => [
                    ['name' => 'Internet'],
                    ['name' => 'Repairing'],
                ],
            ],
            [
                'name' => 'General Expense',
                'type' => 'expense',
                'children' => [
                    ['name' => 'My Diet'],
                    ['name' => 'Get Together with Friends'],
                    ['name' => 'With Wife'],
                ],
            ],
            [
                'name' => 'My Wife',
                'type' => 'expense',
                'children' => [
                    ['name' => 'Medication'],
                    ['name' => 'Diet'],
                    ['name' => 'Pocket Money'],
                ],
            ],
        ];

        // Recursively create categories
        $this->createCategories($categories, $user->id);
    }

    private function createCategories(array $categories, $userId, $parentId = null)
    {
        foreach ($categories as $categoryData) {
            $category = Category::create([
                'name' => $categoryData['name'],
                'type' => $categoryData['type'] ?? 'expense',
                'user_id' => $userId,
                'parent_id' => $parentId,
            ]);

            if (isset($categoryData['children']) && is_array($categoryData['children'])) {
                $this->createCategories($categoryData['children'], $userId, $category->id);
            }
        }
    }
}
