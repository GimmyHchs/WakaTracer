<?php

namespace App\Languages;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    /*------------------------------------------------------------------------**
    ** Entity 定義
    **------------------------------------------------------------------------*/
    protected $table = 'languages' ;
    protected $fillable = [
       'name',
       'display_name'
    ] ;
    /*------------------------------------------------------------------------**
    ** Relation定義
    **------------------------------------------------------------------------*/
    public function user()
    {
      return $this->belongsTo(User::class);
    }
    //
    public function level()
    {
      return $this->hasMany(Level::class);
    }
}
