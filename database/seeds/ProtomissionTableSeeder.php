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
            'display_name' => 'Hello World!',
            'description' => 'Basic environment set up',
        ]);
        Protomission::create([
            'name' => 'Variable',
            'display_name' => 'The for Statement',
            'description' => 'Handle simple ($)Variable',
        ]);
        Protomission::create([
            'name' => 'for',
            'display_name' => 'The for Statement',
            'description' => 'Use for loop statement',
        ]);
        Protomission::create([
            'name' => 'foreach',
            'display_name' => 'The foreach Statement',
            'description' => 'Use foreach loop statement ',
        ]);
        Protomission::create([
            'name' => 'echo',
            'display_name' => 'The echo Statement',
            'description' => 'Use echo statement to print something',
        ]);
    }
}
