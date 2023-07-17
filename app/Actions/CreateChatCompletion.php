<?php

namespace App\Actions;

use OpenAI\Client;

class CreateChatCompletion
{
    public function __invoke(
        array $messages,
        Client $openAI
    ) {
        $params = [
            'model' => 'gpt-3.5-turbo',
            'messages' => $messages,
        ];

        return $openAI->chat()->create($params);
    }
}
