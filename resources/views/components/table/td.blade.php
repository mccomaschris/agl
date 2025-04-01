@props([
    'absent' => false,
    'injury' => false,
])

@aware(['subheading' => false])

@php
    $baseClasses = 'text-center px-1 py-4 text-sm whitespace-nowrap border-r last:border-r-0 first:py-4 first:pr-3 first:pl-2 first:sm:pl-2';
    $textColor = $subheading ? 'text-green-100 border-green-700 border-b border-t' : 'text-zinc-500 border-zinc-300';
    $conditionalClasses = $absent || $injury
        ? 'bg-zinc-900 text-white font-bold text-center'
        : 'first:text-left not-first:text-center ' . $textColor;
@endphp

<td
    {{ $attributes->merge(['class' => "$baseClasses $conditionalClasses"]) }}
>
    @if($absent)
        ABSENT
    @elseif($injury)
        INJURY
    @else
        {{ $slot }}
    @endif
</td>
