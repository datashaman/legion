<?php

namespace App\Models;

use App\Enums\MessageRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'function_call',
        'name',
        'role',
    ];

    protected $casts = [
        'role' => MessageRole::class,
    ];

    public function chat(): BelongsTo
    {
        return $this->belongsTo(Chat::class);
    }

    public function persona(): BelongsTo
    {
        return $this->belongsTo(Persona::class);
    }

    public function toArray(): array
    {
        return array_filter([
            'role' => $this->role->value,
            'name' => $this->name,
            'content' => $this->content,
            'function_call' => $this->function_call,
        ]);
    }
}
