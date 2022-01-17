<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LikeNotification extends Model
{
  /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'like_notification';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
