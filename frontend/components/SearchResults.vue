<template>
  <div class="text-lg">
    <span class="font-bold text-slate-700">{{ results }}</span>
    <span class="font-bold text-slate-700"> résultats </span>
    <span class="text-slate-600">correspondent à votre recherche</span>
  </div>
</template>

<script setup>
const props = defineProps({
  results: Number,
});
</script>
