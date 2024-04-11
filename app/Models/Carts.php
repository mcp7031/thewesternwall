<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;
use App\CustomClasses\PriceUpdate;
use App\CustomClasses\InventoryUpdate;

class Carts extends Model implements \SplSubject {

    use HasFactory;

    protected $fillable =  [
        'user_id',
        'session_id'
    ];
    protected $cart;
    protected $items;
    private $observers;

    public function __construct() {
        $this->items = new Collection();
        $this->observers = new \SplObjectStorage();
    }
    public function addItem($variant_id) {
        if (auth()->guest()) {
            $this->cart = Carts::firstOrCreate([
                'session_id' => session()->getId()
            ],[
                    'session_id' => session()->getId()
                ]);
        }

        if (auth()->user()) {
            $this->cart = auth()->user()->cart ?: auth()->user()->cart->create();
        }

        $item = CartItems::updateOrCreate([
            'carts_id' => $this->cart->id,
            'product_variants_id' => $variant_id],[
                'carts_id' => $this->cart->id,
                'product_variants_id' => $variant_id,
                'quantity' => 1
            ]);
        $this->items->push($item);
        $this->observers->attach(new PriceUpdate());
        $this->observers->attach(new InventoryUpdate());
        $this->notify();
        //dd($this);
    }

    public function notify():void {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }

    public function attach(\SplObserver $observer):void {
        $this->observers->attach($observer);
    }

    public function detach(\SplObserver $observer):void {
        $this->observers->detach($observer);
    }
    public function delItem($variant_id) {
        // delete item from the Cart
    }

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
