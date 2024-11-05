<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'description',
        'text',
        'img',
        'likes',    
        'dislikes',   
        'views',      
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function viewRecords()
    {
        return $this->hasMany(View::class);
    }

    public function likesOrDislikes()
    {
        return $this->hasMany(LikeOrDislike::class);
    }

    // Post bilan LikeOrDislike o'rtasidagi munosabat
    public function likes()
    {
        return $this->hasMany(LikeOrDislike::class)->where('value', 1);
    }

    // Post bilan LikeOrDislike o'rtasidagi munosabat
    public function dislikes()
    {
        return $this->hasMany(LikeOrDislike::class)->where('value', -1);
    }

    // Post bilan View o'rtasidagi munosabat
    public function views()
    {
        return $this->hasMany(View::class);
    }

    // Jami likelar sonini olish
    public function getLikesCountAttribute()
    {
        return $this->likes()->count();
    }

    // Jami dislikelar sonini olish
    public function getDislikesCountAttribute()
    {
        return $this->dislikes()->count();
    }

    // Jami views sonini olish
    public function getViewsCountAttribute()
    {
        return $this->views()->count();
    }
}
