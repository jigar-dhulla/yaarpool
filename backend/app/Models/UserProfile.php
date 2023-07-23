<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserProfile extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'bio',
        'occupation',
        'start_time',
        'end_time',
        'has_vehicle',
        'four_wheeler',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
