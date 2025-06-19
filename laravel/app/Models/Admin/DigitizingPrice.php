<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DigitizingPrice extends Model
{
    use HasFactory;

	protected $table = 'digitizing_prices';

	protected $fillable = [
        'placement',
        'price',
        'max_width',
		'max_height'
    ];
}
