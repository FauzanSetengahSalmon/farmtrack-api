<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Livestock extends Model
{
    use HasFactory;
    protected $table = 'livestock';
    protected $fillable = [
        'user_email',
        'name',
        'type',
        'age',
        'weight',
        'photo'
    ];
}
