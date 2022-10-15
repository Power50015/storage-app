<template>
  <div class="action">
    <BtnDanger class="p-1" @click="OpenModel"
      ><i class="fa-solid fa-trash"></i
    ></BtnDanger>
  </div>
  <div class="model" v-if="model">
    <div
      class="model-overlay dark:bg-[#eeeeee26] bg-[#928f8f26]"
      @click="model = false"
    ></div>
    <div
      class="
        dark:bg-[#1e1e2d]
        bg-white
        dark:text-white
        text-black
        overflow-hidden
        shadow-xl
        rounded-md
        p-4
        z-40
        max-w-4xl
      "
    >
      <div class="p-3">
        <h2 class="title font-bold mb-5">هل أنت متاكد من حذف {{ title }}</h2>
        <div v-html="data" class="mb-3"></div>
        <slot />
        <div class="flex justify-between w-full mt-3">
          <BtnPrimary @click="model = false" class="mx-2">إلغاء</BtnPrimary>
          <BtnDanger @click="deleteFun" class="mx-2">حذف</BtnDanger>
        </div>
      </div>
    </div>
  </div>
</template>
    
    <script setup >
import BtnDanger from "@/Components/Buttons/BtnDanger.vue";
import { onMounted, onUnmounted, reactive, ref } from "@vue/runtime-core";
import BtnPrimary from "../Buttons/BtnPrimary.vue";
import { Inertia } from "@inertiajs/inertia";
import { createToast } from "mosha-vue-toastify";

const props = defineProps({
  id: {
    required: true,
  },
  title: {},
  data: {},
  url: {},
});
const model = ref(false);

const emit = defineEmits(["DeleteSuccess"]);
const closeOnEscape = (e) => {
  if (model.value && e.key === "Escape") {
    model.value = false;
  }
};

onMounted(() => document.addEventListener("keydown", closeOnEscape));
onUnmounted(() => document.removeEventListener("keydown", closeOnEscape));

function OpenModel() {
  model.value = true;
}

function deleteFun() {
  /**
   * PUT/PATCH/DELETE method
   * https://github.com/inertiajs/inertia/issues/495
   *
   */
  Inertia.delete(route(props.url + ".destroy", props.id), {
    onSuccess: () => {
      createToast(
        {
          title: props.title + "تم حذف ",
        },
        {
          timeout: 3000,
          transition: "slide",
          type: "success",
          showIcon: true,
        }
      );
    },
    onError: (errors) => {
      for (const [key, value] of Object.entries(errors)) {
        createToast(
          {
            title: value,
          },
          {
            timeout: 3000,
            transition: "slide",
            type: "danger",
            showIcon: true,
          }
        );
      }
    },
  });
  model.value = false;
  emit("DeleteSuccess");
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
  z-index: 1;
}
</style>