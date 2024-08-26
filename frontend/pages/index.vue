<template>
  <div class="m-2 grid sm:grid-cols-8 grid-cols-1 gap-x-4">
    <HambergerIcon
      class="sm:hidden cursor-pointer"
      @open="open"
    />
    <div
      class="sidebar transition sm:transition-none ease-in-out duration-500 sm:col-span-3 lg:col-span-2 top-0 bottom-0 w-[300px] -translate-x-full sm:translate-x-0 sm:w-auto bg-white fixed sm:relative p-2 z-10"
    >
      <h1 class="text-2xl font-extrabold text-slate-600">
        FILTRER MA RECHERCHE
      </h1>

      <CrossLinesIcon
        class="cursor-pointer sm:hidden block absolute top-0 right-0"
        @open="open"
      />
      <BrandFilter @handleBrand="handleBrand" />
      <EnergyFilter @handleEnergy="handleEnergy" />
      <ModelFilter @handleModel="handleModel" />

      <PriceRange
        class="mt-10"
        @handlePrice="handlePrice"
        @setPrice="setPrice"
        :maxPrice="maxPrice"
        :minPrice="minPrice"
      />
    </div>
    <div class="col-span-5 lg:col-span-6">
      <div class="flex items-center justify-between sm:flex-row flex-col">
        <SearchResults :results="carsData ? carsData.totalItems : 0" />
        <div class="flex items-center">
          <h1 class="mr-4 font-bold text-slate-700">Trier par</h1>
          <SortResultsBy
            @handleSort="handleSort"
            :selectedOption="selectedOption"
          />
        </div>
      </div>
      <div v-if="status === 'pending'">loading ...</div>
      <div v-else-if="status === 'error'">error</div>
      <div
        v-else
        class="grid sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 grid-cols-1 gap-5 mt-6"
      >
        <div
          v-for="(car, index) in carsData?.vehicles.length + 1"
          :key="index"
          class="w-100 h-100"
        >
          <img
            v-if="index === 5"
            src="https://user-images.githubusercontent.com/34513693/160633732-4b9dbc32-656b-473d-86a5-4f0b26bae908.png"
            alt="ad-image"
            class="border border-slate-300 bg-blue-100 rounded-lg h-full"
          />
          <CarInfo
            v-else
            class="border border-slate-300 bg-blue-100 rounded-lg"
            :carData="carsData.vehicles[index > 5 ? index - 1 : index]"
          />
        </div>
      </div>
      <Pagination
        v-if="carsData"
        @handlePage="handlePage"
        @nextPage="nextPage"
        @prevPage="prevPage"
        :totalPages="carsData.totalPages"
        :currentPage="carsData.currentPage"
        class="flex justify-center mt-4"
      />
    </div>
  </div>
</template>

<script setup>
import CrossLinesIcon from "~/components/svgs/CrossLinesIcon.vue";
import HambergerIcon from "~/components/svgs/HambergerIcon.vue";
const config = useRuntimeConfig();
const minPrice = ref();
const maxPrice = ref();

const selectedOption = ref("Selectioné une option");
const state = ref({
  page: 1,
  brand: "",
  model: "",
  energy: "",
  order: "",
  sort: "",
  minPrice: 0,
  maxPrice: 0,
});

const open = () => {
  document.querySelector(".sidebar").classList.toggle("-translate-x-full");
};

const handlePage = (pageNumber) => {
  state.value.page = pageNumber;
};
const nextPage = () => {
  state.value.page = state.value.page + 1;
};
const prevPage = () => {
  state.value.page = state.value.page - 1;
};
const handleSort = (option) => {
  console.log(option);
  state.value.sort = option.sortInfo[0];
  state.value.order = option.sortInfo[1];
  selectedOption.value = option.lable;
};
const handleBrand = (option) => {
  state.value.brand = option !== "Toutes" ? option : "";
};
const handleEnergy = (option) => {
  state.value.energy = option !== "Toutes" ? option : "";
};
const handleModel = (option) => {
  state.value.model = option !== "Toutes" ? option : "";
};

const setPrice = (minOrMax, event) => {
  if (minOrMax === "minPrice") {
    minPrice.value = event.target.value;
  } else {
    maxPrice.value = event.target.value;
  }
};
const handlePrice = () => {
  state.value.minPrice = minPrice.value;
  state.value.maxPrice = maxPrice.value;
};

const { status, data: carsData } = await useLazyAsyncData("cars", () =>
  $fetch(`api/getVehicles`, {
    baseURL: config.public.apiBase,
    query: {
      page: state.value.page,
      sort: state.value.sort,
      order: state.value.order,
      brand: state.value.brand,
      energy: state.value.energy,
      model: state.value.model,
      minPrice: state.value.minPrice,
      maxPrice: state.value.maxPrice,
    },
  })
);

watch(state.value, async () => {
  await refreshNuxtData("cars");
  console.log(state.value);
});
</script>
