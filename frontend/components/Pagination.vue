<script setup lang="ts">
import {
  Pagination,
  PaginationEllipsis,
  PaginationFirst,
  PaginationLast,
  PaginationList,
  PaginationListItem,
  PaginationNext,
  PaginationPrev,
} from "@/components/ui/pagination";

import { Button } from "@/components/ui/button";
const props = defineProps({
  totalPages: Number,
  currentPage: Number,
});
</script>

<template>
  <Pagination v-slot="{ page }" :total="100" :sibling-count="1" show-edges :default-page="2"
  >
    <PaginationList class="flex items-center gap-1">
      <!-- <PaginationFirst /> -->
      <PaginationPrev
        @click="$emit('prevPage')"
        :class="{ collapse: 1 === currentPage }"
      />

      <Button
        @click="$emit('handlePage', index + 1)"
        v-for="(_, index) in totalPages"
        class="w-10 h-10 p-0"
        :variant="index + 1 === currentPage ? 'default' : 'outline'"
      >
        {{ index + 1 }}
      </Button>

      <PaginationNext
        @click="$emit('nextPage')"
        :class="{ collapse: totalPages === currentPage }"
      />
      <!-- <PaginationLast /> -->
    </PaginationList>
  </Pagination>
</template>
