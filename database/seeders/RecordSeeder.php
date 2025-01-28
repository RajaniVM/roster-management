<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Record;

class RecordSeeder extends Seeder
{
    public function run()
    {
        // Generate 50 test records
        Record::factory()->count(50)->create();
    }
}