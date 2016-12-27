<?php

namespace App\Languages;

use App\Core\LanguageEloquent as Model;

class Level extends Model
{
    /*------------------------------------------------------------------------**
    ** Entity 定義
    **------------------------------------------------------------------------*/
    protected $table = 'levels';
    protected $fillable = [
       'name',
       'display_name',
       'description',
    ];
    /*------------------------------------------------------------------------**
    ** Relation 定義
    **------------------------------------------------------------------------*/
    // Many levels to one language
    public function language()
    {
      return $this->belongsTo(Language::class);
    }
    // One language to  many missions
    public function missions()
    {
      return $this->hasMany(Mission::class);
    }

    /*------------------------------------------------------------------------**
    ** Functions
    **------------------------------------------------------------------------*/
    public function addMission(Mission $mission)
    {
        return $this->missions()->save($mission);
    }
}
