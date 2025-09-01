<?php

namespace App\Http\Controllers;
use App\Models\ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function view(Request $request)
{
    $ticketNumber = $request->ticket_number;

    // You can now fetch the ticket or pass it to a view
    return view('student', compact('ticketNumber'));
}
public function search($ticketId)
    {
        // App\Http\Controllers\TicketController.php
 
 
    $ticket = Ticket::with('student')->where('opened_by_whois', $ticketId)->first();

    if (!$ticket) {
        return response()->json([
            'status' => 'error',
            'message' => 'التذكرة غير موجودة'
        ], 404);
    }

    // حفظ بيانات في السيشن
    session([
        'ticket_id' => $ticket->id,
        'student_id' => $ticket->student->id,
        'student_name' => $ticket->student->name
    ]);

    return response()->json([
        'status' => 'success',
        'ticket' => $ticket,
        'student' => $ticket->student
    ]);
}

    }
 
