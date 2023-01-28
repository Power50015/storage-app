<template>
  <div class="mb-5">
    <FromLabel v-if="title" :title="title" :require="require" :error="error" />
    <input
      :type="type"
      :value="modelValue"
      @input="$emit('update:modelValue', $event.target.value)"
      class="
        w-full
        mt-3
        text-base
        dark:bg-[#1b1b29]
        bg-[#f5f8fa]
        dark:active:bg-[#1b1b29]
        active:bg-[#f5f8fa]
        dark:focus:bg-[#1b1b29]
        focus:bg-[#f5f8fa]
        focus:ring-0
        border-0
        shadow-sm
        rounded-md
        py-2
      "
      :placeholder=placeholder
    />
  </div>
</template>
<script setup>
import FromLabel from "@/Forms/FromLabel.vue";
defineProps({
  modelValue: { default: "" },
  title: { type: String, default: "" },
  error: { type: String, default: "" },
  require: {  default: false },
  placeholder:{default: ""},
  type: { type: String, default: "text" },
});
defineEmits(["update:modelValue"]);
</script>
