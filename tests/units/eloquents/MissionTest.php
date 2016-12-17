<?php

namespace Tests\units\eloquents;

use Tests\TestCase;
use App\Languages\Language;
use App\Languages\Level;
use App\Languages\Mission;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class MissionTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    /**
     * 產生Mission.
     *
     * @group unit
     * @group language
     * @group prototype
     */
    public function testCanCreate()
    {
        $this->printTestStartMessage(__FUNCTION__);

        $mission = Mission::create([
            'name' => 'hello_world',
            'display_name' => 'Hello World'
        ]);

        $this->assertEquals($mission->name, 'hello_world');
        $this->assertEquals($mission->display_name, 'Hello World');
    }


    /**
     * 與Level建立關聯.
     *
     * @group unit
     * @group language
     * @group prototype
     */
    public function testCanRelationLevel()
    {
        $this->printTestStartMessage(__FUNCTION__);
        $mission = Mission::create([
            'name' => 'hello_world',
            'display_name' => 'Hello World'
        ]);
        $level = Level::create([
            'name' => 'beginer',
            'display_name' => 'Beginer'
        ]);
        $mission->level()->associate($level)->save();

        $target = $mission->level()->first();
        $this->assertEquals($target->name, $level->name);
        $this->assertEquals(1, count($mission->level));
    }

}
