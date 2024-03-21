<?php

namespace App\Models;

use App\Models\ProductVariants;
use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Money\Currency;
use Money\Money;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
    ];

    protected function price(): Attribute {
        return Attribute::make(
    get: function(int $value) {
        return new Money($value, new Currency(code: 'NZD'));
            }
        );
    }
    public function productVariant(): HasMany {
        return $this->hasMany(ProductVariants::class);
    }

    public function images(): HasMany {
        return $this->productVariant()->hasMany(Images::class);
    }
}
