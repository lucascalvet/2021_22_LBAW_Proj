<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'media'];

    public function scopeWithId($query, $id)
    {
        return $query->whereId($id);
    }

    public function scopeWithTitle($query, $title)
    {
        return $query->whereTitle($title);
    }

    public function getUrlAttribute()
    {
        return route('posts.single', $this->id);
    }
}
