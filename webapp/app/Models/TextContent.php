<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TextContent extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'text_content';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_content';

    //public $incrementing = true;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['post_text'];

    public function scopeWithId($query, $id)
    {
        return $query->whereId($id);
    }

    public function getUrlAttribute()
    {
        return route('posts.single', $this->id);
    }

    /**
     * Get the TextContent's content.
     */
    public function content()
    {
        return $this->morphOne(Content::class, 'contentable', null, 'id');
    }

    /**
     * Get the TextContent's replies (other TextContents).
     */
    public function replies()
    {
        return $this->belongsToMany(TextContent::class, 'text_reply', 'parent_text', 'child_text');
    }

    /**
     * Get the TextContent's parent (other TextContent).
     */
    public function parent()
    {
        return $this->belongsToMany(TextContent::class, 'text_reply', 'child_text', 'parent_text');
    }

    /**
     * Check if it is a root TextContent
     */
    public function isRoot()
    {
        return $this->parent->isEmpty();
    }
}
