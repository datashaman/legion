<?php

namespace App\Actions;

use OpenAI\Client;

class CreateChat
{
    public function __invoke(
        array $params,
        Client $openAI
    ) {
        $params = array_merge(
            [
                'model' => 'gpt-3.5-turbo',
            ],
            $params
        );

        return $openAI->chat()->create($params);
    }
}
