<script setup lang="ts">
import {
  Accordion,
  AccordionContent,
  AccordionItem,
  AccordionTrigger,
} from "@/components/ui/accordion";

import { RadioGroup, RadioGroupItem } from "@/components/ui/radio-group";
import Label from "./ui/label/Label.vue";

const defaultValue = "filter-2";

const accordionItems = ["Toutes","Diesel", "Essence", "Hybride"];
</script>

<template>
  <Accordion
    type="single"
    class="w-full"
    collapsible
    :default-value="defaultValue"
  >
    <AccordionItem value="item.value">
      <AccordionTrigger>Filtrer Par Energy</AccordionTrigger>
      <AccordionContent>
        <RadioGroup default-value="Toutes">
          <div
            class="flex items-center space-x-2"
            v-for="(item, index) in accordionItems"
            :key="index"
          >
            <RadioGroupItem
              id="r1"
              :value="item"
              @click="$emit('handleEnergy', item)"
            />
            <Label for="r1">{{ item }}</Label>
          </div>
        </RadioGroup>
      </AccordionContent>
    </AccordionItem>
  </Accordion>
</template>
