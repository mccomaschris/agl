<template>
    <tr>
        <td class="border-t px-1 py-4 text-sm text-left" v-text="player_name"></td>
        <td class="border-t px-1 py-4 text-center"><input type="checkbox" v-model="absent"></td>
        <td class="border-t px-1 py-4 text-center"><input type="checkbox" v-model="weekly_winner"></td>
        <td class="border-t px-1 py-4 text-center"><input type="checkbox" v-model="substitute_id"></td>
        <td class="border-t px-1 py-4 text-center"><input type="text" class="score-form-input" style="width: 30px;" v-model="hole_1"></td>
        <td class="border-t px-1 py-4 text-center"><input type="text" class="score-form-input" style="width: 30px;" v-model="hole_2"></td>
        <td class="border-t px-1 py-4 text-center"><input type="text" class="score-form-input" style="width: 30px;" v-model="hole_3"></td>
        <td class="border-t px-1 py-4 text-center"><input type="text" class="score-form-input" style="width: 30px;" v-model="hole_4"></td>
        <td class="border-t px-1 py-4 text-center"><input type="text" class="score-form-input" style="width: 30px;" v-model="hole_5"></td>
        <td class="border-t px-1 py-4 text-center"><input type="text" class="score-form-input" style="width: 30px;" v-model="hole_6"></td>
        <td class="border-t px-1 py-4 text-center"><input type="text" class="score-form-input" style="width: 30px;" v-model="hole_7"></td>
        <td class="border-t px-1 py-4 text-center"><input type="text" class="score-form-input" style="width: 30px;" v-model="hole_8"></td>
        <td class="border-t px-1 py-4 text-center"><input type="text" class="score-form-input" style="width: 30px;" v-model="hole_9"></td>
        <td class="border-t px-1 py-4 text-center font-bold" v-text="netScore"></td>
        <td class="border-t px-1 py-4 text-center">
            <div class="relative">
                <select class="block appearance-none w-full bg-grey-100 border border-grey-300 text-grey-600 p-2 rounded" v-model="points" @change="update"  @keydown.tab="update">
                   <option value=""></option>
                   <option value="0">0</option>
                   <option value="1">1</option>
                   <option value="2">2</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-grey-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                </div>
            </div>
        </td>
        <td class="border-t px-1 py-4 text-center">
            <button :class="classes" @click="update">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="fill-current h-6 w-6 text-grey-400 hover:text-green-500"><path d="M0 2C0 .9.9 0 2 0h14l4 4v14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm5 0v6h10V2H5zm6 1h3v4h-3V3z"/></svg>
            </button>
        </td>
    </tr>
</template>

<script>
    export default {
        props: ['data'],

        data() {
            return {
                updating: false,
                player_name: this.data.player.user.last_name,
                hole_1: this.data.hole_1 ? Math.trunc(this.data.hole_1) : '',
                hole_2: this.data.hole_2 ? Math.trunc(this.data.hole_2) : '',
                hole_3: this.data.hole_3 ? Math.trunc(this.data.hole_3) : '',
                hole_4: this.data.hole_4 ? Math.trunc(this.data.hole_4) : '',
                hole_5: this.data.hole_5 ? Math.trunc(this.data.hole_5) : '',
                hole_6: this.data.hole_6 ? Math.trunc(this.data.hole_6) : '',
                hole_7: this.data.hole_7 ? Math.trunc(this.data.hole_7) : '',
                hole_8: this.data.hole_8 ? Math.trunc(this.data.hole_8) : '',
                hole_9: this.data.hole_9 ? Math.trunc(this.data.hole_9) : '',
                points: Math.trunc(this.data.points),
                absent: this.data.absent,
                weekly_winner: this.data.weekly_winner,
                injury: this.data.injury,
                name: this.data.player_name,
                substitute_id: this.data.substitute_id,
            }
        },
        methods: {
            update() {
                this.updating = true;
                axios.patch('/admin/scores/' + this.data.id, {
                    absent: this.absent,
                    weekly_winner: this.weekly_winner,
                    injury: this.injury,
                    substitute_id: this.substitute_id,
                    hole_1: this.hole_1,
                    hole_2: this.hole_2,
                    hole_3: this.hole_3,
                    hole_4: this.hole_4,
                    hole_5: this.hole_5,
                    hole_6: this.hole_6,
                    hole_7: this.hole_7,
                    hole_8: this.hole_8,
                    hole_9: this.hole_9,
                    points: this.points,
                });
                this.updating = false;

                flash(this.pluralName + ' score updated!');

            },
        },

        computed: {
            netScore: function () {
                return +this.hole_1 + +this.hole_2 + +this.hole_3 + +this.hole_4 + +this.hole_5 + +this.hole_6 + +this.hole_7 + +this.hole_8 + +this.hole_9
            },

            classes() {
                return [
                    'button is-small is-primary',
                    this.updating ? 'is-loading' : ''
                ];
            },

            pluralName() {
                return (this.data.player.user.name.toLowerCase().slice(-1) === 's') ? this.data.player.user.name + "'" : this.data.player.user.name + "'s";;
            }
        },
    };
</script>
