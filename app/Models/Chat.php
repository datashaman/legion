<?php

namespace App\Models;

use App\Actions\CreateChatCompletion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function persona(): BelongsTo
    {
        return $this->belongsTo(Persona::class);
    }

    public function createChatCompletion(): string
    {
        $response = app()->call(CreateChatCompletion::class, [
            'messages' => $this->messages->toArray(),
        ]);

        $message = $response->choices[0]->message;

        $this->messages()->create($message->toArray());

        return $message->content;
    }
}
