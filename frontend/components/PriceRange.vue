<template>
  <div>
    <div class="flex flex-row">
      <div class="flex flex-col">
        <input
          class="-mx-2 rotate-180"
          id="min-price"
          type="range"
          min="0"
          max="100000"
          value="60000"
          step="1000"
          @mouseup="$emit('handlePrice', 'minPrice')"
          @input="$emit('setPrice', 'minPrice', $event)"
        />
        <h1>
          Min = {{ minPrice }}€
        </h1>
      </div>
      <div class="flex flex-col">
        <input
          id="max-price"
          class=""
          type="range"
          min="0"
          max="100000"
          value="50000"
          step="1000"
          @mouseup="$emit('handlePrice', 'maxPrice')"
          @input="$emit('setPrice', 'maxPrice', $event)"
        />
        <h1 class="flex justify-end">Max = {{ maxPrice }} €</h1>
      </div>
    </div>
  </div>
</template>

<script setup>
const props = defineProps({
  maxPrice: Number,
  minPrice: Number,
});
</script>
