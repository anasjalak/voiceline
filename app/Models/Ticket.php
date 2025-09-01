<?php

 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model {
    protected $table = 'tickets';
    protected $primaryKey = 'ticket_serial_no';
    public $timestamps = false;

    protected $fillable = [
        'ticket_number','ticket_id','ticket_category','issue_date',
        'opened_type','opened_by_whois','Ticket_status','priority','ticket_url'
    ];

    public function student() {
        return $this->belongsTo(Student::class, 'opened_by_whois', 'stud_id');
    }

     
}
