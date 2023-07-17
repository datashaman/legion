<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePersonaRequest;
use App\Http\Requests\UpdatePersonaRequest;
use App\Models\Persona;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('personas.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('personas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePersonaRequest $request)
    {
        $validated = $request->validated();

        $avatar = Arr::pull($validated, 'avatar');

        $persona = new Persona($validated);

        $persona->user_id = auth()->user()->id;
        $persona->storeAvatar($avatar);

        if ($persona->save()) {
            return redirect()->route('personas.index')->withInfo('Persona created');
        }

        return redirect()->back()->withError('Persona not created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Persona $persona)
    {
        return view('personas.show', [
            'persona' => $persona,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Persona $persona)
    {
        return view('personas.edit', [
            'persona' => $persona,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePersonaRequest $request, Persona $persona)
    {
        $validated = $request->validated();

        $avatar = Arr::pull($validated, 'avatar');
        $persona->storeAvatar($avatar);

        if ($persona->update($validated)) {
            return redirect()->route('personas.index')->withInfo('Persona updated');
        }

        return redirect()->back()->withError('Persona not updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Persona $persona)
    {
        return $persona->delete();
    }

}
