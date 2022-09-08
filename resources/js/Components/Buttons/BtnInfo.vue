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
  @apply text-white bg-[#7239ea] hover:bg-[#5014d0] focus:bg-[#5014d0];
}
</style>