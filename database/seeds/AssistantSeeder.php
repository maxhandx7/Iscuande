<?php

namespace Database\Seeders;

use App\Assistant;
use Illuminate\Database\Seeder;

class AssistantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Assistant::create([
            'nombre'=>'AF',
            'directivas'=>'',
            'principios' => '',
        ]);
    }
}
