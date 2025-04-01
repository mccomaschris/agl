<x-table>
	<x-table.thead>
		<x-table.tr>
			<x-table.th colspan="3">Hole</x-table.th>
			<x-table.th>1</x-table.th>
			<x-table.th>2</x-table.th>
			<x-table.th>3</x-table.th>
			<x-table.th>4</x-table.th>
			<x-table.th>5</x-table.th>
			<x-table.th>6</x-table.th>
			<x-table.th>7</x-table.th>
			<x-table.th>8</x-table.th>
			<x-table.th>9</x-table.th>
			<x-table.th colspan="5"></x-table.th>
			<x-table.th colspan="5"></x-table.th>
		</x-table.tr>
	</x-table.thead>
	<x-table.tbody>
		<x-table.tr-body subheading="true">
			<x-table.td></x-table.td>
			<x-table.td></x-table.td>
			<x-table.td>HC</x-table.td>
			<x-table.td>4</x-table.td>
			<x-table.td>3</x-table.td>
			<x-table.td>4</x-table.td>
			<x-table.td>4</x-table.td>
			<x-table.td>5</x-table.td>
			<x-table.td>3</x-table.td>
			<x-table.td>5</x-table.td>
			<x-table.td>4</x-table.td>
			<x-table.td>5</x-table.td>
			<x-table.td>Gross</x-table.td>
			<x-table.td>Par</x-table.td>
			<x-table.td>Net</x-table.td>
			<x-table.td>Par</x-table.td>
			<x-table.td>Pts</x-table.td>
			<x-table.td class="bg-yellow-200! text-yellow-800!">Eg</x-table.td>
			<x-table.td class="bg-green-200! text-green-800!">Br</x-table.td>
			<x-table.td class="">Par</x-table.td>
			<x-table.td class="bg-red-200! text-red-800!">Bg</x-table.td>
			<x-table.td class="bg-blue-200! text-blue-800!">DblBg+</x-table.td>
		</x-table.tr-body>
		{{ $slot }}
	</x-table.tbody>
</x-table>
