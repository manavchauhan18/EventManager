<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'start_time', 'end_time', 'created_by',
    ];

    // Define relationship with the User model (if needed)
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
