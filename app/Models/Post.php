<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'body'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($post) {
            $post->comments()->delete(); // Delete all comments
            $post->tags()->detach(); // Remove tags from pivot table
        });
    }
}
