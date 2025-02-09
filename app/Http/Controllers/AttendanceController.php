<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Mark attendance for a user at an event.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function markAttendance(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id', // Ensure the user exists
            'event_id' => 'required|exists:events,id', // Ensure the event exists
            'status' => 'required|in:present,absent', // Status can be present or absent
        ]);

        // Find the event and user
        $event = Event::find($validatedData['event_id']);
        $user = User::find($validatedData['user_id']);

        // Check if the event and user exist
        if (!$event || !$user) {
            return response()->json(['message' => 'Event or User not found'], 404);
        }

        // Mark attendance for the user at the event
        $attendance = Attendance::create([
            'user_id' => $user->id,
            'event_id' => $event->id,
            'status' => $validatedData['status'],
        ]);

        return response()->json(['message' => 'Attendance marked successfully', 'attendance' => $attendance], 201);
    }
}
