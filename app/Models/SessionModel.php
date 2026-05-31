<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SessionModel extends Model
{
    protected $fillable = [
        'std_class_id',
        'title',
        'start_time',
        'end_time',
    ];
    protected function casts(): array
    {
        return [
            'start_time' => 'datetime',
            'end_time' => 'datetime',
        ];
    }
    public function class()
    {
        return $this->belongsTo(StdClass::class, 'std_class_id');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'session_id');
    }
}
