<?php

namespace App\Http\Controllers;

use App\Models\EventAttendance;
use App\Models\EventInvitation;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Mark attendance for an event.
     */
    public function markAttendance(Request $request)
    {
        // Validate request
        $validatedData = $request->validate([
            'event_id' => 'required|exists:events,id',
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:present,absent',
        ]);

        // Mark attendance
        $attendance = EventAttendance::create([
            'invitation_id' => $validatedData['user_id'],
            'event_id' => $validatedData['event_id'], 
            'status' => $validatedData['status'],
        ]);

        return response()->json(['message' => 'Attendance marked successfully', 'attendance' => $attendance], 201);
    }
}
