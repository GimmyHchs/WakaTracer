<?php

namespace App\Languages\Prototypes;

use Illuminate\Database\Eloquent\Model;
use App\Account\User;

class Protolanguage extends Model
{
    /*------------------------------------------------------------------------**
    ** Entity 定義                                                            **
    **------------------------------------------------------------------------*/
    protected $table = 'protolanguages';

    protected $fillable = [
        'name',
        'display_name',
        'description',
    ];

    /*------------------------------------------------------------------------**
    ** Relation 定義                                                          **
    **------------------------------------------------------------------------*/
    public function protolevels()
    {
        return $this->belongsToMany(Protolevel::class)->withTimestamps();
    }

    public function protomissions()
    {
        return $this->belongsToMany(Protomission::class)->withTimestamps();
    }

    public function language(User $user)
    {
        return $user->languages()->where('name', $this->name)->first();
    }
    /*------------------------------------------------------------------------**
    ** Method 定義                                                            **
    **------------------------------------------------------------------------*/
    public function attachProtolevel(Protolevel $level)
    {
        return $this->protolevels()->attach($level);
    }
    public function hasProtolevel(Protolevel $level)
    {
        return $this->protolevels->contains($level);
    }
    public function attachProtomission(Protomission $mission)
    {
        return $this->protomissions()->attach($mission);
    }
    public function hasProtomission(Protomission $mission)
    {
        return $this->protomissions->contains($mission);
    }

}
