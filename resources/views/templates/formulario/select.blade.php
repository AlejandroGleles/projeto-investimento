<label class="{{ $class ?? '' }}">

    <span>{{ $label ?? 'ERRO' }}</span>

    @if (isset($input) && $input == 'Cadastrar')
        <button type="submit" {!! $attributes ?? '' !!}>
            {{ $select }}
        </button>
    @else
        <select name="{{ $select }}" {!! $attributes ? implode(' ', array_map(fn($key, $value) => "{$key}=\"{$value}\"", array_keys($attributes), $attributes)) : '' !!}>
            @foreach($data ?? [] as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </select>
    @endif

</label>
