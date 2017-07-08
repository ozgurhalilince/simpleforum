<?php

namespace Ozgurince\Simpleforum\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = [
        'user_id', 'comment_id'
    ];
    
}
