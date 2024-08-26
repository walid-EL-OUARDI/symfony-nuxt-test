<script setup lang="ts">
import {
  Select,
  SelectContent,
  SelectGroup,
  SelectItem,
  SelectLabel,
  SelectTrigger,
  SelectValue,
} from "@/components/ui/select";
import Button from "./ui/button/Button.vue";

const options = [
  { lable: "Brand, A à Z", sortInfo: ["brand", "ASC"] },
  { lable: "Brand, Z à A", sortInfo: ["brand", "DESC"] },
  { lable: "Model, A à Z", sortInfo: ["model", "ASC"] },
  { lable: "Model, Z à A", sortInfo: ["model", "DESC"] },
  { lable: "Prix, croissant", sortInfo: ["price", "ASC"] },
  { lable: "Prix, décroissant", sortInfo: ["price", "DESC"] },
];
const props = defineProps({
  selectedOption: String,
});
</script>

<template>
  <Select>
    <SelectTrigger class="w-[200px]">
      <SelectValue :placeholder="selectedOption" />
    </SelectTrigger>
    <SelectContent>
      <SelectGroup>
        <div class="flex flex-col">
          <Button
            class="text-sm font-normal p-0"
            variant="ghost"
            v-for="(option, index) in options"
            :value="option.lable"
            @click="$emit('handleSort', option)"
          >
            {{ option.lable }}
          </Button>
        </div>
      </SelectGroup>
    </SelectContent>
  </Select>
</template>
