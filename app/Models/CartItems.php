<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Carts;
use App\Models\User;

class CartItems extends Model
{
    use HasFactory;

    protected $fillable = [
        'carts_id',
        'product_variants_id',
        'quantity'
    ];

    public function cart(): BelongsTo {
        return $this->belongsTo(Carts::class);
    }
    public function user(): BelongsTo {
        return $this->cart()->belongsTo(User::class);
    }
    public function variant() :BelongsTo {
        return $this->belongsTo(ProductVariants::class);
    }
    public function product() {
        return $this->variant->product;
    }
    public function session(): HasMany {
        return $this->user()->hasMany(Sessions::class);
    }
}
