<div>
	<div class="flex flex-wrap mb-4">
		<div class="w-full lg:w-1/3 mb-4 lg:pr-4">
		</div>
		<div class="w-full lg:w-1/3">
			<table class="table w-full mx-auto table-striped">
				<thead>
					<tr class="course">
						<th class="text-center rounded-tl" colspan="2">Team 1</th>
						<th class="text-center rounded-tr" colspan="2">Team 6</th>
					</tr>
				</thead>
				<tr>
					<td width="40%">Reed</td>
					<td width="10%" class="text-center">-1</td>
					<td width="40%">Freeman</td>
					<td width="10%" class="text-center">3</td>
				</tr>
				<tr class="border-b border-grey-900">
					<td width="40%">Yablonsky</td>
					<td width="10%" class="text-center">3</td>
					<td width="40%">T Mills</td>
					<td width="10%" class="text-center">3</td>
				</tr>
				<tr>
					<td width="40%">Evans</td>
					<td width="10%" class="text-center">6</td>
					<td width="40%">Chandler</td>
					<td width="10%" class="text-center">8</td>
				</tr>
				<tr>
					<td width="40%">Mi McComas</td>
					<td width="10%" class="text-center">14</td>
					<td width="40%">R Mills</td>
					<td width="10%" class="text-center">10</td>
				</tr>
			</table>
		</div>
		<div class="w-full lg:w-1/3 mb-4 lg:pr-4">

		</div>
	</div>
	<div class="flex flex-wrap lg:-mx-4 mb-4">
	<div class="w-full lg:w-2/3 pr-0 lg:px-4 mb-4 lg:mb-0">
		<h2 class="text-lg mt-2 mb-2 font-semibold">Team Standings</h2>
		@include('_parts.standings-team', ['show_max' => true])
	</div>
	<div class="w-full lg:w-1/3  lg:px-4">
		<h2 class="text-lg mt-2 mb-2 font-semibold">Individual Standings</h2>
		@include('_parts.standings-player', ['take' => 5])
	</div>
	</div>
</div>
