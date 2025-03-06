<div class="bg-zinc-100 rounded py-6 px-6 my-6">
    <div class="flex space-x-6 items-center">
        <div><button wire:click="clearCache" class="inline-flex items-center px-4 py-2 text-white bg-green-500 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-green-700 hover:text-white active:bg-zinc-900 focus:outline-none focus:border-zinc-900 focus:ring ring-zinc-300 disabled:opacity-25 transition ease-in-out duration-150">Clear Cache</button></div>
        <div><button wire:click="updateHandicaps" class="inline-flex items-center px-4 py-2 text-white bg-green-500 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-green-700 hover:text-white active:bg-zinc-900 focus:outline-none focus:border-zinc-900 focus:ring ring-zinc-300 disabled:opacity-25 transition ease-in-out duration-150">Recalculate Handicaps</button></div>
        <div>
            <div class="text-xs uppercase font-semibold text-zinc-800">Push Future Weeks Back</div>
            <form wire:submit.prevent="addWeeks" class="mt-1">
                <input wire:model="weeksToAdd" pattern="[0-9]*" type="number" size="3" class="w-24">
                <button class="inline-flex items-center px-4 py-2 text-white bg-green-500 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-green-700 hover:text-white active:bg-zinc-900 focus:outline-none focus:border-zinc-900 focus:ring ring-zinc-300 disabled:opacity-25 transition ease-in-out duration-150">Update</button>
            </form>
        </div>
    </div>
</div>
