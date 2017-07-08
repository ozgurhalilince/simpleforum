<?php

namespace Ozgurince\Simpleforum\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{    
    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function scopeName($query, $value)
    {
    	return $query->where('name', $value);
    }
}
