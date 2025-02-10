<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventAttendance extends Model
{
    use HasFactory;

    protected $fillable = ['invitation_id', 'event_id', 'status'];

    public $timestamps = true;

    public function invitation() {
        return $this->belongsTo(EventInvitation::class);
    }

    public function event() {
        return $this->belongsTo(Event::class);
    }
}
