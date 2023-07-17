<?php

namespace App\Actions;

use OpenAI\Client;

class GenerateAvatar
{
    public function __invoke(string $name, string $act, Client $openAI): string
    {
        $prompt = <<<EOF
        avatar named '{$name}' acting as '{$act}', digital art.
        EOF;

        $response = $openAI->images()->create([
            'prompt' => $prompt,
            'n' => 1,
            'size' => '256x256',
            'response_format' => 'url',
        ]);

        return $response->data[0]->url;
    }
}
