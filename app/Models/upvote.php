<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class upvote extends Model
{
    //
    public function feature(): BelongsTo
    {
        return $this->belongsTo(Feature::class);
    }

}
