<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'comment';

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
    protected $fillable = ['comment_text'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['comment_date'];

    /**
     * The media content that was commented.
     */
    public function media_content()
    {
        return $this->belongsTo(MediaContent::class, 'id_media_content');
    }

    /**
     * The comment's author.
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'id_author');
    }
}
