<?php

namespace App\Languages;

use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    /*------------------------------------------------------------------------**
    ** Entity 定義
    **------------------------------------------------------------------------*/
    protected $table = 'missions';
    protected $fillable = [
       'name',
       'display_name'
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
