<?php

namespace App\Actions;

use OpenAI\Client;

class GenerateAvatar
{
    public function __invoke(string $prompt, Client $openAI): string
    {
        $response = $openAI->images()->create([
            'prompt' => $prompt,
            'n' => 1,
            'size' => '256x256',
            'response_format' => 'url',
        ]);

        return $response->data[0]->url;
    }
}
