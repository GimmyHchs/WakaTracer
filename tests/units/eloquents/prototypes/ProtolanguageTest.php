<?php

namespace Tests\units\models;

use Tests\TestCase;
use App\Languages\Prototypes\Protolevel;
use App\Languages\Prototypes\Protolanguage;
use App\Languages\Prototypes\Protomission;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProtolanguageTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    /**
     * 產生Protolanguage.
     *
     * @group unit
     * @group language
     * @group prototype
     */
    public function testCanCreate()
    {
        $this->printTestStartMessage(__FUNCTION__);

        $language = Protolanguage::create([
            'name' => 'php',
            'display_name' => 'PHP'
        ]);

        $this->assertEquals($language->name, 'php');
        $this->assertEquals($language->display_name, 'PHP');
    }

    /**
     * 與level建立多對多關聯.
     *
     * @group unit
     * @group language
     * @group prototype
     */
    public function testCanAttachLevel()
    {
        $this->printTestStartMessage(__FUNCTION__);

        $language = Protolanguage::create([
            'name' => 'php',
            'display_name' => 'PHP'
        ]);
        $level = Protolevel::create([
            'name' => 'beginer',
            'display_name' => 'Beginer'
        ]);

        $language->attachProtolevel($level);

        $this->assertEquals($language->protolevels->first()->name, 'beginer');
        $this->assertEquals($level->protolanguages->first()->name, 'php');
    }

    /**
     * 與Mission建立多對多關聯.
     *
     * @group unit
     * @group language
     * @group prototype
     */
    public function testCanAttachMission()
    {
        $this->printTestStartMessage(__FUNCTION__);

        $language = Protolanguage::create([
            'name' => 'php',
            'display_name' => 'PHP'
        ]);
        $mission = Protomission::create([
            'name' => 'hello_world',
            'display_name' => 'Hello World!'
        ]);

        $language->attachProtomission($mission);

        $this->assertEquals($language->protomissions->first()->name, 'hello_world');
        $this->assertEquals($mission->protolanguages->first()->name, 'php');
    }
}
