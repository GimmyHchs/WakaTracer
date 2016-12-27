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
        'description',
    ];

    /*------------------------------------------------------------------------**
    ** Relation 定義                                                          **
    **------------------------------------------------------------------------*/
    public function protolanguages()
    {
        return $this->belongsToMany(Protolanguage::class)->withTimestamps();
    }
    public function protolevel()
    {
        return $this->belongsTo(Protolevel::class);
    }
    /*------------------------------------------------------------------------**
    ** Method 定義                                                            **
    **------------------------------------------------------------------------*/
}
