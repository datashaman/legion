<div class="grid grid-cols-2 gap-4">
    @forelse (auth()->user()->personas as $persona)
    <x-persona-card :persona="$persona" :width="40"/>
    @empty
    <p>No personas created. <a href="{{ route('personas.create') }}">Create one</a>.</p>
    @endforelse
</div>
