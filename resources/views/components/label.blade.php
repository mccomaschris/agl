@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-grey-700']) }}>
    {{ $value ?? $slot }}
</label>
