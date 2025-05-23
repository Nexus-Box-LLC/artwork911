<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupons extends Model
{
    use HasFactory;
	protected $table = 'coupons';

    protected $fillable = [
		'title',
		'code',
		'expiry_date',
		'percentage',
		'no_of_usage_per_account',
	];
}
