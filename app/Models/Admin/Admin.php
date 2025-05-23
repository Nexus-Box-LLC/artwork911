<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Admin extends Authenticatable
{
    use HasFactory;

	protected $table = 'admin';

	protected $fillable = [
        'username',
        'email',
		'role_id',
        'password',
		'company_name',
		'type',
        'status',
        'profile_image'
    ];
}
