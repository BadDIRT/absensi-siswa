<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    protected $fillable = ['class_id', 'nisn', 'name', 'gender', 'date_of_birth', 'nipd', 'class_id', 'department_id'];

    public function class(): BelongsTo
    {
        return $this->belongsTo(SchoolClass::class);
    }

    public function attendance(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}
