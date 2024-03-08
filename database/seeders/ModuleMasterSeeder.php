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
            'url' => 'dashboard',
            'status' => 1,
        ]);

        // Add Categories module
        ModuleMaster::create([
            'name' => 'Banks',
            'icon' => '/assets/images/banks-icon.png',
            'url' => 'banks',
            'status' => 1,
        ]);

        // Add Units module
        ModuleMaster::create([
            'name' => 'Loans',
            'icon' => '/assets/images/loans-icon.png',
            'url' => 'loans',
            'status' => 1,
        ]);

        ModuleMaster::create([
            'name' => 'Bank Settings',
            'icon' => '/assets/images/bank-settings-icon.png',
            'url' => 'loans',
            'status' => 1,
        ]);

        ModuleMaster::create([
            'name' => 'Documents',
            'icon' => '/assets/images/documents-icon.png',
            'url' => 'documents',
            'status' => 1,
        ]);

        // Add Stores module
        ModuleMaster::create([
            'name' => 'Agencies',
            'icon' => '/assets/images/agencies-icon.png',
            'url' => 'agencies',
            'status' => 1,
        ]);

        // Add Suppliers module
        ModuleMaster::create([
            'name' => 'Agents',
            'icon' => '/assets/images/agents-icon.png',
            'url' => 'agents',
            'status' => 1,
        ]);

        ModuleMaster::create([
            'name' => 'Customers',
            'icon' => '/assets/images/customers-icon.png',
            'url' => 'customers',
            'status' => 1,
        ]);

        
    }
}
