<x-app-layout>
    <x-slot name="title">
        {{ __('Start Chat') }}
    </x-slot>

    <x-create-chat :persona="$persona"/>
    <x-list-chats :persona="$persona"/>
</x-app-layout>
