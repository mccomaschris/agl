@php
	$holes = array(
		'1' => '4',
		'2' => '3',
		'3' => '4',
		'4' => '4',
		'5' => '5',
		'6' => '3',
		'7' => '5',
		'8' => '4',
		'9' => '5',
	);
@endphp

@foreach($holes as $holeNumber => $par)
    @php
        $holeScore = $score->{'hole_' . $holeNumber};
        $difference = $holeScore - $par;

        // Determine Tailwind CSS classes based on golf scoring rules
        $scoreClass = match (true) {
            $difference <= -2 => 'bg-yellow-200 text-yellow-800', // Eagle or better
            $difference == -1 => 'bg-green-200 text-green-800',   // Birdie
            $difference == 0 => 'text-zinc-500',                 // Par
            $difference == 1 => 'bg-red-200 text-red-800',       // Bogey
            $difference >= 2 => 'bg-sky-200 text-sky-800',       // Double bogey or worse
            default => '',
        };

		$spanClass = '';
		// $spanClass = match (true) {
		// 	$difference <= -2 => 'border border-current rounded-full outline outline-offset-2 outline-current px-2', // Eagle or better
        //     $difference == -1 => 'border border-current rounded-full px-2',   // Birdie
        //     $difference == 0 => '',                 // Par
        //     $difference == 1 => 'border border-current px-2',       // Bogey
        //     $difference >= 2 => 'border border-current outline outline-offset-2 outline-current px-2',       // Double bogey or worse
        //     default => '',
        // };
    @endphp

    <td class="text-center px-1 py-4 whitespace-nowrap border-r border-zinc-300 text-base! {{ $holeScore ? $scoreClass : '' }}">
        <span class="h-6 w-6 flex items-center justify-center mx-auto {{ $spanClass }}">{{ $holeScore ? number_format($holeScore, 0, '.', ',') : '' }}</span>
    </td>
@endforeach

<td class="text-center px-1 py-4 text-base! whitespace-nowrap border-r border-zinc-300">
    <strong><span class="">
        {{ $score->gross ? number_format($score->gross, 0, '.', ',') : '' }}
    </span><strong>
</td>
<td class="text-center px-1 py-4 text-base! whitespace-nowrap border-r border-zinc-300">
    <strong><span class="">
        {{ $score->gross_par ? number_format($score->gross_par, 0, '.', ',') : '' }}
    </span><strong>
</td>
<td class="text-center px-1 py-4 text-base! whitespace-nowrap border-r border-zinc-300">
    <strong><span class="">
        {{ $score->net ? number_format($score->net, 0, '.', ',') : '' }}
    </span><strong>
</td>
<td class="text-center px-1 py-4 text-base! whitespace-nowrap border-r border-zinc-300">
    <strong><span class="">
        {{ $score->net_par ? number_format($score->net_par, 0, '.', ',') : '' }}
    </span><strong>
</td>
<td class="text-center px-1 py-4 text-base! whitespace-nowrap font-bold border-r border-zinc-300"><strong>{{ $score->points }}</strong></td>
<td class="text-center px-1 py-4 text-base! whitespace-nowrap font-bold border-r text-yellow-800 border-zinc-300">{{ $score->eagle}}</td>
<td class="text-center px-1 py-4 text-base! whitespace-nowrap font-bold border-r text-green-800 border-zinc-300">{{ $score->birdie}}</td>
<td class="text-center px-1 py-4 text-base! whitespace-nowrap font-bold border-r border-zinc-300">{{ $score->par}}</td>
<td class="text-center px-1 py-4 text-base! whitespace-nowrap font-bold border-r text-red-800 border-zinc-300">{{ $score->bogey}}</td>
<td class="text-center px-1 py-4 text-base! whitespace-nowrap font-bold border-r text-blue-800 border-zinc-300">{{ $score->double_bogey }}</td>
