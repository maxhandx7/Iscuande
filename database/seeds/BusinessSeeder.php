<?php

use App\Business;
use Illuminate\Database\Seeder;

class BusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Business::create([
            'name'=>'AF',
            'description'=>'AF',
            'logo'=>'logo.svg',
            'mail'=>'alancarabali@gmail.com',
            'address'=>'Cra. 26c #109-14',
            'phone' => '3145561727',
            'nit'=>'1143982071',
        ]);
    }
}
