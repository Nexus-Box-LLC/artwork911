<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VectorizingpPrice extends Model
{
    use HasFactory;
	
	protected $table = 'vectorizing_prices';

	protected $fillable = [
        'simple',
        'complex',
        'logo_design',
		'color_seprater'
    ];
}
