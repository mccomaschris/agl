<template>
  <Card class="flex flex-col items-center justify-center">
    <div class="w-full px-3 py-3">
      <h1 class="text-center text-2xl text-gray-500 font-light">Total Holes</h1>
    </div>
	<div class="text-center text-4xl text-green-600 font-bold" v-text="card.totalScores"></div>
	<div class="w-full flex items-center justify-between mt-8 px-6">
		<div class="flex flex-col justify-center px-3 py-3">
			<span class="text-center text-xl text-gray-500 font-light">Hole 1</span>
			<span class="text-center text-3xl text-green-600 font-bold" v-text="parseFloat(card.hole_1).toFixed(2)"></span>
			<span class="text-center text-xl text-gray-500 font-light mt-3">To Par</span>
			<span class="text-center text-3xl text-red-500 font-bold" v-text="parseFloat(parseFloat(card.hole_1).toFixed(2) - 4).toFixed(3)"></span>
		</div>
		<div class="flex flex-col justify-center px-3 py-3">
			<span class="text-center text-xl text-gray-500 font-light">Hole 2</span>
			<span class="text-center text-3xl text-green-600 font-bold" v-text="parseFloat(card.hole_2).toFixed(2)"></span>
			<span class="text-center text-xl text-gray-500 font-light mt-3">To Par</span>
			<span class="text-center text-3xl text-red-500 font-bold" v-text="parseFloat(parseFloat(card.hole_2).toFixed(2) - 3).toFixed(3)"></span>
		</div>
		<div class="flex flex-col justify-center px-3 py-3">
			<span class="text-center text-xl text-gray-500 font-light">Hole 3</span>
			<span class="text-center text-3xl text-green-600 font-bold" v-text="parseFloat(card.hole_3).toFixed(2)"></span>
			<span class="text-center text-xl text-gray-500 font-light mt-3">To Par</span>
			<span class="text-center text-3xl text-red-500 font-bold" v-text="parseFloat(parseFloat(card.hole_3).toFixed(2) - 4).toFixed(3)"></span>
		</div>
		<div class="flex flex-col justify-center px-3 py-3">
			<span class="text-center text-xl text-gray-500 font-light">Hole 4</span>
			<span class="text-center text-3xl text-green-600 font-bold" v-text="parseFloat(card.hole_4).toFixed(2)"></span>
			<span class="text-center text-xl text-gray-500 font-light mt-3">To Par</span>
			<span class="text-center text-3xl text-red-500 font-bold" v-text="parseFloat(parseFloat(card.hole_4).toFixed(2) - 4).toFixed(3)"></span>
		</div>
		<div class="flex flex-col justify-center px-3 py-3">
			<span class="text-center text-xl text-gray-500 font-light">Hole 5</span>
			<span class="text-center text-3xl text-green-600 font-bold" v-text="parseFloat(card.hole_5).toFixed(2)"></span>
			<span class="text-center text-xl text-gray-500 font-light mt-3">To Par</span>
			<span class="text-center text-3xl text-red-500 font-bold" v-text="parseFloat(parseFloat(card.hole_5).toFixed(2) - 5).toFixed(3)"></span>
		</div>
		<div class="flex flex-col justify-center px-3 py-3">
			<span class="text-center text-xl text-gray-500 font-light">Hole 6</span>
			<span class="text-center text-3xl text-green-600 font-bold" v-text="parseFloat(card.hole_6).toFixed(2)"></span>
			<span class="text-center text-xl text-gray-500 font-light mt-3">To Par</span>
			<span class="text-center text-3xl text-red-500 font-bold" v-text="parseFloat(parseFloat(card.hole_6).toFixed(2) - 3).toFixed(3)"></span>
		</div>
		<div class="flex flex-col justify-center px-3 py-3">
			<span class="text-center text-xl text-gray-500 font-light">Hole 7</span>
			<span class="text-center text-3xl text-green-600 font-bold" v-text="parseFloat(card.hole_7).toFixed(2)"></span>
			<span class="text-center text-xl text-gray-500 font-light mt-3">To Par</span>
			<span class="text-center text-3xl text-red-500 font-bold" v-text="parseFloat(parseFloat(card.hole_7).toFixed(2) - 5).toFixed(3)"></span>
		</div>
		<div class="flex flex-col justify-center px-3 py-3">
			<span class="text-center text-xl text-gray-500 font-light">Hole 8</span>
			<span class="text-center text-3xl text-green-600 font-bold" v-text="parseFloat(card.hole_8).toFixed(2)"></span>
			<span class="text-center text-xl text-gray-500 font-light mt-3">To Par</span>
			<span class="text-center text-3xl text-red-500 font-bold" v-text="parseFloat(parseFloat(card.hole_8).toFixed(2) - 4).toFixed(3)"></span>
		</div>
		<div class="flex flex-col justify-center px-3 py-3">
			<span class="text-center text-xl text-gray-500 font-light">Hole 9</span>
			<span class="text-center text-3xl text-green-600 font-bold" v-text="parseFloat(card.hole_9).toFixed(2)"></span>
			<span class="text-center text-xl text-gray-500 font-light mt-3">To Par</span>
			<span class="text-center text-3xl text-red-500 font-bold" v-text="parseFloat(parseFloat(card.hole_9).toFixed(2) - 5).toFixed(3)"></span>
		</div>
	</div>
  </Card>
</template>

<script>
export default {
  props: [
    'card',

    // The following props are only available on resource detail cards...
    // 'resource',
    // 'resourceId',
    // 'resourceName',
  ],

  decimal(value) {
	return parseInt(value.toFixed(2));
  },

  mounted() {
        console.log(this.card.totalScores)
  },
}
</script>
