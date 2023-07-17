@inject('converter', 'League\CommonMark\CommonMarkConverter')

<x-app-layout>
    <x-slot name="header">
        Chat {{ $chat->persona->name }}
        @if ($chat->topic)
        about {{ $chat->topic }}
        @endif
    </x-slot>

    <div x-data="messages">
        <div class="pb-28">
        @foreach ($chat->messages as $message)
            @continue($message->role->value === 'system')
            @switch($message->role->value)
                @case('user')
                    <div class="chat chat-end">
                        <div class="chat-header">
                            {{ __('Me') }}
                            <time class="text-xs opacity-50">{{ $message->created_at->diffForHumans() }}</time>
                        </div>
                        <div class="chat-bubble chat-bubble-primary">{!! $converter->convert($message->content) !!}</div>
                    </div>
                    @break
                @case('assistant')
                    <div class="chat chat-start">
                        <div class="chat-image avatar">
                            <div class="w-10 rounded-full">
                              <img src="{{ $persona->avatar }}"/>
                            </div>
                        </div>
                        <div class="chat-header">
                            {{ $persona->name }}
                            <time class="text-xs opacity-50">{{ $message->created_at->diffForHumans() }}</time>
                        </div>
                        <div class="chat-bubble chat-bubble-accent">{!! $converter->convert($message->content) !!}</div>
                    </div>
                    @break
            @endswitch
        @endforeach
        </div>

        <div class="fixed ml-12 bottom-4">
                <textarea name="message" class="textarea textarea-bordered" cols="120" rows=2 x-model="message"></textarea>
                <button type="submit" class="btn btn-sm btn-primary align-top ml-2" :disabled="loading" @click.prevent="postMessage">Send</button>
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
                    this.loading = false
                    window.location.reload()
                })
                .catch((err) => {
                    console.error(err)
                    this.loading = false
                })
        },
    }))
    window.scrollTo(0, document.body.scrollHeight)
})
</script>

<style>
.message-user {
    color: white;
    background-color: blue;
    text-justify: right;
}
</style>
