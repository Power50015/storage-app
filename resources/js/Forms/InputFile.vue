<template>
  <div class="mb-5">
    <FromLabel :title="title" :require="require" :error="error" />
    <input
      class="
        block
        w-full
        text-sm text-gray-900
        rounded-lg
        border border-gray-300
        dark:text-gray-400
        focus:outline-none
        dark:bg-[#1b1b29]
        bg-[#f5f8fa]
        dark:border-gray-600 dark:placeholder-gray-400
        cursor-pointer
      "
      type="file"
      @change="$emit('update:modelValue', $event.target.files[0])"
    />
  </div>
</template>
  <script setup>
import FromLabel from "@/Forms/FromLabel.vue";
defineProps({
  modelValue: {},
  title: { type: String, default: "" },
  error: { type: String, default: "" },
  require: { type: Boolean, default: false },
});
defineEmits(["update:modelValue"]);
</script>
  