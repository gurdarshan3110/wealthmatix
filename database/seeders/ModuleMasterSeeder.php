<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ModuleMaster;

class ModuleMasterSeeder extends Seeder
{
    public function run()
    {
        // Add Dashboard module
        ModuleMaster::create([
            'name' => 'Dashboard',
            'icon' => '/assets/images/dashboard-icon.png', 
            'url' => '/dashboard',
            'status' => 1,
        ]);

        // Add Stores module
        ModuleMaster::create([
            'name' => 'Stores',
            'icon' => '/assets/images/stores-icon.png',
            'url' => '/stores',
            'status' => 1,
        ]);

        // Add Suppliers module
        ModuleMaster::create([
            'name' => 'Suppliers',
            'icon' => '/assets/images/suppliers-icon.png',
            'url' => '/suppliers',
            'status' => 1,
        ]);

        // Add Categories module
        ModuleMaster::create([
            'name' => 'Categories',
            'icon' => '/assets/images/categories-icon.png',
            'url' => '/categories',
            'status' => 1,
        ]);

        // Add Units module
        ModuleMaster::create([
            'name' => 'Units',
            'icon' => '/assets/images/units-icon.png',
            'url' => '/units',
            'status' => 1,
        ]);

        // Add Taxes module
        ModuleMaster::create([
            'name' => 'Taxes',
            'icon' => '/assets/images/taxes-icon.png',
            'url' => '/taxes',
            'status' => 1,
        ]);

        // Add Items module
        ModuleMaster::create([
            'name' => 'Items',
            'icon' => '/assets/images/items-icon.png',
            'url' => '/items',
            'status' => 1,
        ]);

        // Add Purchase Order module
        ModuleMaster::create([
            'name' => 'Purchase Orders',
            'icon' => '/assets/images/pos-icon.png',
            'url' => '/purchase-orders',
            'status' => 1,
        ]);

        // Add MRN module
        ModuleMaster::create([
            'name' => 'Mrns',
            'icon' => '/assets/images/mrns-icon.png',
            'url' => '/mrns',
            'status' => 1,
        ]);

        // Add Stocks module
        ModuleMaster::create([
            'name' => 'Stock',
            'icon' => '/assets/images/stocks-icon.png',
            'url' => '/stocks',
            'status' => 1,
        ]);
    }
}
