@extends('layouts.admin')

@section('content')
<div class="container mx-auto">
	<table class="table table-striped">
        <thead>
            <tr class="">
                <th class="text-center rounded-tl">Hole</th>
                <th class="text-center">Average</th>
                <th class="text-center">Par</th>
                <th class="text-center rounded-tr">Diff</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>Hole 1</td>
                <td class="text-center">{{ $one }}</td>
                <td class="text-center">4</td>
                <td class="text-center">{{ $one - 4 }}</td>
            </tr>
            <tr>
                <td>Hole 2</td>
                <td class="text-center">{{ $two }}</td>
                <td class="text-center">3</td>
                <td class="text-center">{{ $two - 3 }}</td>
            </tr>
            <tr>
                <td>Hole 3</td>
                <td class="text-center">{{ $three }}</td>
                <td class="text-center">4</td>
                <td class="text-center">{{ $three - 4 }}</td>
            </tr>
            <tr>
                <td>Hole 4</td>
                <td class="text-center">{{ $four }}</td>
                <td class="text-center">4</td>
                <td class="text-center">{{ $four - 4 }}</td>
            </tr>
            <tr>
                <td>Hole 5</td>
                <td class="text-center">{{ $five }}</td>
                <td class="text-center">5</td>
                <td class="text-center">{{ $five - 5 }}</td>
            </tr>
            <tr>
                <td>Hole 6</td>
                <td class="text-center">{{ $six }}</td>
                <td class="text-center">3</td>
                <td class="text-center">{{ $six - 3 }}</td>
            </tr>
            <tr>
                <td>Hole 7</td>
                <td class="text-center">{{ $seven }}</td>
                <td class="text-center">5</td>
                <td class="text-center">{{ $seven - 5 }}</td>
            </tr>
            <tr>
                <td>Hole 8</td>
                <td class="text-center">{{ $eight }}</td>
                <td class="text-center">4</td>
                <td class="text-center">{{ $eight - 4 }}</td>
            </tr>
            <tr>
                <td>Hole 9</td>
                <td class="text-center">{{ $nine }}</td>
                <td class="text-center">5</td>
                <td class="text-center">{{ $nine - 5 }}</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
