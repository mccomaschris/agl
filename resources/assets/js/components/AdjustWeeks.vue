<template>
    <div class="bg-white rounded shadow overflow-hidden max-w-lg">
		<div class="m-8 flex flex-wrap">
			<div class="w-full lg:w-1/2">
				<div class="relative">
					<select v-model="selected_week">
						<option v-for="week in weeks" :key="week.id" :value="week.id">Week {{ week.week_order }} - {{ week.week_date }}</option>
					</select>
					<div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-grey-700">
							<svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
					</div>
				</div>
			</div>
		</div>
		<div class="px-8 py-4 bg-grey-100 border-t border-grey-200 flex items-center">
			<button type="submit" class="btn btn-green" @click="post">
					Push Weeks Back
			</button>
		</div>
	</div>
</template>

<script>
    export default {
        props: ['weeks', 'last_week'],

        data() {
            return {
                loading: false,
                selected_week: this.last_week.id
            }
        },

        methods: {
            post() {
                this.loading = true;

                axios
                    .patch('/admin/adjust-weeks/' + this.selected_week)
                    .then(({data: {message}}) => {
                        this.loading = false;
                        flash(message);
                    })
                    .catch(error => {
                        this.feedback = "The was a dang error.";
                        this.loading = false;
                    });
            }
        }
    }
</script>
