<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
Use App\Models\{Country,State};

class CountrySateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $country = Country::create(['name' => 'United State']);
        $state = State::create(['country_id' => $country->id, 'name' => 'Florida']);
        $state = State::create(['country_id' => $country->id, 'name' => 'Arizona']);
        $state = State::create(['country_id' => $country->id, 'name' => 'California']);

        $country = Country::create(['name' => 'India']);
        $state = State::create(['country_id' => $country->id, 'name' => 'Gujarat']);
        $state = State::create(['country_id' => $country->id, 'name' => 'Haryana']);
        $state = State::create(['country_id' => $country->id, 'name' => 'Punjab']);

        $country = Country::create(['name' => 'Europe']);
        $state = State::create(['country_id' => $country->id, 'name' => 'Albania']);
        $state = State::create(['country_id' => $country->id, 'name' => 'Andorra']);
        $state = State::create(['country_id' => $country->id, 'name' => 'Armenia']);
    }
}
