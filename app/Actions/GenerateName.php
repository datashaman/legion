<?php

namespace App\Actions;

use OpenAI\Client;

class GenerateName
{
    public function __invoke(string $act, Client $openAI): string
    {
        $content = <<<EOF
        Generate the name of an agent acting as '{$act}'.
        EOF;

        $response = $openAI->chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'system', 'content' => $content],
            ],
        ]);

        return $response->choices[0]->message->content;
    }
}
