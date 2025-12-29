<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $country = Country::firstOrCreate([
            'name' => 'Peru'
        ]);

        $departament = $country->departaments()->firstOrCreate([
            'name' => 'Junin',
        ]);

        $province = $departament->provinces()->firstOrCreate(
            ['name' => 'Junin'],
            ['shipment_cost' => 10.0]
        );

        $district = $province->districs()->firstOrCreate([
            'name' => 'Junin',
        ]);

        $street = $district->streets()->firstOrCreate(
            ['name' => 'Av. Giraldez'],
            ['number' => 3202],
        );

        Branch::findOrFail(1)->address()->create([
            'favorite' => true,
            'reference' => 'Los girasoles',
            'street_id' => $street->id,
        ]);
    }
}
