<template>
  <div class="action" @click="OpenModel" :class="customBtnAreaClass">
    <slot name="btn"  />
  </div>
  <div class="model" v-if="modelValue">
    <div class="model-overlay" @click="$emit('update:modelValue', false)"></div>
    <div
      class="
        model-content
        max-w-7xl
        mx-auto
        sm:px-6
        lg:px-8
        z-10
        lg:w-[750px]
        text-right
      "
    >
      <slot />
    </div>
  </div>
</template>
    
<script setup>
import BtnSuccess from "@/Components/Buttons/BtnSuccess.vue";

import { onMounted, onUnmounted, reactive, ref } from "@vue/runtime-core";

const props = defineProps({
  modelValue: {
    required: true,
  },
  customBtnAreaClass:{}
});

const emit = defineEmits(["update:modelValue"]);
const closeOnEscape = (e) => {
  if (props.modelValue && e.key === "Escape") {
    emit("update:modelValue", false);
  }
};

onMounted(() => document.addEventListener("keydown", closeOnEscape));
onUnmounted(() => document.removeEventListener("keydown", closeOnEscape));

function OpenModel() {
  emit("update:modelValue", true);
}
</script>
    
  <style scoped>
.model {
  width: 100%;
  height: 100%;
  min-height: 100vh;
  position: fixed;
  right: 0px;
  z-index: 82;
  display: flex;
  align-items: center;
  justify-content: center;
  align-content: center;
  top: 0;
}

.model-overlay {
  width: 100%;
  height: 100%;
  position: absolute;
  background: #eeeeee26;
  z-index: 1;
}
</style>