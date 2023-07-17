<x-app-layout>
    <x-slot name="header">
        {{ $persona->name }}
        <span class="tooltip tooltip-bottom badge badge-primary" data-tip="{{ $persona->prompt }}">{{ __('Prompt') }}</span>
        <p class="text-sm font-light text-gray-700 italic">{{ $persona->act }}</p>
    </x-slot>

    <div class="recent-chats">
        @foreach ($persona->chats as $chat)
            {{ $chat->name }}
        @endforeach
    </div>
</x-app-layout>
