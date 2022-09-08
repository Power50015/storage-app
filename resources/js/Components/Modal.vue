<template>
  <div class="action">
    <btn-success @click="showModel = true">
      <i class="fa-solid fa-pen-to-square"></i>
      <span class="mx-3">تعديل</span>
    </btn-success>
  </div>
  <div class="model" v-if="showModel">
    <div class="model-overlay" @click="showModel = false"></div>
    <div
      class="model-content max-w-7xl mx-auto sm:px-6 lg:px-8 z-10 lg:w-[750px]"
    >
      <slot />
    </div>
  </div>
</template>
  
  <script setup >
import BtnSuccess from "@/Components/Buttons/BtnSuccess.vue";

import { onMounted, onUnmounted, reactive, ref } from "@vue/runtime-core";

const showModel = ref(false);

const closeOnEscape = (e) => {
  if (showModel.value && e.key === "Escape") {
    showModel.value = false;
  }
};

onMounted(() => document.addEventListener("keydown", closeOnEscape));
onUnmounted(() => document.removeEventListener("keydown", closeOnEscape));
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