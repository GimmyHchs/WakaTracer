<?php

namespace App\Languages\Prototypes;

use Illuminate\Database\Eloquent\Model;

class Protomission extends Model
{
    /*------------------------------------------------------------------------**
    ** Entity 定義                                                            **
    **------------------------------------------------------------------------*/
    protected $table = 'protomissions';

    protected $fillable = [
        'name',
        'display_name',
    ];
    /*------------------------------------------------------------------------**
    ** Relation 定義                                                          **
    **------------------------------------------------------------------------*/
    public function protolanguages()
    {
        return $this->belongsToMany(Protolanguage::class);
    }
    public function protolevels()
    {
        return $this->belongsTo(Protolevel::class);
    }
}
