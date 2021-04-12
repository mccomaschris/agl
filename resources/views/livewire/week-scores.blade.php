<div>
    <h1 class="text-center lg:text-left text-2xl lg:text-3xl mt-6 mb-4 tracking-tight"></h1>
    <div class="flex flex-col lg:flex-row lg:justify-between mt-12 mb-6 items-center">
        <h1 class="text-center lg:text-left text-2xl lg:text-3xl tracking-tight leading-none mb-4 lg:mb-0">Week {{ $week->week_order }} - {{ date('F d, Y', strtotime($week->week_date)) }}  Results</h1>
        <div class="relative">
            <select wire:model="week">
                @foreach ($weeks as $item)
                    <option value="/scores/week/{{ $item->id }}">Week {{ $item->week_order }} - {{ date('F d, Y', strtotime($item->week_date)) }} Results</option>
                @endforeach
            </select>
        </div>
    </div>
    {{ $week }}
</div>
