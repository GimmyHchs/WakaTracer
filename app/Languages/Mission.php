<?php

namespace App\Languages;

use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    /*------------------------------------------------------------------------**
    ** Entity 定義
    **------------------------------------------------------------------------*/
    protected $table = 'missions' ;
    protected $fillable = [
       'name',
       'display_name'
    ] ;
    /*------------------------------------------------------------------------**
    ** Relation 定義
    **------------------------------------------------------------------------*/
    // Many Missions to many levels
    public function level()
    {
      return $this->belongsToMany(Level::class)->withTimestamps;
    }
}
