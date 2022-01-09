<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'groups';

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
    protected $fillable = ['name', 'description'];

    /**
     * The members of a group.
     */
    public function members()
    {
        return $this->belongsToMany(User::class, 'group_member', 'id_group', 'id_user_member');
    }

    /**
     * The moderators of a group.
     */
    public function moderators()
    {
        return $this->belongsToMany(User::class, 'group_moderator', 'id_group', 'id_user_moderator');
    }

    /**
     * The contents published in this group.
     */
    public function contents()
    {
        return $this->hasMany(Content::class, 'id_group');
    }


}
