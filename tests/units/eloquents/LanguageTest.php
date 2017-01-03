<?php

namespace Tests\units\eloquents;

use Tests\TestCase;
use App\Account\User;
use App\Languages\Language;
use App\Languages\Level;
use App\Languages\Mission;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LanguageTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    /**
     * 產生Language.
     *
     * @group unit
     * @group language
     * @group prototype
     */
    public function testCanCreate()
    {
        $this->printTestStartMessage(__FUNCTION__);

        $language = Language::create([
            'name' => 'php',
            'display_name' => 'PHP'
        ]);

        $this->assertEquals($language->name, 'php');
        $this->assertEquals($language->display_name, 'PHP');
    }

    /**
     * 與User建立關聯.
     *
     * @group unit
     * @group language
     * @group prototype
     */
    public function testCanRelationUser()
    {
        $this->printTestStartMessage(__FUNCTION__);
        $user = factory('App\Account\User')->create(['name' => 'user']);
        $language = Language::create([
            'name' => 'php',
            'display_name' => 'PHP'
        ]);
        $user->languages()->save($language);

        $target = $language->user()->first();
        $this->assertEquals($target->name, $user->name);
        $this->assertEquals(1, count($language->user));
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
        $language = Language::create([
            'name' => 'php',
            'display_name' => 'PHP'
        ]);
        $level = Level::create([
            'name' => 'beginer',
            'display_name' => 'Beginer'
        ]);
        $language->levels()->save($level);

        $target = $language->levels()->first();
        $this->assertEquals($target->name, $level->name);
        $this->assertEquals(1, count($language->levels));
    }



}
