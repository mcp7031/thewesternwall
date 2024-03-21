<?php

//namespace App\Models;
namespace App\CustomClasses;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\User;
use App\Models\Chat;
use App\Models\TelegramPosts;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Longman\TelegramBot\Entities\Message as BotMsg;

class BotMessage extends BotMsg
{
    protected $table = 'bot_message';

    use HasFactory;

    public function TelegramPosts(): HasOne {
        return $this->hasOne(TelegramPosts::class);
    }
    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
    public function chat(): BelongsTo {
        return $this->belongsTo(Chat::class);
    }
    public function html(): Attribute {
        return Attribute::get(fn() => str($this->body)->markdown());
    }
}
