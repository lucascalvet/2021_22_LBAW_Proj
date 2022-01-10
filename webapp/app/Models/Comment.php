<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
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
  }
