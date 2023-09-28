<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owenamusic extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'phone', 'learning_mode', 'course',
        'for_self', 'prior_exp', 'package'
    ];
}
