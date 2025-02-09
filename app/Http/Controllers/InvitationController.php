<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Models\User;
use Illuminate\Http\Request;

class InvitationController extends Controller
{
    // Store an invitation
    public function store(Request $request)
    {
        // Validate request data
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'user_id' => 'required|exists:users,id',
        ]);

        // Create the invitation
        $invitation = Invitation::create([
            'event_id' => $request->event_id,
            'user_id' => $request->user_id,
            'status' => 'pending', // default status, you can change this
        ]);

        return response()->json([
            'message' => 'Invitation sent successfully',
            'invitation' => $invitation
        ], 201);
    }
}
