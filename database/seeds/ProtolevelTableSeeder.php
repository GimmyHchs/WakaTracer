<?php

use Illuminate\Database\Seeder;
use App\Languages\Prototypes\Protolevel;

class ProtolevelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Protolevel::create([
            'name' => 'beginer',
            'display_name' => 'Beginer'
        ]);
    }
}
