<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Carts extends Model
{
    use HasFactory;

    public function cartItem(): HasMany {
        return $this->hasMany(CartItems::class);
    }
    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
    public function session(): HasMany {
        return $this->user()->hasMany(Sessions::class);
    }
}
