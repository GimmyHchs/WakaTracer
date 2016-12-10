<?php

namespace App\Languages\Prototypes;

use Illuminate\Database\Eloquent\Model;

class Protolanguage extends Model
{
    /*------------------------------------------------------------------------**
    ** Entity 定義                                                            **
    **------------------------------------------------------------------------*/
    protected $table = 'protolanguages';

    protected $fillable = [
        'name',
        'display_name',
    ];

    /*------------------------------------------------------------------------**
    ** Relation 定義                                                          **
    **------------------------------------------------------------------------*/
    public function protolevels()
    {
        return $this->belongsToMany(Protolevel::class);
    }

    public function protomissions()
    {
        return $this->belongsToMany(Protomission::class);
    }

}
