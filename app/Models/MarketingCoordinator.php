<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;

class MarketingCoordinator extends Authenticatable
{
    use HasFactory;

    // Coordinator vs Faculty: 1 coordinator has 1 faculty
    public function faculty(): HasOne
    {
        return $this->hasOne(Faculty::class, 'coordinator_id', 'id'); // Faculty::class, foreign_key(Faculty), owner_key(marketingCoordinator)
        // , 'coordinator_id', 'id'
    }

    // Coordinator vs Comment: 1 coordinator has 1 comment (Coordinator)
    public function comment(): HasOne
    {
        return $this->hasOne(Comment::class, 'comment_id', 'id');
    }
}
