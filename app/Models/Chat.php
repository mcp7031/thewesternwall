<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\User;
use App\Models\Message;

class Chat extends Model
{
    protected $table = 'bot_chat';

    use HasFactory;


    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
    public function sender(): HasMany {
        return $this->hasMany(User::class);
    }
    public function message(): HasMany {
        return $this->hasMany(Message::class);
    }
    public function html(): Attribute {
        return Attribute::get(fn() => str($this->body)->markdown());
    }
}
