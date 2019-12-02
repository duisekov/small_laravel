<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TicketsResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        foreach ($this->collection as $ticket) {
            $ticket->user_id = $ticket->user->name;
            $ticket['last_response'] = $ticket->messages->last();
            $ticket->department_id = $ticket->department->name;
        }
        return [
            'data' => $this->collection,
        ];
    }
}
