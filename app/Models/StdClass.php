<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StdClass extends Model
{
    protected $fillable = [
        'name'
    ];
    public function users()
    {
        return $this->hasMany(User::class, 'std_class_id');
    }

    public function sessions()
    {
        return $this->hasMany(SessionModel::class, 'std_class_id');
    }
}
