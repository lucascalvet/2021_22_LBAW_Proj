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
     * The likes a content has
     */
    public function likes()
    {
        return $this->hasMany(Like::class, 'id_content');
    }

    public function numberOfLikes(){
        $nLikes = $this->likes->count();

        return $nLikes;
    }

}
