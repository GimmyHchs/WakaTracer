<?php

use Illuminate\Database\Seeder;
use App\Languages\Prototypes\Protomission;

class ProtomissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Protomission::create([
            'name' => 'hello_world',
            'display_name' => 'Hello World!'
        ]);
    }
}
