<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommentNotification extends Model
{
  /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'comment_notification';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
