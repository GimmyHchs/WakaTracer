<?php

namespace App\Languages;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    /*------------------------------------------------------------------------**
    ** Entity 定義
    **------------------------------------------------------------------------*/
    protected $table = 'levels' ;
    protected $fillable = [
       'name',
       'display_name'
    ] ;
    /*------------------------------------------------------------------------**
    ** Relation 定義
    **------------------------------------------------------------------------*/
    // Many levels to one language
    public function language()
    {
      return $this->belongsTo(Language::class);
    }
    // Many languages to  many missions
    public function mission()
    {
      return $this->belongsToMany(Mission::class)->withTimestamps;
    }
}
