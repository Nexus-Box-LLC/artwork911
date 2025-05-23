<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

	protected $table = 'deliveries';

	protected $fillable = [
        'vendor_id',
        'user_id',
        'order_id',
		'message',
		'file'
    ];
}
