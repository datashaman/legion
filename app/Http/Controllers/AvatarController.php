<?php

namespace App\Http\Controllers;

use App\Actions\GenerateAvatar;
use App\Http\Requests\AvatarRequest;
use Illuminate\Support\Str;
use OpenAI\Client;

class AvatarController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(AvatarRequest $request)
    {
        return app()->call(GenerateAvatar::class, [
            'prompt' => $request->prompt,
        ]);
    }
}
