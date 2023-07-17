@props(['persona', 'actions', 'width'])

@php
$width = $width ?? 40;
@endphp

<div class="card lg:card-side bg-base-100 shadow-xl">
    <figure>
        <a href="{{ route('personas.show', ['persona' => $persona]) }}">
            <img src="{{ $persona->avatar }}" width="256" height="256" class="w-{{ $width }}">
        </a>
    </figure>
    <div class="card-body">
    </a>
        <h2 class="card-title">
            <a href="{{ route('personas.show', ['persona' => $persona])}}">{{ $persona->name }}</a>
        </h2>
        <p class="text-sm">{{ $persona->act }}</p>
        @if (!isset($actions) || $actions !== false)
        <div class="card-actions justify-end">
            <a href="{{ route('personas.edit', ['persona' => $persona]) }}" class="btn btn-xs btn-secondary">Edit</a>
            <a href="{{ route('chats.create', ['persona' => $persona]) }}" class="btn btn-xs btn-primary">Chat</a>
        </div>
        @endif
    </div>
</div>
