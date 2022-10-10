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
  @apply text-white bg-[#009ef7] hover:bg-[#0095e8] focus:bg-[#0095e8];
}
</style>