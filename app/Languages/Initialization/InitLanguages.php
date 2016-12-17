<?php

namespace App\Languages\Initialization;

use App\User;
use App\Languages\Language;
use App\Languages\Mission;
use App\Languages\Level;
use App\Languages\Prototypes\Protolevel;
use App\Languages\Prototypes\Protolanguage;
use App\Languages\Prototypes\Protomission;

/**
 * 處理實體化LanguagesPrototype的邏輯
 * Service
 */
class InitLanguages
{

    /**
     * @var User
     */
    private $user;

    function __construct()
    {

    }
    public function setUser(User $user)
    {
        $this->user = $user;
        return $this;
    }
    public function getUser()
    {
        return $this->user;
    }

    /**
     * 初始化某個Language下所有的 Level 以及 Mission
     * 並關聯於User
     */
    public function initCompleted(Protolanguage $proto_language)
    {
        $this->userCheck(__LINE__);

        // 以下沒做完
        foreach ($proto_language->levels as $level) {
            $this->user->addLevel()
        }
    }


    public function InitLanguage(Protolanguage $proto_language)
    {
        // 沒做完
    }

    /*------------------------------------------------------------------------**
    ** Private function
    **------------------------------------------------------------------------*/

    /**
     * 確認User是不是已經被設定，如果沒有設定，丟出Exception
     */
    private function userCheck($line)
    {
        if(!($this->user instanceof User))
            throw new InitialException("User didn't set", InitLanguages::class, $line);
    }

}
