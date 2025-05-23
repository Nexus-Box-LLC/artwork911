<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use   HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'date_created',
		'first_name',
		'last_name',
        'email',
        'password',
		'username',
		'phone',
        'promo_code',
		'verified',
		'token_valid_till'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function verifyUser()
    {
        return $this->hasOne('App\Models\VerifyUser');
    }

	//https://pusher.com/tutorials/multiple-authentication-guards-laravel/
	//https://www.laravelcode.com/post/how-to-make-admin-auth-in-laravel8-with-example
}
