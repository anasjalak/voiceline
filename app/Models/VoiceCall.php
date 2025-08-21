<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VoiceCall extends Model
{
    protected $table = 'voice_calls';
    protected $primaryKey = 'call_id';
    public $timestamps = true; // table has created_at & updated_at

    protected $fillable = [
        'customer_type',
        'customer_id',
        'category',
        'description',
        'status',
        'priority',
        'handled_by_user_id',
        'ticket_number'  // <-- add here
    ];
}
