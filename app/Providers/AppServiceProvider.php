<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use League\CommonMark\CommonMarkConverter;
use OpenAI;
use OpenAI\Client;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(Client::class, fn ($app) => OpenAI::client(config('services.openai.api_key')));
        $this->app->singleton(CommonMarkConverter::class, fn ($app) => new CommonMarkConverter([
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]));
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
