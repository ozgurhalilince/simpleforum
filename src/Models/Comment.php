<?php

namespace Ozgurince\Simpleforum\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'body', 'commentable_id', 'commentable_type'
    ];

    protected $dates = [
    	'created_at', 'updated_at'
    ];

    public function commentable()
    {
        return $this->morphTo();
    }

    /**
     * Comment belongs to User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
    	// belongsTo(RelatedModel, foreignKey = user_id, keyOnRelatedModel = id)
    	return $this->belongsTo(User::class);
    }

    /**
     * Comment morphs many File.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function files()
    {
        // morphMany(MorphedModel, morphableName, type = able_type, relatedKeyName = able_id, localKey = id)
        return $this->morphMany(File::class, 'filelable');
    }

    /**
     * Comment has many Likes.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function likes()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = comment_id, localKey = id)
        return $this->hasMany(Like::class);
    }

    public function isLiked()
    {
        $collection = $this->likes->pluck('user_id');   //takes the user id's
        
        return $collection->contains(Auth::user()->id); //return true if auth user liked this comment
    }

    public function canEditOrDelete()
    {
        if (Auth::guest()) 
          return false;
        if (Auth::user()->isAdmin())
          return true;
        return $this->user->id == Auth::user()->id;
    }
}
