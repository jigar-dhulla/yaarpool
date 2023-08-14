<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Establishment extends Model
{
    use SoftDeletes;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'type',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->using(EstablishmentUser::class)
            ->withTimestamps()
            ->withPivot(['role_id']);
    }

    public function routesAsOrigin(): HasMany
    {
        return $this->hasMany(Route::class);
    }

    public function routesAsDestination(): HasMany
    {
        return $this->hasMany(Route::class, 'to_establishment_id');
    }

    public function locations(): HasMany
    {
        return $this->hasMany(Location::class);
    }
}
