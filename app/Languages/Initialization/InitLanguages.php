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
        foreach ($proto_language->protolevels as $proto_level) {
            foreach ($proto_level->protomissions as  $proto_mission) {
                $this->initMission($proto_mission, $proto_language);
            }
        }
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

    /**
     * 實體化一個Protolevel
     */
    public function initLevel(Protolevel $proto_level, Protolanguage $proto_language)
    {
        $this->userCheck(__LINE__);

        // 如果此Level對應到的Language沒被實體化出來，丟出Exception
        if(!$this->checkLanguage($proto_language))
        {
            throw new InitialException(
                "Language didn't init '".$proto_language->name."'",
                InitLanguages::class,
                __LINE__
            );
        }

        // 如果此Protolanguage並沒有與$proto_level關聯，丟出Exception
        if(!$proto_language->hasProtolevel($proto_level))
        {
            throw new InitialException(
                "Language '".$proto_language->name."'"." doesn't has '".$proto_level->name."'",
                InitLanguages::class,
                __LINE__
            );
        }

        // 取得實體language，實體化level並進行關聯
        $language = $proto_language->language($this->user);
        $level = Level::firstOrCreate([
            'name' => $proto_level->name,
            'display_name' => $proto_level->display_name,
            'description' => $proto_level->description,
        ]);
        $language->addLevel($level);
        $this->user->addLevel($level);

        return $level->fresh();
    }

    /**
     * 實體化一個Protomission
     */
    public function initMission(Protomission $proto_mission, Protolanguage $proto_language)
    {
        $this->userCheck(__LINE__);

        // 如果此Protolanguage並沒有與$proto_mission關聯，丟出Exception
        if(!$proto_language->hasProtomission($proto_mission))
        {
            throw new InitialException(
                "Language '".$proto_language->name."'"." doesn't has '".$proto_mission->name."'",
                InitLanguages::class,
                __LINE__
            );
        }

        // 預先實體化level
        $proto_level = $proto_mission->protolevel;
        $level = $this->initLevel($proto_level, $proto_language);

        // 實體化mission
        $mission = Mission::firstOrCreate([
            'name' => $proto_mission->name,
            'display_name' => $proto_mission->display_name,
            'description' => $proto_mission->description,
        ]);
        $level->addMission($mission);
        $this->user->addMission($mission);
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
