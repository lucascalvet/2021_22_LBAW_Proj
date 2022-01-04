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
     * The contents published by this user.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'id_creator');
    }
    
    /**
     * Get the specific content.
     */
    public function contentable()
    {
        return $this->morphTo(null, null, 'id');
    }

}
