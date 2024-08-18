<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OauthToken extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 
        'access_token', 
        'expires_in', 
        'refresh_token'
    ];

    public function hasExpired()
    {
        return now()->gte($this->updated_at->addSeconds($this->expires_in));
    }

}
