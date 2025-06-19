<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderHistory extends Model
{
	use HasFactory;

    protected $table = 'order_histories';
    
	protected $fillable = [
		'order_id', 
		'by_user', 
		'user_type',
		'description',
		'type',
		'status'
	];
}
