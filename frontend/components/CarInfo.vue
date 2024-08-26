<template>
  <div
    class="group min-h-[330px]"
    v-if="carData"
  >
    <div class="overflow-hidden">
      <img
        :src="
          carData.pics[14] ??
          'https://eveho.fra1.cdn.digitaloceanspaces.com/vehicles/538b28c5aa/dms/base_c413bf427ff0ee4935a2119bf.jpg'
        "
        alt="car imag"
        class="transition ease-in-out duration-500 group-hover:scale-125"
      />
    </div>
    <div class="m-2 overflow-hidden">
      <div class="grid grid-cols-3 gap-2">
        <div class="col-span-2">
          <h1 class="text-blue-500 text-lg font-semibold">
            {{ carData.brand }}
          </h1>
        </div>
        <div class="col-span-1">
          <h1 class="text-gray-800 text-2xl font-bold text-end">
            {{ carData.price }}€
          </h1>
        </div>
      </div>
      <div class="grid grid-cols-3 gap-1">
        <div class="col-span-2">
          <h1 class="text-gray-800 text-xl font-bold">{{ carData.model }}</h1>
        </div>
        <div class="col-span-1">
          <div
            class="text-end"
            v-if="carData.priceRetail"
          >
            <span class="text-gray-400 text-sm line-through mr-2">{{
              carData.priceRetail
            }}</span>
            <span class="bg-yellow-500 text-sm font-bold p-1">-33%</span>
          </div>
        </div>
      </div>
      <div class="grid grid-cols-3 gap-1">
        <div class="col-span-2">
          <p class="text-sm font-semibold my-2">{{ carData.version }}</p>
          <p class="text-sm font-semibold">
            {{ carData.year }} - {{ carData.energy }} - {{ carData.power }}
          </p>
        </div>
        <div class="col-span-1">
          <div
            class="text-end"
            v-if="carData.priceMonthly"
          >
            <p class="text-gray-600 text-sm font-semibold">Ou à partir de</p>
            <h2 class="text-gray-800 font-bold text-xl">
              {{ carData.priceMonthly }}€
            </h2>
            <h2 class="text-gray-600 text-sm font-semibold">/mois</h2>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
const props = defineProps({
  carData: Object,
});
</script>
