<?php

namespace App\Observers;

use App\Models\Persona;
use Illuminate\Support\Str;

class PersonaObserver
{
    public function saving(Persona $persona): void
    {
        if ($persona->isDirty('name')) {
            $persona->slug = Str::slug($persona->name);
        }
    }

    public function updated(Persona $persona): void
    {
        //
    }

    public function deleted(Persona $persona): void
    {
        //
    }

    public function restored(Persona $persona): void
    {
        //
    }

    public function forceDeleted(Persona $persona): void
    {
        //
    }
}
