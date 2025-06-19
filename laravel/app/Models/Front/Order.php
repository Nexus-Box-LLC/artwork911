<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'order_number',
        'type',
        'status',
        'user_id',
        'design_name',
        'po',
        'required_file_format',
        'fabric_name',
        'other_fabric_name',
        'garment_placement',
        'ds_width',
        'ds_height',
        'ds_length',
        'is_jacket_back',
        'is_artwork_authorized',
        'is_filled_with_stitching',
        'comments',
        'file_1',
        'file_2',
        'file_3',
        'file_4',
        'is_virtual_sample',
        'art_printing_type',
        'promo_code',
        'difficulty_level',
        'require_halftones',
        'color_type',
        'color_separation_required',
        'design_not_sure',
		'vendor_id',
		'amount',
		'discount_amount',
		'total_amount',
		'coupon_code',
		'discount_percent',
    ];

}
