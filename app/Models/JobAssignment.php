<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobAssignment extends Model
{
    protected $table = 'job_assignments';

    protected $fillable = [
        'assignment_type',
        'reference_id',
        'reference_type',
        'assigned_to',
        'assigned_by',
        'status',
        'scheduled_at',
        'started_at',
        'completed_at',
        'notes',
        'proof_photo_url',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function reference()
    {
        return $this->morphTo();
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function assignedBy()
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }
}
