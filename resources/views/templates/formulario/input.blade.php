<label class="{{ $class ?? '' }}">
    <span>{{ $label ?? $input ?? 'ERRO' }}</span>
    @if ($input == 'Cadastrar')
        <button type="submit" {!! $attributes ?? '' !!}>
            {{ $input }}
        </button>
    @else
        <input
            type="{{ $type ?? 'text' }}"
            name="{{ $input }}"
            value="{{ $value ?? '' }}"
            {!! $attributes ? implode(' ', array_map(fn($key, $value) => "{$key}=\"{$value}\"", array_keys($attributes), $attributes)) : '' !!}
        />
    @endif
</label>
