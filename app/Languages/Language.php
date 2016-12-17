<?php

namespace App\Languages;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Language extends Model
{
    /*------------------------------------------------------------------------**
    ** Entity 定義
    **------------------------------------------------------------------------*/
    protected $table = 'languages';
    protected $fillable = [
       'name',
       'user_id',
       'display_name'
       'description',
    ];
    /*------------------------------------------------------------------------**
    ** Relation定義
    **------------------------------------------------------------------------*/
    public function user()
    {
      return $this->belongsTo(User::class);
    }
    //
    public function levels()
    {
      return $this->hasMany(Level::class);
    }
}
