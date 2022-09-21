<template>
  <div class="mb-5">
    <FromLabel :title="title" :require="require" :error="error" />
    <input
      type="number"
      :value="modelValue"
      @input="$emit('update:modelValue', $event.target.value)"
      :min="min"
      :max="max"
      :step="step"
      class="
        w-full
        mt-3
        text-base
        dark:bg-[#1b1b29]
        bg-[#f5f8fa]
        dark:active:bg-[#1b1b29]
        active:bg-[#f5f8fa]
        dark:focus:bg-[#1b1b29]
        focus:bg-[#f5f8fa] focus:ring-0
        border-0
        shadow-sm
        rounded-md
        py-2
      "
    />
  </div>
</template>
  <script setup>
import FromLabel from "@/Forms/FromLabel.vue";
defineProps({
  modelValue: { type: Number, default: "" },
  title: { type: String, default: "" },
  error: { type: String, default: "" },
  require: { type: Boolean, default: false },
  min: { type: Number, default: 0 },
  step: { default: 0.01 },
  max: { type: Number },
});
defineEmits(["update:modelValue"]);
</script>
  