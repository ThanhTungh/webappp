<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Idea extends Model
{
    use HasFactory;

    // Idea vs student: 1 idea has 1 student
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    // Idea vs comment (Coordinator): 1 idea has 1 comment
    public function comment(): HasOne
    {
        return $this->hasOne(Comment::class, 'idea_id');
    }

    // Idea vs Faculty (Student): 1 idea has 1 faculty
    public function faculty(): BelongsTo
    {
        return $this->belongsTo(Faculty::class, 'faculty_id');
    }
}
