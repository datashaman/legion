<div class="container mx-auto" x-data="selectAct">
    <form method="POST" action="{{ route('personas.store') }}">
        @csrf

        <div class="flex gap-4">
            <div class="p-4 flex-none bg-white rounded-lg shadow">
                <div class="form-control w-full max-w-xs">
                    <label for="act" class="label">Act as</label>
                    <div class="input-group">
                        <select class="select select-bordered w-full max-w-xs" x-model="previewAct" @change="showPreview">
                            <option selected>Select a prompt</option>
                            @foreach (config('legion.prompts') as $prompt)
                            <option value="{{ $prompt['id'] }}" data-prompt="{{ $prompt['prompt'] }}">{{ $prompt['act'] }}</option>
                            @endforeach
                        </select>
                        <button class="btn btn-secondary" :disabled="previewAct == ''" @click.prevent="pastePreview">Use</button>
                    </div>
                </div>

                <div class="form-control w-full max-w-xs">
                    <label for="preview" class="label">Preview</label>
                    <textarea name="preview" disabled class="textarea textarea-bordered" rows="10" x-model="preview"></textarea>
                </div>
            </div>

            <div class="p-4 grow bg-white rounded-lg shadow">
                <div class="form-control w-full max-w-xs">
                    <label for="act" class="label">Act as</label>
                    <input type="text" name="act" required class="input input-bordered" x-model="act"/>
                    <x-input-error :messages="$errors->get('act')"/>
                </div>

                <div class="form-control w-full max-w-xs">
                    <label for="prompt" class="label">Prompt</label>
                    <textarea name="prompt" class="textarea textarea-bordered w-80" rows="10" x-model="prompt"></textarea>
                    <x-input-error :messages="$errors->get('prompt')"/>
                </div>
            </div>

            <div class="p-4 bg-white rounded-lg shadow">
                <div class="form-control w-full max-w-xs">
                    <label for="name" class="label">Name</label>
                    <input type="text" name="name" required class="input input-bordered" x-model="name"/>
                    <x-input-error :messages="$errors->get('name')"/>
                </div>

                <div class="form-control w-full max-w-xs">
                    <label for="avatar" class="label">Avatar</label>
                    <input type="hidden" name="avatar" x-model="avatar"/>
                    <div class="avatar">
                        <div class="h-full w-full rounded">
                            <img width="256" height="256" :src="avatar"/>
                        </div>
                    </div>
                </div>

                <button type="submit" class="mt-4 btn btn-secondary" :disabled="loading || !(act && prompt && name)" @click.prevent="generateAvatar">
                    <svg x-show="loading" class="animate-spin h-5 w-5 mr-3" viewBox="0 0 24 24">
                    </svg>
                    Generate
                </button>

                <button type="submit" class="mt-4 btn btn-primary">
                    Save
                </button>
            </div>
        </div>
    </form>

    <div x-if="avatarError" class="toast">
        <div class="alert alert-danger">
            <div>
                <span x-model="avatarError"></span>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('alpine:init', () => {
        Alpine.data('selectAct', () => ({
            act: '',
            avatar: 'https://placehold.co/256x256',
            avatarError: '',
            loading: false,
            name: '',
            preview: '',
            previewAct: '',
            prompt: '',
            prompts: @json(config('legion.prompts')),

            generateAvatar(e) {
                this.loading = true

                axios
                    .post('/avatar', {
                        prompt: `avatar named '{this.name}' acting as '{this.act}', digital art`,
                    })
                    .then((response) => {
                        this.avatar = response.data
                        this.loading = false
                    })
                    .catch((err) => {
                        this.avatarError = err
                    })
            },

            showPreview(e) {
                this.preview = this.prompts[this.previewAct].prompt
            },

            pastePreview(e) {
                this.act = this.prompts[this.previewAct].act;
                this.prompt = this.preview;
            },
        }))
    })
</script>
