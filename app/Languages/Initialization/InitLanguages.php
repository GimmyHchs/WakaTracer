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
        $this->initLanguage($proto_language);
        // 以下沒做完
        // foreach ($proto_language->levels as $level) {
        //     $this->user->addLevel();
        // }
    }


    /**
     * 單獨實體化一個Protolanguage
     * 並關聯於User
     */
    public function initLanguage(Protolanguage $proto_language)
    {
        $this->userCheck(__LINE__);

        if($this->checkLanguage($proto_language)){
            return;
        }else {
            $language = Language::create([
                'name' => $proto_language->name,
                'display_name' => $proto_language->display_name,
                'description' => $proto_language->description,
            ]);
            $this->user->addLanguage($language);
        }
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

    /**
     * 確認User是不是已經擁有某個Language
     */
    private function checkLanguage(Protolanguage $proto_language)
    {
        $result = $this->user
             ->languages()
             ->where('name', $proto_language->name)
             ->first();

        if(!empty($result)){
            return true;
        }else {
            return false;
        }
    }

}
