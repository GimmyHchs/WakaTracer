<?php

namespace Tests\units\eloquents\prototypes;

use Tests\TestCase;
use App\Languages\Prototypes\Protolevel;
use App\Languages\Prototypes\Protolanguage;
use App\Languages\Prototypes\Protomission;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProtolevelTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    /**
     * 產生Protolevel.
     *
     * @group unit
     * @group language
     * @group prototype
     */
    public function testCanCreate()
    {
        $this->printTestStartMessage(__FUNCTION__);

        $level = Protolevel::create([
            'name' => 'beginer',
            'display_name' => 'Beginer'
        ]);

        $this->assertEquals($level->name, 'beginer');
        $this->assertEquals($level->display_name, 'Beginer');
    }
    /**
     * 產生Protolevel
     *
     * @group unit
     * @group language
     * @group prototype
     */
    public function testCanFactory()
    {
        $this->printTestStartMessage(__FUNCTION__);

        $level = factory(Protolevel::class)->create([
            'name' => 'beginer',
            'display_name' => 'Beginer'
        ]);

        $this->assertEquals($level->name, 'beginer');
        $this->assertEquals($level->display_name, 'Beginer');
    }

    /**
     * 與Languages建立多對多關聯.
     *
     * @group unit
     * @group language
     * @group prototype
     */
    public function testCanAttachLanguage()
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

        $level->attachProtolanguage($language);

        $this->assertEquals($language->protolevels->first()->name, 'beginer');
        $this->assertEquals($level->protolanguages->first()->name, 'php');
        $this->assertTrue($level->hasProtolanguage($language));
    }

    /**
     * 與Mission建立1對多關聯.
     *
     * @group unit
     * @group language
     * @group prototype
     */
    public function testCanAddMission()
    {
        $this->printTestStartMessage(__FUNCTION__);

        $mission = Protomission::create([
            'name' => 'hello_world',
            'display_name' => 'Hello World!!'
        ]);
        $level = Protolevel::create([
            'name' => 'beginer',
            'display_name' => 'Beginer'
        ]);

        $level->addProtomission($mission);
        $this->assertEquals($mission->fresh()->protolevel->name, 'beginer');
        $this->assertTrue($level->hasProtomission($mission));
    }
}
