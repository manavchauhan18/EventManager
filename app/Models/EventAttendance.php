<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventAttendance extends Model
{
    use HasFactory;

    protected $fillable = ['invitation_id', 'status'];

    public function invitation() {
        return $this->belongsTo(EventInvitation::class);
    }
}
