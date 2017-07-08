<?php

namespace Ozgurince\Simpleforum\Models;

use Ozgurince\Simpleforum\Models\Role;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'photo_path', 'about_me', 'phone_number', 'role_id', 'api_token', 
        'remember_token', 'username', 'is_active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function isAdmin()
    {
        return $this->role->name == "admin";
    }

    public function isEditor()
    {
        return $this->role->name == "editor";
    }

    public function isMember()
    {
        return $this->role->name == "member";
    }

    public function isBanned()
    {
        return $this->role->name == "banned";
    }

    public function isActive()
    {
        return $this->is_active == 1;
    }

    /**
     * Query scope username.
     *
     * @param  \Illuminate\Database\Eloquent\Builder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUsername($query, $username)
    {
        return $query->where('username', $username);
    }

    /**
     * User has many Questions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = user_id, localKey = id)
        return $this->hasMany(Question::class);
    }

    /**
     * User has many Comments.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = user_id, localKey = id)
        return $this->hasMany(Comment::class);
    }
}
