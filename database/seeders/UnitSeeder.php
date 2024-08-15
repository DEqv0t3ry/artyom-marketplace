<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Enums\UnitEnum;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Unit::create([
            'slug' => UnitEnum::THING->value,
            'name' => UnitEnum::THING->getlocalized(),
        ]);

        Unit::create([
            'slug' => UnitEnum::PACKAGE->value,
            'name' => UnitEnum::PACKAGE->getlocalized(),
        ]);
    }
}
