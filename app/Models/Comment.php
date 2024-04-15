<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    // Comment vs Coordinator: 1 comment has belong to 1 coordinator
    public function coordinator(): BelongsTo
    {
        return $this->belongsTo(MarketingCoordinator::class, 'coordinator_id');
    }
}
