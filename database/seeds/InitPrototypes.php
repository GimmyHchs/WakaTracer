<?php

use Illuminate\Database\Seeder;
use App\Languages\Prototypes\Protolevel;
use App\Languages\Prototypes\Protolanguage;
use App\Languages\Prototypes\Protomission;

class InitPrototypes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $levels = Protolevel::all();
        $missions = Protomission::all();

        $php = Protolanguage::where('name', 'php')->first();
        foreach ($levels as $level) {
            $php->attachProtolevel($level);
        }
        foreach ($missions as $mission) {
            $php->attachProtomission($mission);
        }
        foreach ($levels as $level) {
            foreach ($missions as $mission) {
                $level->addProtomission($mission);
            }
        }
    }
}
