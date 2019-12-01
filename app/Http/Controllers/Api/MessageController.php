<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MessageResource;
use App\Http\Resources\MessagesResourceCollection;
use App\Message;
use App\Ticket;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($ticketId) : MessagesResourceCollection
    {
        try {
            $ticket = Ticket::findOrFail($ticketId);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        $messages = Message::where('ticket_id', $ticketId)->paginate();

        return new MessagesResourceCollection($messages);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($ticketId, Request $request) : MessageResource
    {
        try {
            $ticket = Ticket::findOrFail($ticketId);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        $message = new Message();
        $message->text = $request->text;
        $message->ticket_id = $ticketId;
        $message->user_id = auth()->user()->id;
        $message->save();

        return new MessageResource($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showLastMessage($ticketId) : MessageResource
    {
        try {
            $ticket = Ticket::findOrFail($ticketId);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        $message = Message::where('ticket_id', $ticketId)->latest('created_at')->first();

        return new MessageResource($message);
    }
}
