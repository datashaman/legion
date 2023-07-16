<?php

use Symfony\Component\Yaml\Yaml;

return [
    'source' => 'https://github.com/f/awesome-chatgpt-prompts/raw/main/prompts.csv',
    'prompts' => Yaml::parseFile(resource_path('prompts.yml')),
];
