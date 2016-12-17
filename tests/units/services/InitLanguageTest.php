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

}
