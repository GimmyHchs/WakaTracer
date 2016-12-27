<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Languages\Language;
use App\Languages\Level;
use App\Languages\Mission;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    //
    // relationship
    //
    public function languages()
    {
        return $this->hasMany(Language::class);
    }
    public function levels()
    {
        return $this->hasMany(Level::class);
    }
    public function missions()
    {
        return $this->hasMany(Mission::class);
    }

    /*------------------------------------------------------------------------**
    ** Functions
    **------------------------------------------------------------------------*/
    public function addLanguage(Language $language)
    {
        return $this->languages()->save($language);
    }
    public function addLevel(Level $level)
    {
        return $this->levels()->save($level);
    }
    public function addMission(Mission $mission)
    {
        return $this->missions()->save($mission);
    }
}
