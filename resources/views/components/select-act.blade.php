@props(['acts'])

<select name="act" class="select select-bordered">
    @foreach ($acts as $id => $act)
    <option value="{{ $id }}">{{ $act }}</option>
    @endforeach
</select>
