<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Persona extends Model
{
    use HasFactory;

    protected $fillable = [
        'act',
        'name',
        'prompt',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function chats(): BelongsToMany
    {
        return $this->belongsToMany(Chat::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function storeAvatar(?string $url): void
    {
        if (!$url) {
            $this->attributes['avatar'] = '';

            return;
        }

        if ($url === $this->avatar) {
            return;
        }

        $contents = file_get_contents($url);
        $crc32 = crc32($contents);

        Storage::disk('public')->put("avatars/{$crc32}.png", $contents);

        $this->avatar = asset("storage/avatars/{$crc32}.png");
    }
}
