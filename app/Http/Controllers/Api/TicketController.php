<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TicketResource;
use App\Http\Resources\TicketsResourceCollection;
use App\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() : TicketsResourceCollection
    {
        // show all tickets for moderator or filter them if user is client
        if (auth()->user()->role_id == 1) {
            $tickets = Ticket::orderBy('created_at', 'desc')->paginate(5);
        } else {
            $tickets = Ticket::where('user_id', auth()->user()->id)->paginate(5);
        }


        return new TicketsResourceCollection($tickets);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) : TicketResource
    {
        $ticket = new Ticket();

        $ticket->title = $request->title;
        $ticket->description = $request->description;
        $ticket->user_id = auth()->user()->id;
        $ticket->department_id = $request->department_id;

        $ticket->save();

        return new TicketResource($ticket);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) : TicketResource
    {
        $ticket = Ticket::findOrFail($id);

        // check whether authenticated user is client and creator of ticket
        if (auth()->user()->role_id == 2 && auth()->user()->id != $ticket->user_id) {
            return response()->json(error);
        }

        return new TicketResource($ticket);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);

        // close ticket
        $ticket->is_active = false;
        $ticket->save();

        return new TicketResource($ticket);
    }
}
