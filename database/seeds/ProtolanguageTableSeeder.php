<?php

use Illuminate\Database\Seeder;
use App\Languages\Prototypes\Protolanguage;

class ProtolanguageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Protolanguage::create([
            'name' => 'php',
            'display_name' => 'PHP'
        ]);
        Protolanguage::create([
            'name' => 'vue',
            'display_name' => 'Vue'
        ]);
    }
}
