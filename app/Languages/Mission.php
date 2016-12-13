<?php

namespace App\Languages;

use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    // Many Missions to many levels
    public function level()
    {
      return $this->belongsToMany(Level::class);
    }
}
