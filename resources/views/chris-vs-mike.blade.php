<x-main>
	<div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
		<h2 class="font-semibold text-xl text-gray-800 leading-tight">
			Chris vs Mike, Battle for Birdies
		</h2>

		<div class="grid grid-cols-1 md:grid-cols-2 gap-8 my-12">
			<div class="flex flex-col gap-4 items-center justify-center">
				<div class="text-green-500 font-bold text-6xl">{{ $chris->birdie }}</div>
				<div class="text-lg text-gray-600 uppercase">Chris' Birdie Count</div>
			</div>

			<div class="flex flex-col gap-4 items-center justify-center">
				<div class="text-red-500 font-bold text-6xl">{{ $mike->birdie }}</div>
				<div class="text-lg text-gray-600 uppercase">Mike's Birdie Count</div>
			</div>
		</div>
        </div>
</x-main>
