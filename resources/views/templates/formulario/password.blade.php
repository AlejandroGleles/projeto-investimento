<label class="{{ $class ?? '' }}">
    <span>{{ $label ?? $input ?? 'ERRO' }}</span>
    <input
        type="password"
        name="{{ $input }}"
        {!! $attributes ? implode(' ', array_map(fn($key, $value) => "{$key}=\"{$value}\"", array_keys($attributes), $attributes)) : '' !!}
    />
</label>
