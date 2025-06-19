<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Affiliate extends Model
{
    use HasFactory;
    protected $table = 'affiliate';

    protected $fillable = [
		'company_name',
		'phone',
		'main_contact_name',
		'email',
		'link',
	];

}
