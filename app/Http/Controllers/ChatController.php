<?php

namespace App\Http\Controllers;

use App\Actions\CreateChatCompletion;
use App\Http\Requests\StoreChatRequest;
use App\Http\Requests\UpdateChatRequest;
use App\Models\Chat;
use App\Models\Persona;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Persona $persona)
    {
        return view('chats.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Persona $persona)
    {
        return view('chats.create', [
            'persona' => $persona,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreChatRequest $request, Persona $persona)
    {
        $validated = $request->validated();

        $chat = new Chat($validated);

        $chat->persona_id = $persona->id;
        $chat->user_id = auth()->user()->id;

        if ($chat->save()) {
            $chat->messages()->create([
                'role' => 'system',
                'content' => $persona->prompt,
            ]);

            $topic = $chat->topic ? "with the topic '{$chat->topic}'" : '';

            $chat->messages()->create([
                'role' => 'system',
                'content' => <<<EOF
                    Your name is '{$persona->name}'.
                    You are starting a new chat titled '{$chat->name}' {$topic}.
                    Introduce yourself.
                    EOF,
            ]);

            $chat->createChatCompletion();

            return redirect()->route('chats.show', [
                'persona' => $persona,
                'chat' => $chat,
            ]);
        }

        return redirect()->back()->withError('Chat not created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Persona $persona, Chat $chat)
    {
        return view('chats.show', [
            'chat' => $chat,
            'persona' => $persona,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Persona $persona, Chat $chat)
    {
        return view('chats.edit', [
            'chat' => $chat,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateChatRequest $request, Persona $persona, Chat $chat)
    {
        return $chat->update($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Persona $persona, Chat $chat)
    {
        return $chat->delete();
    }
}
