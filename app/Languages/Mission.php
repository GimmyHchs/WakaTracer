<?php

namespace App\Languages;

use App\Core\LanguageEloquent as Model;

class Mission extends Model
{
    /*------------------------------------------------------------------------**
    ** Entity 定義
    **------------------------------------------------------------------------*/
    protected $table = 'missions';
    protected $fillable = [
       'name',
       'display_name',
       'description',
    ];
    /*------------------------------------------------------------------------**
    ** Relation 定義
    **------------------------------------------------------------------------*/
    // Mission belongsTo Level
    public function level()
    {
      return $this->belongsTo(Level::class);
    }
}
