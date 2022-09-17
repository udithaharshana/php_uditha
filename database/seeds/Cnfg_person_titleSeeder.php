<?php

use App\Models\Cnfg_person_title;
use Illuminate\Database\Seeder;

class Cnfg_person_titleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cnfg_person_title::create(['title'=> 'Rve', 'sts'=>'1']);
        Cnfg_person_title::create(['title'=> 'Mr', 'sts'=>'1']);
        Cnfg_person_title::create(['title'=> 'Mrs', 'sts'=>'1']);
        Cnfg_person_title::create(['title'=> 'Miss', 'sts'=>'1']);
        Cnfg_person_title::create(['title'=> 'Ms', 'sts'=>'1']);
        Cnfg_person_title::create(['title'=> 'MS', 'sts'=>'0']);
    }
}
