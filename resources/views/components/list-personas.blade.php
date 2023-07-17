<div class="grid grid-cols-2 gap-4">
    @foreach (auth()->user()->personas as $persona)
    <x-persona-card :persona="$persona" :width="40"/>
    @endforeach
</div>
