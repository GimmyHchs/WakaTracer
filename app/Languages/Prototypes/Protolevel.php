<?php

namespace App\Languages\Prototypes;

use Illuminate\Database\Eloquent\Model;

class Protolevel extends Model
{
    /*------------------------------------------------------------------------**
    ** Entity 定義                                                            **
    **------------------------------------------------------------------------*/
    protected $table = 'protolevels';

    protected $fillable = [
        'name',
        'display_name',
    ];
    /*------------------------------------------------------------------------**
    ** Relation 定義                                                          **
    **------------------------------------------------------------------------*/
    public function protolanguages()
    {
        return $this->belongsToMany(Protolanguage::class)->withTimestamps();
    }
    public function protomissions()
    {
        return $this->hasMany(Protomission::class);
    }

    /*------------------------------------------------------------------------**
    ** Method 定義                                                            **
    **------------------------------------------------------------------------*/
    public function attachProtolanguage(Protolanguage $language)
    {
        return $this->protolanguages()->attach($language);
    }
    public function addProtomission(Protomission $mission)
    {
        return $this->protomissions()->save($mission);
    }
}
