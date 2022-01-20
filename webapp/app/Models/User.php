<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'name', 'email', 'hashed_password', 'phone_number', 'birthday', 'id_country', 'description',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'hashed_password', 'remember_token',
    ];

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->hashed_password;
    }

    /**
     * The contents published by this user.
     */
    public function contents()
    {
        return $this->hasMany(Content::class, 'id_creator');
    }

    /**
     * Determine if the user is an admin.
     */
    public function isAdmin()
    {
        return $this->id == 22;
    }


    public function friendRequests(){
        return $this->hasMany(FriendRequest::class, 'id_receiver');
    }

    public function gotFriendRequestFrom($sender){
        foreach($this->friendRequests as $friend_request){
            if ($friend_request->id_sender == $sender->id)
                return true;
        }
        return false;
    }
    
    public  function friends(){
        return $this->belongsToMany(Friends::class, 'friends', 'id_user1', 'id_user2');
    }

    public function isFriendOf($user_id){
        foreach($this->userFriends as $friend){
            if ($friend->id == $user_id)
                return true;
        }
        return false;
    }

    public function userFriends(){
        return $this->belongsToMany(User::class, 'friends', 'id_user2', 'id_user1')->union($this->belongsToMany(User::class, 'friends', 'id_user1', 'id_user2'));
    }

    // public function getFriends()
    // {
    //     $f1 = $this->friend();
    //     $f2 = $this->friend2();
    //     $friends = $f1->union($f2);
    //     return $friends;
    // }

    /**
     * The groups that the user is member of.
     */
    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_member', 'id_user_member', 'id_group');
    }

    /**
     * The groups that the user is moderator of.
     */
    public function mod_groups()
    {
        return $this->belongsToMany(Group::class, 'group_moderator', 'id_user_moderator', 'id_group');
    }

}
