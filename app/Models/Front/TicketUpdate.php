<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketUpdate extends Model
{
    use HasFactory;

    protected $table = 'tickets_updates';

    protected $fillable = [
        'updated_by',
        'user_type',
        'ticket_id',
        'message',
        'attachment',
    ];

}
