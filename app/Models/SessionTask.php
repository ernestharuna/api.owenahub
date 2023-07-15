<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SessionTask extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id', 'title', 'content', 'completed'
    ];

    public function session(): BelongsTo
    {
        return $this->belongsTo(Session::class);
    }
}
