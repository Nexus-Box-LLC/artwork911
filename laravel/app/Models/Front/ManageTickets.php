<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageTickets extends Model
{
    use HasFactory;
    protected $table = 'tickets';

    protected $fillable = [
        'created_by',
        'status',
        'title',
        'reason',
        'order_number',
        'message',
        'attachment',
		'ticket_number',
    ];
}
