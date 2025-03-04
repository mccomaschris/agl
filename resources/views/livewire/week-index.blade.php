<div class="px-4 sm:px-6 lg:px-8">
	<div class="sm:flex sm:items-center">
		<div class="sm:flex-auto">
			<h1 class="text-base font-semibold leading-6 text-grey-900">Weeks</h1>
		</div>
		<div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
			<div class="flex items-center gap-4">
				{{-- <label for="year" class=" text-sm font-medium leading-6 text-grey-900">Filter Years</label> --}}
				<select wire:model.live="yearFilter" id="year" name="year" class=" w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-grey-900 ring-1 ring-inset ring-grey-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
				  <option>Filter By Year</option>
				  @foreach($years as $year)
				  	<option value="{{ $year->id }}">{{ $year->name }}</option>
				  @endforeach
				</select>
			  </div>
			</div>
		<div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
			<button type="button" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add Week</button>
		</div>
	</div>
	<div class="mt-8 flow-root">
		<div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
			<div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
				<table class="min-w-full divide-y divide-grey-300">
					<thead>
						<tr>
							<th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-grey-900 sm:pl-0">Week Number</th>
							<th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-grey-900">Week Date</th>
							<th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-grey-900">Year</th>
							<th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-grey-900">Game</th>
							<th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
								<span class="sr-only">Edit</span>
							</th>
						</tr>
					</thead>
					<tbody class="divide-y divide-grey-200">
						@foreach($weeks as $week)
							<tr>
								<td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-grey-900 sm:pl-0">{{ $week->week_order }}</td>
								<td class="whitespace-nowrap px-3 py-4 text-sm text-grey-500">{{ Carbon\Carbon::create($week->week_date)->format('M j, Y') }}</td>
								<td class="whitespace-nowrap px-3 py-4 text-sm text-grey-500">{{ $week->year->name }}</td>
								<td class="whitespace-nowrap px-3 py-4 text-sm text-grey-500">{{ $week->side_games}}</td>
								<td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
									<a href="#" class="text-indigo-600 hover:text-indigo-900">Edit<span class="sr-only"></span></a>
								</td>
							</tr>
						@endforeach

						<!-- More people... -->
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
