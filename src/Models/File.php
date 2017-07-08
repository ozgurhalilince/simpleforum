<?php

namespace Ozgurince\Simpleforum\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'path', 'fillable_id', 'fillable_type'
    ];

    protected $dates = [
    	'created_at', 'updated_at'
    ];

    public function filelable()
    {
        return $this->morphTo();
    }

}