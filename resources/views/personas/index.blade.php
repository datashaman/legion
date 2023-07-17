<x-app-layout>
    <x-slot name="header">
        {{ __('List Personas') }}
        <span class="justify-right">
            <a href="{{ route('personas.create') }}" class="btn btn-primary">Create</a>
        </span>
    </x-slot>

    <x-slot name="title">
        {{ __('List Personas') }}
    </x-slot>

    <x-list-personas/>
</x-app-layout>
