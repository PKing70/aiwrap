<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\OpenAiWrap;

class OpenAIServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        $this->app->bind('openai', function ($app) {
            $apiKey = config('services.openai.key');
            return new OpenAiWrap($apiKey);
        });
    }


    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
