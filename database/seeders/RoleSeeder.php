<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\Role;
use Illuminate\Console\View\Components\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'slug' => RoleEnum::ADMIN->value,
            'name' => RoleEnum::ADMIN->getlocalized(),
        ]);

        Role::create([
            'slug' => RoleEnum::SHOP->value,
            'name' => RoleEnum::SHOP->getlocalized(),
        ]);
    }
}
