<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\User;
use App\Models\Aoc;
use App\CustomClasses\BotMessage;

class TelegramPosts extends Model
{
    protected $table = 'TelegramPosts';
    use HasFactory;

    protected $fillable = [
        'id',
        'body',
        'aoc_id',
        'user_id',
        'title',
        'excerpt',
        'link',
        'published_at',
        'price',
        'hashtag'
    ];

    public function bot_message(): HasOne {
        return $this->hasOne(BotMessage::class);
    }
    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
    public function category(): BelongsTo {
        return $this->belongsTo(Aoc::class);
    }
    public function html(): Attribute {
        return Attribute::get(fn() => str($this->body)->markdown());
    }
}
