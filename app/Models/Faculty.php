<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Faculty extends Model
{
    use HasFactory;

    // Faculty vs Coordinator: 1 F has 1 C
    public function coordinator(): BelongsTo
    {
        return $this->belongsTo(MarketingCoordinator::class, 'coordinator_id', 'id'); // MarketingCoordinator::class, foreign_key(faculty), owner_key(marketingCoordinator)
    }

    // Faculty vs Student: 1 faculty has many students
    public function students(): HasMany
    {
        return $this->hasMany(Student::class, 'faculty_id');
    }

    // Faculty vs Idea: 1 faculty has 1 idea (Student)
    public function idea(): HasOne
    {
        return $this->hasOne(Idea::class, 'faculty_id');
    }

    // Faculty vs Idea: 1 faculty has many ideas (Coordinator)
    public function ideas(): HasMany
    {
        return $this->hasMany(Idea::class, 'faculty_id');
    }

}
