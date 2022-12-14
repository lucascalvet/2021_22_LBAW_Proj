<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'content';

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
    protected $fillable = ['id_creator'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['publishing_date'];

    /**
     * The creator of the content.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'id_creator');
    }

    /**
     * The group where the content is posted.
     */
    public function group()
    {
        return $this->belongsTo(Group::class, 'id_group');
    }

    /**
     * Get the specific content.
     */
    public function contentable()
    {
        return $this->morphTo(null, null, 'id');
    }

    /**
     * Get the number of comments or text replies
     */
    public function comment_count()
    {
        if ($this->contentable instanceof MediaContent) return $this->contentable->comments->count();
        else if ($this->contentable instanceof TextContent) return $this->contentable->replies->count();
    }

    /**
     * The likes a content has
     */
    public function likes()
    {
        return $this->hasMany(Like::class, 'id_content');
    }

    public function numberOfLikes()
    {
        $nLikes = $this->likes->count();

        return $nLikes;
    }
}
