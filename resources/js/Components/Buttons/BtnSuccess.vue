<template>
  <component
    :is="element"
    :type="type"
    :href="to"
    class="btn"
    :class="[{ disabledClass: disabledClass }, customClass]"
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
  disabledClass: {},
});
</script>
  <style scoped>
.btn {
  @apply text-white bg-[#50cd89] hover:bg-[#47be7d] focus:bg-[#47be7d];
}
.disabledClass {
  @apply bg-slate-50 text-slate-500 hover:bg-slate-50 focus:bg-slate-50 cursor-default;
}
</style>