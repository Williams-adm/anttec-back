<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Prefix;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $branch = Branch::create([
            'name' => 'Sucursal 1',
            'email' => 'sucursal1@gmail.com',
        ]);

        $preix = Prefix::first();

        $branch->phone()->create([
            'number' => 902834765,
            'prefix_id' => $preix->id
        ]);
    }
}
