<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Persona;
use App\Http\Requests\StoreMessageRequest;

class MessageController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Persona $persona, Chat $chat, StoreMessageRequest $request)
    {
        $validated = $request->validated();

        $chat->messages()->create([
            'role' => 'user',
            'content' => $validated['content'],
        ]);

        $chat->createChatCompletion();
    }
}
