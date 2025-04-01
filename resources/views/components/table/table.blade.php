<div class="overflow-x-auto">
	<div class="flow-root">
		<div class="">
			<div class="inline-block min-w-full py-2 align-middle">
				<div class="overflow-hidden ring-1 shadow-sm ring-black/5 rounded-lg mx-1">
					<div class="overflow-x-auto">
						<table {{ $attributes->merge(['class' => 'min-w-full divide-y divide-gray-300']) }}>
							{{ $slot }}
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
