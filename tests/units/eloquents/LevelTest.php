<?php

namespace Tests\units\eloquents;

use Tests\TestCase;
use App\Languages\Language;
use App\Languages\Level;
use App\Languages\Mission;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LevelTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    /**
     * 產生Level.
     *
     * @group unit
     * @group language
     * @group prototype
     */
    public function testCanCreate()
    {
        $this->printTestStartMessage(__FUNCTION__);

        $level = Level::create([
            'name' => 'beginer',
            'display_name' => 'Beginer'
        ]);

        $this->assertEquals($level->name, 'beginer');
        $this->assertEquals($level->display_name, 'Beginer');
    }

    /**
     * 與Languae建立關聯.
     *
     * @group unit
     * @group language
     * @group prototype
     */
    public function testCanRelationLanguage()
    {
        $this->printTestStartMessage(__FUNCTION__);
        $language = Language::create([
            'name' => 'php',
            'display_name' => 'PHP'
        ]);
        $level = Level::create([
            'name' => 'beginer',
            'display_name' => 'Beginer'
        ]);
        $level->language()->associate($language)->save();

        $target = $level->language()->first();
        $this->assertEquals($target->name, $language->name);
        $this->assertEquals(1, count($level->language));
    }

    /**
     * 與Mission建立關聯.
     *
     * @group unit
     * @group language
     * @group prototype
     */
    public function testCanRelationMission()
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
        $level->missions()->save($mission)->save();

        $target = $level->missions()->first();
        $this->assertEquals($target->name, $mission->name);
        $this->assertEquals(1, count($level->missions));
    }


}
