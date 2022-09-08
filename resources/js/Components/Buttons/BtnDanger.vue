<template>
  <component
    :is="element"
    :type="type"
    :href="to"
    class="btn"
    :class="customClass"
  >
    <slot />
  </component>
</template>
  <script setup>
const props = defineProps({
  element: {
    required: false,
    default: "div",
  },
  type: {
    type: String,
    required: false,
  },
  to: {
    type: String,
    required: false,
  },
  customClass: {
    type: String,
    required: false,
  },
});
</script>
  <style scoped>
.btn {
  @apply text-white bg-[#f1416c] hover:bg-[#d9214e] focus:bg-[#d9214e];
}
</style>