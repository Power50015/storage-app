<template>
  <label class="px-3 dark:text-gray-300">
    {{ title }}
    <span class="text-red-800 font-bold" v-if="require">*</span>
  </label>
  <div v-if="error" class="text-red-800">
    {{ error }}
  </div>
</template>
<script setup>
defineProps({
  title: { type: String, default: "" },
  error: { type: String, default: "" },
  require: { type: Boolean, default: false },
});
</script>
  