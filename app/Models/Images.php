<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Images extends Model
{
    use HasFactory;

    public function product(): BelongsTo {
        return $this->productVariant()->belongsTo(Product::class);
    }
    public function productVariant(): BelongsTo {
        return $this->belongsTo(ProductVariants::class);
    }
}
