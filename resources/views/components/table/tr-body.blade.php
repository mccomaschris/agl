@props(['subheading' => false])

<tr {{ $attributes->merge(['class' => $subheading
		? 'bg-green-600 dark:bg-green-500 [&>tr]:border-green-800 [&>tr]:text-green-100'
		: 'even:bg-white odd:bg-zinc-50/50 dark:bg-zinc-800! odd:dark:bg-zinc-700! border-b border-zinc-300 last:border-b-0 [&>tr]:last:border-b-0 [&>tr]:border-zinc-300 [&>tr]:text-zinc-500'
		]) }}>
    {{ $slot }}
</tr>
