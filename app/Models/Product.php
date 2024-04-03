<?php

namespace App\Models;

use App\Models\ProductVariants;
use App\Models\Images;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
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
    public function featured_image() {
        $images = $this->images;
        //dd($images);
        foreach ($images as $image) {
            if ($image->featured) return $image;
        }
        return null;
    }
    public function image(): HasOne {
        return $this->hasOne(Images::class)->ofMany('featured','max');
    }
    public function productVariants(): HasMany {
        return $this->hasMany(ProductVariants::class);
    }

    public function images(): HasMany {
        return $this->hasMany(Images::class);
    }
}
