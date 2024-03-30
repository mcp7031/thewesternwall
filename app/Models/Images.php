<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Images extends Model
{
    use HasFactory;

    public function product():BelongsTo {
        return $this->productVariants->product();
    }
    public function productVariants():BelongsTo {
        return $this->belongsTo(ProductVariants::class);
    }
    public function ProductName() : Attribute {
        return Attribute::make(
            get: function () {
                return $this->product->name;
            }
        );
    }
}
