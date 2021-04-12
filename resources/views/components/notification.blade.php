<div
    x-data="{ show: false, message: '' }"
    x-show="show"
    x-on:notify.window="show = true; message = $event.detail; setTimeout(() => { show = false }, 2550)"
    class="fixed bottom-0 right-0 mr-12 flex flex-col items-end justify-center px-4 py-6 pointer-events-none sm:p-6 sm:justify-start space-y-4"
    x-cloak
    style="display:none"
>
        <div class="rounded-lg shadow bg-white overflow-hidden">
            <div class="p-4">
                <div class="flex items-start">
                    <svg class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div class="ml-3 flex-1 pt-0.5">
                        <p x-text="message" class="text-sm leading-5 font-medium text-gray-900"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
