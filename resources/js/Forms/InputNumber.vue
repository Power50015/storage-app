<template>
  <div class="mb-5">
    <FromLabel :title="title" :require="require" :error="error" />
    <input
      type="number"
      v-model="select"
      @input="changeData"
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
import { ref } from "@vue/reactivity";
import { onUnmounted } from "@vue/runtime-core";
const props = defineProps({
  modelValue: { default: "" },
  title: { default: "" },
  error: { default: "" },
  require: { default: false },
  min: { default: 0 },
  step: { default: 0.01 },
  max: {},
});
const select = ref(props.modelValue);
const emit = defineEmits(["update:modelValue", "changeData"]); //changeData
onUnmounted(() => (select.value = props.modelValue));
function changeData() {
  emit("update:modelValue", select.value);
  emit("changeData");
}
</script>
  