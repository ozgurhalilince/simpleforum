<?php

namespace Ozgurince\Simpleforum\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
  use SoftDeletes;

  protected $fillable = [
      'question', 'body', 'category_id', 'user_id'
  ];

  protected $dates = [
  	'created_at', 'updated_at'
  ];

 	/**
 	 * Question belongs to User.
 	 *
 	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
 	 */
 	public function user()
 	{
 		// belongsTo(RelatedModel, foreignKey = user_id, keyOnRelatedModel = id)
 		return $this->belongsTo(User::class);
 	}

  /**
   * Question morphs many Comment.
   *
   * @return \Illuminate\Database\Eloquent\Relations\MorphMany
   */
  public function comments()
  {
    // morphMany(MorphedModel, morphableName, type = able_type, relatedKeyName = able_id, localKey = id)
    return $this->morphMany(Comment::class, 'commentable');
  }

  /**
   * Question morphs many File.
   *
   * @return \Illuminate\Database\Eloquent\Relations\MorphMany
   */
  public function files()
  {
    // morphMany(MorphedModel, morphableName, type = able_type, relatedKeyName = able_id, localKey = id)
    return $this->morphMany(File::class, 'filelable');
  }

  /**
   * Question belongs to Category.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function category()
  {
    // belongsTo(RelatedModel, foreignKey = category_id, keyOnRelatedModel = id)
    return $this->belongsTo(Category::class);
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
