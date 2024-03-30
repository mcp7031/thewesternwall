<?php

namespace App\Models;

use App\Models\ProductVariants;
use Illuminate\Database\Eloquent\Casts\Attribute;
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
    protected $casts = [
        'price' => Money::class
    ];
    /* price mutator
    */
    protected function setPriceAttribute($value) {
        $value = preg_replace('/[^0-9]/','',$value);
        $this->attributes['price'] = (int)($value);
    }
    /* price accessor
            */
    protected function price(): Attribute {
        return Attribute::make(
    get: function(int $value) {
        return new Money($value, new Currency('NZD'));
            }
        );
    }
    public function productVariants(): HasMany {
        return $this->hasMany(ProductVariants::class);
    }

    public function images(): HasMany {
        return $this->productVariants->hasMany(Images::class);
    }
}
