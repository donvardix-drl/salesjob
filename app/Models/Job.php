<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $table = 'salesjobs';

    protected $fillable = [
        'title',
        'company',
        'short',
        'description'
    ];
}
