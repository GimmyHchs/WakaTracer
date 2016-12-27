<?php

namespace App\Core;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App;
/**
 * 各Eloquent 的抽象核心
 */
abstract class LanguageEloquent extends Model
{

    /**
     * 所有LanguagesEloquent都屬於某個User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * 透過名稱直接搜尋
     */
    public static function findName($name)
    {
        $instance = new static;
        return $instance->where('name', $name)->first();
    }
}
