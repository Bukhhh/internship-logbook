<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternLog extends Model
{
    use HasFactory;

    // We only need ONE $fillable array containing all 5 allowed columns
    protected $fillable = [
        'user_id', 
        'task_name', 
        'details', 
        'log_date', 
        'status',
        'supervisor_remarks'
    ];

    // The relationship function linking this log to a specific user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}