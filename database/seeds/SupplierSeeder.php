<?php

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = new DateTime();
        $date_time = $date->format('Y-m-d');

        Supplier::create([
            'name' => 'Cash Supplier',
            'address' => '',
            'create_user_id' => '1',
            'create_date_time' => $date_time,
        ]);
    }
}
