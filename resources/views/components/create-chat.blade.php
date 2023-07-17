<div class="container mx-auto" x-data="selectAct">
    <div class="grid grid-cols-2 gap-4">
        <x-persona-card :persona="$persona" :actions="false" width="80"/>

        <form method="POST" action="{{ route('chats.store', ['persona' => $persona]) }}">
            @csrf

            <div class="flex gap-4">
                <div class="p-4 bg-white rounded-lg shadow">
                    <div class="form-control w-full max-w-xs">
                        <label for="topic" class="label">Optional Topic</label>
                        <textarea name="topic" class="textarea textarea-bordered">
                            {{ old('topic')}}
                        </textarea>
                        <x-input-error :messages="$errors->get('topic')"/>
                    </div>

                    <button type="submit" class="mt-4 btn btn-primary">
                        Start Chat
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
