<weekly-winners inline-template>
    <modal name="weekly-winners" :adaptive="true" height="auto" classes="h-screen bg-white shadow-md rounded border-green border-t-4 rounded-t-none">
        <form class="p-8" @submit.prevent="submit" @keydown="feedback = ''">
            <div class="mb-4">
                <label class="block text-grey-800 text-sm font-bold mb-2" for="week">
                    Week
                </label>
                <div class="relative">
                    <select class="block appearance-none w-full bg-grey-lighter border border-grey-light text-grey-800 py-2 px-2 pr-8 rounded" v-model="selectedWeek">
                        <option :value="week" v-for="week in weeks">@{{ week.week_date }} - @{{ week.year.name }} Week #@{{ week.week_order }}</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-grey-800">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                    </div>
                 </div>
            </div>
            <div class="mb-8">
                <label class="block text-grey-800 text-sm font-bold mb-2" for="players">
                    Players
                </label>
                <multiselect v-model="selectedPlayers" :options-limit="5" :options="options" :multiple="true" :close-on-select="true" :custom-label="customLabel" label="name" placeholder="Search" track-by="user" class="block appearance-none w-full bg-grey-lightest border border-grey-light text-grey-800 py-2 px-2 pr-8 rounded"></multiselect>
            </div>
            <div class="flex items-center justify-between">
                <button class="bg-green hover:bg-green-dark text-white  py-2 px-4 rounded" :class="loading ? 'loader' : ''" :disabled="loading" type="submit">
                    Save Winners
                </button>
                <a class="inline-block align-baseline  text-sm text-grey-dark hover:text-green cursor-pointer" @click="$modal.hide('weekly-winners')">
                        Cancel
                    </a>
            </div>
        </form>
    </modal>
</login>
