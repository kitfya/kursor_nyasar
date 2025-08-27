<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'content',
        'thumbnail',
        'status',
        'published_at',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Categories::class);
    }

    public function tag()
    {
        return $this->belongsToMany(Tags::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    protected static function boot()
{
    parent::boot();

    static::creating(function ($post) {
        if (! $post->user_id) {
            $post->user_id = auth()->id();
        }
    });

    static::creating(function ($post) {
    if (! $post->category_id) {
        $post->category_id = 1;
    }
});
}

}
