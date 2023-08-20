<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Route extends Model
{
    use HasFactory;

    public function establishment(): BelongsTo
    {
        return $this->belongsTo(Establishment::class);
    }
    
    public function from(): BelongsTo
    {
        return $this->establishment();
    }

    public function to(): BelongsTo
    {
        return $this->belongsTo(Establishment::class, 'to_establishment_id');
    }
}
