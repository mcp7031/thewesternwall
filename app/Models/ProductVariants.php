<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductVariants extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'attribute',
        'quantity',
    ];

    public function product(): BelongsTo {
        return $this->belongsTo(Product::class);
    }
    public function images(): HasMany {
        return $this->hasMany(Images::class);
    }
}
