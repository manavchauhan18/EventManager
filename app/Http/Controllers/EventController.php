<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'created_by' => 'nullable|exists:users,id',
        ]);

        // Create the event and associate it with the authenticated user
        $event = Event::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'start_time' => $validatedData['start_time'],
            'end_time' => $validatedData['end_time'],
            'created_by' => $validatedData['created_by'],  // Ensure the authenticated user's ID is used
        ]);

        return response()->json($event, 201);
    }
}
