<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Symfony\Component\Yaml\Yaml;

class ImportPrompts extends Command
{
    /**
     * @var string
     */
    protected $signature = 'import-prompts';

    /**
     * @var string
     */
    protected $description = 'Import prompts from awesome-chatgpt-prompts.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $prompts = $this
            ->fetchPrompts()
            ->mapWithKeys(
                function ($prompt) {
                    $prompt['id'] = Str::slug($prompt['act']);
                    $prompt['prompt'] = preg_replace(
                        [
                            '/\s*My first request.*$/',
                            '/\s*My first suggestion.*$/',
                        ],
                        '',
                        $prompt['prompt']
                    );

                    return [
                        $prompt['id'] => $prompt,
                    ];
                }
            )
            ->keyBy('id')
            ->sortBy('act')
            ->all();

        File::put(resource_path('prompts.yml'), Yaml::dump($prompts, 2, 2));

        $count = count($prompts);

        $this->info("Imported ${count} prompts");
    }

    protected function fetchPrompts(): Collection
    {
        return Cache::remember(
            'prompts',
            60 * 24 * 24,
            function () {
                $stream = fopen(config('legion.source'), 'r');

                if ($stream === false) {
                    $this->error('There was an error fetching the prompts CSV file.');
                    exit(-1);
                }

                $prompts = collect();
                $headers = [];

                while (($row = fgetcsv($stream, 1000, ",")) !== false) {
                    if (!$headers) {
                        $headers = $row;
                        continue;
                    }

                    $prompts[] = array_combine(
                        $headers,
                        $row
                    );
                }

                fclose($stream);

                return $prompts;
            }
        );
    }
}
