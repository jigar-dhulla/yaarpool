<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class EstablishmentUser extends Pivot
{
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }
}
