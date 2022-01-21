<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Notification extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'notification';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The notification's corresponding user.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    function date()
    {
        if (!is_null($this->friend_request())) {
            return $this->friend_request()->creation_date;
        } elseif (!is_null($this->like())) {
            return $this->like()->date;
        } elseif (!is_null($this->comment())) {
            return $this->comment()->comment_date;
        }
    }

    /**
     * Get the corresponding friend request, null if it's not a friend request notification
     */
    public function friend_request()
    {
        return FriendRequest::find(DB::table('friend_request')->whereIn('id', function ($query) {
            $query->select('id_friend_request')
                ->from('friend_request_notification')
                ->where('id_notification', $this->id);
        })->value('id'));
    }

    /**
     * Get the corresponding friend request, null if it's not a friend request notification
     */
    public function like()
    {
        return Like::find(DB::table('content_like')->whereIn('id', function ($query) {
            $query->select('id_like')
                ->from('like_notification')
                ->where('id_notification', $this->id);
        })->value('id'));
    }

    /**
     * Get the corresponding friend request, null if it's not a friend request notification
     */
    public function comment()
    {
        return Comment::find(DB::table('comment')->whereIn('id', function ($query) {
            $query->select('id_comment')
                ->from('comment_notification')
                ->where('id_notification', $this->id);
        })->value('id'));
    }
}
