<template>
  <div class="flex items-center mt-4">
    <template v-for="item in pagination" :key="item.index">
      <Link
        v-if="item.url && !item.active"
        :href="item.url"
        class="
          px-4
          py-2
          rounded-md
          hover:bg-[#009ef7]
          bg-[#009ef7]
          hover:text-white
          mx-2
        "
        v-html="item.label"
      />
      <span
        v-else
        v-html="item.label"
        class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md mx-2"
      />
    </template>
  </div>
</template>
<script setup>
import { Link } from "@inertiajs/inertia-vue3";

import { computed } from "@vue/runtime-core";

const props = defineProps(["links"]);
const pagination = computed(() => {
  props.links[0].label = "السابق";
  props.links[props.links.length - 1].label = "التالى";
  return props.links;
});
</script>
