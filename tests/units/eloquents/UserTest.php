<?php

namespace Tests\units\eloquents;

use Tests\TestCase;
use App\Languages\Language;
use App\Languages\Level;
use App\Languages\Mission;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    /**
     * 產生User.
     *
     * @group unit
     * @group language
     * @group prototype
     */
    public function testCanCreate()
    {
        $this->printTestStartMessage(__FUNCTION__);

        $user = factory(User::class)->create();

        $this->assertNotNull($user->name);
        $this->assertNotNull($user->email);

    }


}
