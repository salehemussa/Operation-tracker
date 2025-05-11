<?php

use Illuminate\Database\Seeder;
use App\Models\Inventory;

class InventorySeeder extends Seeder
{
    public function run()
    {
        Inventory::create([
            'name' => 'Hammer',
            'quantity' => 50,
            'lastupdated' => now(),
            'status' => 'Available',
        ]);

        Inventory::create([
            'name' => 'Wrench',
            'quantity' => 30,
            'lastupdated' => now(),
            'status' => 'Out of Stock',
        ]);
    }
}
