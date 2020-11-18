<?php

namespace Vendor\Package\Database\Seeders;

use Illuminate\Database\Seeder;
use Vendor\Package\Models\Applicant;

class ApplicantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Applicant::factory()->times(50)->create();
    }
}
