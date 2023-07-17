<x-app-layout>
    <x-slot name="header">
        {{ $chat->name }}
        with
        {{ $chat->persona->name }}
    </x-slot>

    <div class="messages h-72 relative" x-data="messages">
        @forelse ($chat->messages as $message)
        @empty
        @endforelse

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
                .post('/chats/{{ $chat->id }}/messages', {
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
