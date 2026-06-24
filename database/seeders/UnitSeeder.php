<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $units = [
            ['name' => 'Piece', 'status' => 1],
            ['name' => 'Box', 'status' => 1],
            ['name' => 'Pack', 'status' => 1],
            ['name' => 'Set', 'status' => 1],
            ['name' => 'Ream', 'status' => 1],
            ['name' => 'Roll', 'status' => 1],
            ['name' => 'Bottle', 'status' => 1],
            ['name' => 'Can', 'status' => 1],
            ['name' => 'Jar', 'status' => 1],
            ['name' => 'Tube', 'status' => 1],
            ['name' => 'Sack', 'status' => 1],
            ['name' => 'Bag', 'status' => 1],
            ['name' => 'Kilogram', 'status' => 1],
            ['name' => 'Gram', 'status' => 1],
            ['name' => 'Liter', 'status' => 1],
            ['name' => 'Milliliter', 'status' => 1],
            ['name' => 'Meter', 'status' => 1],
            ['name' => 'Centimeter', 'status' => 1],
            ['name' => 'Foot', 'status' => 1],
            ['name' => 'Inch', 'status' => 1],
        ];

        foreach ($units as $unit) {
            Unit::updateOrCreate(
                ['name' => $unit['name']],
                $unit
            );
        }
    }
}