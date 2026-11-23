<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Elektronik',
            'ATK',
            'Peralatan',
            'Furniture',
            'Lainnya'
        ];

        foreach ($categories as $category) {
            DB::table('categories')->updateOrInsert(
                ['name' => $category],
                ['updated_at' => now(), 'created_at' => now()]
            );
        }
    }
}