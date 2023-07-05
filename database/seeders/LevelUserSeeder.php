<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class LevelUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pengrajin = Role::create(['name' => 'Pengrajin']);
        $pengrajin->givePermissionTo(['kerajinan-list','kerajinan-create','kerajinan-edit','kerajinan-delete', 'user-list', 'user-edit']);

        $konsumen = Role::create(['name' => 'Konsumen']);
        $konsumen->givePermissionTo(['kerajinan-list', 'user-list', 'user-edit']);
    }
}
