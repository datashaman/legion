<x-app-layout>
    <x-slot name="title">
        {{ __('Edit Persona') }}
    </x-slot>

    <x-edit-persona :persona="$persona"/>
</x-app-layout>
