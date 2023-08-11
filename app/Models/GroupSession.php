<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GroupSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'topic', 'description', 'meeting_link',
        'max_attendants', 'start_time', 'end_time'
    ];

    public function mentor(): BelongsTo
    {
        return $this->belongsTo(Mentor::class);
    }
}
