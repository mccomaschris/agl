
<td class="text-center px-1 py-4 text-sm whitespace-nowrap border-r border-zinc-300
    @if ($score->hole_1 >= 1 and $score->hole_1 <=2)
		bg-yellow-200 text-yellow-800
    @elseif ($score->hole_1 == 3)
		bg-green-200 text-green-800
    @elseif ($score->hole_1 == 4)
		text-gray-500
    @elseif ($score->hole_1 == 5)
		bg-red-200 text-red-800
    @elseif ($score->hole_1 >= 6)
		bg-sky-200 text-sky-800
    @endif
    ">
    {{ $score->hole_1 ? number_format($score->hole_1, 0, '.', ',') : '' }}
</td>

<td class="text-center px-1 py-4 text-sm whitespace-nowrap border-r border-zinc-300
    @if ($score->hole_2 == 1)
		bg-yellow-200 text-yellow-800
    @elseif ($score->hole_2 == 2)
		bg-green-200 text-green-800
    @elseif ($score->hole_2 == 3)
		text-gray-500
    @elseif ($score->hole_2 == 4)
		bg-red-200 text-red-800
    @elseif ($score->hole_2 >= 5)
		bg-sky-200 text-sky-800
    @endif
    ">
    {{ $score->hole_2 ? number_format($score->hole_2, 0, '.', ',') : '' }}
</td>

<td class="text-center px-1 py-4 text-sm whitespace-nowrap border-r border-zinc-300
    @if ($score->hole_3 >= 1 and $score->hole_3 <=2)
		bg-yellow-200 text-yellow-800
    @elseif ($score->hole_3 == 3)
		bg-green-200 text-green-800
    @elseif ($score->hole_3 == 4)
		text-gray-500
    @elseif ($score->hole_3 == 5)
		bg-red-200 text-red-800
    @elseif ($score->hole_3 >= 6)
		bg-sky-200 text-sky-800
    @endif
    ">
    {{ $score->hole_3 ? number_format($score->hole_3, 0, '.', ',') : '' }}
</td>

<td class="text-center px-1 py-4 text-sm whitespace-nowrap border-r border-zinc-300
    @if ($score->hole_4 >= 1 and $score->hole_4 <=2)
		bg-yellow-200 text-yellow-800
    @elseif ($score->hole_4 == 3)
		bg-green-200 text-green-800
    @elseif ($score->hole_4 == 4)
		text-gray-500
    @elseif ($score->hole_4 == 5)
		bg-red-200 text-red-800
    @elseif ($score->hole_4 >= 6)
		bg-sky-200 text-sky-800
    @endif
    ">
    {{ $score->hole_4 ? number_format($score->hole_4, 0, '.', ',') : '' }}
</td>

<td class="text-center px-1 py-4 text-sm whitespace-nowrap border-r border-zinc-300
    @if ($score->hole_5 >= 1 and $score->hole_5 <= 3)
		bg-yellow-200 text-yellow-800
    @elseif ($score->hole_5 == 4)
		bg-green-200 text-green-800
    @elseif ($score->hole_5 == 5)
		text-gray-500
    @elseif ($score->hole_5 == 6)
		bg-red-200 text-red-800
    @elseif ($score->hole_5 >= 7)
		bg-sky-200 text-sky-800
    @endif
    ">
    {{ $score->hole_5 ? number_format($score->hole_5, 0, '.', ',') : '' }}
</td>

<td class="text-center px-1 py-4 text-sm whitespace-nowrap border-r border-zinc-300
    @if ($score->hole_6 == 1)
		bg-yellow-200 text-yellow-800
    @elseif ($score->hole_6 == 2)
		bg-green-200 text-green-800
    @elseif ($score->hole_6 == 3)
		text-gray-500
    @elseif ($score->hole_6 == 4)
		bg-red-200 text-red-800
    @elseif ($score->hole_6 >= 5)
		bg-sky-200 text-sky-800
    @endif
    ">
    {{ $score->hole_6 ? number_format($score->hole_6, 0, '.', ',') : '' }}
</td>

<td class="text-center px-1 py-4 text-sm whitespace-nowrap border-r border-zinc-300
    @if ($score->hole_7 >= 1 and $score->hole_7 <= 3)
		bg-yellow-200 text-yellow-800
    @elseif ($score->hole_7 == 4)
		bg-green-200 text-green-800
    @elseif ($score->hole_7 == 5)
		text-gray-500
    @elseif ($score->hole_7 == 6)
		bg-red-200 text-red-800
    @elseif ($score->hole_7 >= 7)
		bg-sky-200 text-sky-800
    @endif
    ">
    {{ $score->hole_7 ? number_format($score->hole_7, 0, '.', ',') : '' }}
</td>

<td class="text-center px-1 py-4 text-sm whitespace-nowrap border-r border-zinc-300
    @if ($score->hole_8 >= 1 and $score->hole_8 <=2)
		bg-yellow-200 text-yellow-800
    @elseif ($score->hole_8 == 3)
		bg-green-200 text-green-800
    @elseif ($score->hole_8 == 4)
		text-gray-500
    @elseif ($score->hole_8 == 5)
		bg-red-200 text-red-800
    @elseif ($score->hole_8 >= 6)
		bg-sky-200 text-sky-800
    @endif
    ">
    {{ $score->hole_8 ? number_format($score->hole_8, 0, '.', ',') : '' }}
</td>

<td class="text-center px-1 py-4 text-sm whitespace-nowrap border-r border-zinc-300
    @if ($score->hole_9 >= 1 and $score->hole_9 <= 3)
		bg-yellow-200 text-yellow-800
    @elseif ($score->hole_9 == 4)
		bg-green-200 text-green-800
    @elseif ($score->hole_9 == 5)
		text-gray-500
    @elseif ($score->hole_9 == 6)
		bg-red-200 text-red-800
    @elseif ($score->hole_9 >= 7)
		bg-sky-200 text-sky-800
    @endif
    ">
    {{ $score->hole_9 ? number_format($score->hole_9, 0, '.', ',') : '' }}
</td>

<td class="text-center px-1 py-4 text-sm whitespace-nowrap border-r border-zinc-300">
    <strong><span class="">
        {{ $score->gross ? number_format($score->gross, 0, '.', ',') : '' }}
    </span><strong>
</td>
<td class="text-center px-1 py-4 text-sm whitespace-nowrap border-r border-zinc-300">
    <strong><span class="">
        {{ $score->gross_par ? number_format($score->gross_par, 0, '.', ',') : '' }}
    </span><strong>
</td>
<td class="text-center px-1 py-4 text-sm whitespace-nowrap border-r border-zinc-300">
    <strong><span class="">
        {{ $score->net ? number_format($score->net, 0, '.', ',') : '' }}
    </span><strong>
</td>
<td class="text-center px-1 py-4 text-sm whitespace-nowrap border-r border-zinc-300">
    <strong><span class="">
        {{ $score->net_par ? number_format($score->net_par, 0, '.', ',') : '' }}
    </span><strong>
</td>
<td class="text-center px-1 py-4 text-sm whitespace-nowrap border-r border-zinc-300"><strong>{{ $score->points }}</strong></td>
<td class="text-center px-1 py-4 text-sm whitespace-nowrap border-r text-yellow-800 border-zinc-300">{{ $score->eagle}}</td>
<td class="text-center px-1 py-4 text-sm whitespace-nowrap border-r text-green-800 border-zinc-300">{{ $score->birdie}}</td>
<td class="text-center px-1 py-4 text-sm whitespace-nowrap border-r border-zinc-300">{{ $score->par}}</td>
<td class="text-center px-1 py-4 text-sm whitespace-nowrap border-r text-red-800 border-zinc-300">{{ $score->bogey}}</td>
<td class="text-center px-1 py-4 text-sm whitespace-nowrap border-r text-blue-800 border-zinc-300">{{ $score->double_bogey }}</td>
