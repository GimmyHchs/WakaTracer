<?php

namespace Tests\units\services;

use Tests\TestCase;
use App\Languages\Initialization\InitLanguages;
use App\Languages\Initialization\InitialException;
use App\User;
use App\Languages\Language;
use App\Languages\Level;
use App\Languages\Mission;
use App\Languages\Prototypes\Protolevel;
use App\Languages\Prototypes\Protolanguage;
use App\Languages\Prototypes\Protomission;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class InitLanguageTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    /**
     * 產生 InitLanguages Service.
     *
     * @group unit
     * @group language
     * @group service
     */
    public function testCanNew()
    {
        $this->printTestStartMessage(__FUNCTION__);
        $service = new InitLanguages();

        $this->assertNotNull($service);
    }

    /**
     * 丟出User didn't set Exception.
     *
     * @group unit
     * @group language
     * @group service
     */
    public function testCanThrowException()
    {
        $this->printTestStartMessage(__FUNCTION__);
        $proto_language = factory(Protolanguage::class)->create();

        $service = new InitLanguages();
        try {
            $service->initCompleted($proto_language);
        } catch (InitialException $e) {
            $this->assertEquals($e->getMessage(), "User didn't set");
            $this->assertEquals($e->getFile(), "App\Languages\Initialization\InitLanguages");
            return;
        }
    }

    /**
     * 初始化一個Protolanguage.
     *
     * @group unit
     * @group language
     * @group service
     */
    public function testCanInitLanguage()
    {
        $this->printTestStartMessage(__FUNCTION__);
        $user = factory(User::class)->create();
        $proto_language = factory(Protolanguage::class)->create();

        $service = new InitLanguages();
        $service->setUser($user)->initLanguage($proto_language);

        $this->assertEquals($user->languages()->first()->name, $proto_language->name);
    }

    /**
     * 初始化一個Protolanguage.
     * 並在尚未初始化Protolanguage時，丟出Exception
     *
     * @group unit
     * @group language
     * @group service
     */
    public function testCanInitLevelWithException()
    {
        $this->printTestStartMessage(__FUNCTION__);
        $user = factory(User::class)->create();
        $proto_level = factory(Protolevel::class)->create();
        $proto_language = factory(Protolanguage::class)->create();
        $proto_language->attachProtolevel($proto_level);

        $service = new InitLanguages();
        $service->setUser($user);
        try {
            $service->initLevel($proto_level, $proto_language);
        } catch (InitialException $e) {
            $this->assertContains("Language didn't init", $e->getMessage());
            $this->assertEquals($e->getFile(), "App\Languages\Initialization\InitLanguages");
            return;
        }
    }

    /**
     * 初始化一個Protolanguage.
     * 並在Protolanguage與Protolevel無關時，丟出Exception
     *
     * @group unit
     * @group language
     * @group service
     */
    public function testCanInitLevelWithException2()
    {
        $this->printTestStartMessage(__FUNCTION__);
        $user = factory(User::class)->create();
        $proto_level = factory(Protolevel::class)->create();
        $proto_language = factory(Protolanguage::class)->create();

        $service = new InitLanguages();
        $service->setUser($user)->initLanguage($proto_language);
        try {
            $service->initLevel($proto_level, $proto_language);
        } catch (InitialException $e) {
            $this->assertContains("doesn't has", $e->getMessage());
            $this->assertEquals($e->getFile(), "App\Languages\Initialization\InitLanguages");
            return;
        }
    }

    /**
     * 初始化一個Protolanguage.
     *
     * @group unit
     * @group language
     * @group service
     */
    public function testCanInitLevel()
    {
        $this->printTestStartMessage(__FUNCTION__);
        $user = factory(User::class)->create();
        $proto_level = factory(Protolevel::class)->create();
        $proto_language = factory(Protolanguage::class)->create();
        $proto_language->attachProtolevel($proto_level);

        $service = new InitLanguages();
        $service->setUser($user)->initLanguage($proto_language);
        $service->initLevel($proto_level, $proto_language);

        $this->assertEquals($user->languages()->first()->name, $proto_language->name);
        $language = $user->languages()->first();
        $this->assertEquals($language->levels->first()->name, $proto_level->name);
    }

    /**
     * 完整初始化一個Protolanguage.
     *
     * @group unit
     * @group language
     * @group service
     */
    public function testCanInitLanguageCompelete()
    {
        $this->printTestStartMessage(__FUNCTION__);
        $user = factory(User::class)->create();
        $proto_language = factory(Protolanguage::class)->create(['name'=>'php']);
        $proto_level = factory(Protolevel::class)->create(['name'=>'beginner']);
        $proto_mission = factory(Protomission::class)->create(['name'=>'hello_world']);
        $proto_language->attachProtolevel($proto_level);
        $proto_language->attachProtomission($proto_mission);
        $proto_level->addProtomission($proto_mission);


        $service = new InitLanguages();
        $service->setUser($user)->initCompleted($proto_language);


        $this->assertEquals($user->languages()->first()->name, $proto_language->name);
        $language = $user->languages()->first();
        $this->assertEquals($language->levels->first()->name, $proto_level->name);
        $this->assertEquals($language->levels->first()->mission->name, $proto_mission->name);

    }


}
