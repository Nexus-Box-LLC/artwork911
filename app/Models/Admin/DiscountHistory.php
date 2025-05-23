<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountHistory extends Model
{
    use HasFactory;
	protected $table = 'discounts_history';
	
	protected $fillable = [
		'coupon_id',
		'user_id',
		'order_id',
		'coupon_code',
		'coupon_percent',
	];
}
