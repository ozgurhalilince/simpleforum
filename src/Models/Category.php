<?php

namespace Ozgurince\Simpleforum\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'description', 'up_category_id'
    ];

    protected $dates = [
    	'created_at', 'updated_at'
    ];
    
    /**
     * Category belongs to Category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function up_category()
    {
    	// belongsTo(RelatedModel, foreignKey = category_id, keyOnRelatedModel = id)
    	return $this->belongsTo(Category::class, 'up_category_id');
    }

    /**
     * Category has many Subcategories.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subcategories()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = category_id, localKey = id)
        return $this->hasMany(Category::class, 'up_category_id');
    }

    /**
     * Category has many Questions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = category_id, localKey = id)
        return $this->hasMany(Question::class);
    }
}
