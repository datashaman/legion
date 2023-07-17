<x-app-layout>
    <x-slot name="header">
        {{ $chat->name }}
        with
        {{ $chat->persona->name }}
    </x-slot>

    <div class="messages h-72 relative" x-data="messages">
        @foreach ($chat->messages as $message)
            @continue($message->role->value === 'system')
            @switch($message->role->value)
                @case('user')
                    <div class="m-4 text-right">
                        <span class="p-2 text-white bg-blue-700 rounded-lg">{{ $message->content }}</span>
                    </div>
                    @break
                @case('assistant')
                    <div class="m-4 message">{{ $message->content }}</div>
                    @break
            @endswitch
        @endforeach

        <div class="absolute inset-x-0 bottom-0">
            <input type="text" name="message" class="input input-sm input-bordered" x-model="message">
            <button class="btn btn-sm btn-primary ml-2" :disabled="loading" @click.prevent="postMessage">Send</button>
        </div>
    </div>
</x-app-layout>

<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('messages', () => ({
        loading: false,
        message: '',
        postMessage(e) {
            this.loading = true

            axios
                .post('/personas/{{ $persona->slug }}/chats/{{ $chat->id }}/messages', {
                    role: 'user',
                    content: this.message,
                })
                .then((response) => {
                    this.avatar = response.data
                    this.loading = false
                })
                .catch((err) => {
                    console.error(err)
                    this.loading = false
                })
        },
    }))
})
</script>

<style>
.message-user {
    color: white;
    background-color: blue;
    text-justify: right;
}
</style>
