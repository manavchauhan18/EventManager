<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon; // for handling date-time

class EventController extends Controller
{
    // Store a new event
    public function store(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_time' => 'required|date|after_or_equal:today',
            'end_time' => 'required|date|after:start_time',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        // Create the event, attaching the authenticated user's ID
        $event = Event::create([
            'name' => $request->name,
            'description' => $request->description,
            'start_time' => Carbon::parse($request->start_time),
            'end_time' => Carbon::parse($request->end_time),
            'created_by' => auth()->id(), // The ID of the logged-in user
        ]);

        return response()->json([
            'message' => 'Event created successfully',
            'event' => $event
        ], 201);
    }

    // Fetch all events
    public function index()
    {
        // Fetch events created by the authenticated user
        $events = Event::where('created_by', auth()->id())->get();

        return response()->json([
            'events' => $events
        ]);
    }
}
