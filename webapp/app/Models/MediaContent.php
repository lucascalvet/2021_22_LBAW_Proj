<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaContent extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'media_content';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_content';

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
    protected $fillable = ['description', 'media', 'alt_text'];

    public function scopeWithId($query, $id)
    {
        return $query->whereId($id);
    }

    public function getUrlAttribute()
    {
        return route('posts.single', $this->id);
    }

    /**
     * Get the media_content's content.
     */
    public function content()
    {
        return $this->morphOne(Content::class, 'contentable');
    }

    /**
     * Get the specific content.
     */
    public function media_contentable()
    {
        return $this->morphTo(null, null, 'id');
    }
}
