<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TextContent extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'text'];
    //protected $table = 'text_content';

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
